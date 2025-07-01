<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductDetails;
use App\Models\Product_Tags;
use App\Models\ProductStock;
use App\Models\Variant;
use App\Models\VariantImageGallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Str;
use App\Models\Attribute;
use App\Models\AttributeManage;
use App\Models\Brand;
use App\Services\ImageOptimizerService;
use Exception;
use App\Models\ProductFeature;
use App\Models\SizeModel;
use App\Models\ColorModel;
use File;
use App\Models\Category;
use App\Models\Concern;
use App\Models\Coupon;
use App\Models\Features;
use App\Models\ProductCategory;
use App\Models\ProductConcern;
use App\Models\ProductPromotion;
use App\Models\Setting;
use App\Models\TagName;
use App\Models\VariantPromotion;
use App\Services\SlugService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// use App\Models\
class ProductController extends Controller
{
    // product index function
    public function index()
    {
        $setting = Setting::latest()->first();
        $promotion = Coupon::where('type', 'promotion')->where('end_date', '>=', Carbon::now()->format('Y-m-d'))->get();
        $categories = Category::where('status', 1)->whereNull('parent_id')->get();
        $brands = Brand::where('status', 1)->get();
        $concerns = Concern::where('status', 'active')->latest()->get();
        $features = Features::where('status', 1)->get();
        $tags = TagName::where('status', 'active')->get();

        return view('backend.products.insert', compact('promotion', 'categories', 'brands', 'setting', 'concerns', 'features', 'tags'));
    }

    // find variant function 
    public function findVariant($id)
    {
        $variant = Variant::where('product_id', $id)->first();
        return response()->json([
            'variant' => $variant
        ]);
    }


    // Product Store Function 
    public function store(Request $request, ImageOptimizerService $imageService)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required|max:100',
            'unit_id' => 'required',
            'size' => 'required',
            'color' => 'required',
            'price' => 'required|numeric|min:1',
            'gender' => 'required',
            'stock_quantity' => 'required|integer|min:0',
            'product_main_image' => 'required|array|min:1', // At least one image is required
            'product_main_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate each image
        ], [
            'product_main_image.required' => 'At least one image is required.',
            'product_main_image.min' => 'You must upload at least one image.',
            'product_main_image.*.image' => 'Each file must be an image.',
            'product_main_image.*.mimes' => 'Only jpeg, png, jpg, gif, and webp formats are allowed.',
            'product_main_image.*.max' => 'Each image must be less than 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $setting = Setting::latest()->first();

        $product = new Product;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->unit_id = $request->unit_id;
        $product->slug = SlugService::generateUniqueSlug($request->product_name, Product::class);
        $product->sku = $request->sku;
        $product->created_by = Auth::user()->id;
        $product->video_link = $request->video_link;
        $product->save();



        if ($product) {
            $productDetails = new ProductDetails();
            $productDetails->product_id = $product->id;
            $productDetails->gender = $request->gender;
            $productDetails->short_description = $request->short_description;
            $productDetails->product_policy = $request->product_policy;
            $productDetails->description = $request->description;
            $productDetails->ingredients = $request->ingredients;
            $productDetails->usage_instruction = $request->usage_instruction;
            $productDetails->created_by = Auth::user()->id;
            $productDetails->save();


            if ($setting->isMultipleCategory === 0) {
                $productCategory = new ProductCategory;
                $productCategory->product_id = $product->id;
                $productCategory->category_id = $request->category_id;
                $productCategory->save();

                $productCategory = new ProductCategory;
                $productCategory->product_id = $product->id;
                $productCategory->category_id = $request->category_id;
                $productCategory->type = 'subcategory';
                $productCategory->save();
            } else {
                foreach ($request->category_id as $id) {
                    $productCategory = new ProductCategory;
                    $productCategory->product_id = $product->id;
                    $productCategory->category_id = $id;
                    $productCategory->save();
                }

                foreach ($request->subcategory_id as $id) {
                    $productCategory = new ProductCategory;
                    $productCategory->product_id = $product->id;
                    $productCategory->category_id = $id;
                    $productCategory->type = 'subcategory';
                    $productCategory->save();
                }
            }
        }





        if ($request->extra_field) {
            foreach ($request->extra_field_id as $key => $fieldId) {
                $extraFieldInfo = Attribute::where('id', $fieldId)->first();


                if (!isset($request->extra_field[$fieldId]) || $request->extra_field[$fieldId] === null) {
                    continue;
                }

                $data = $request->extra_field[$fieldId];

                switch ($extraFieldInfo->data_type) {
                    case 'json':
                        $storedValue = is_array($data) ? json_encode($data) : json_encode([$data]);
                        break;

                    case 'integer':
                    case 'float':
                    case 'decimal':
                    case 'double':
                        if (!is_numeric($data)) {
                            continue 2; // Correct way to skip the loop iteration
                        }
                        $storedValue = match ($extraFieldInfo->data_type) {
                            'integer' => intval($data),
                            'float' => floatval($data),
                            'decimal' => number_format((float) $data, 2, '.', ''),
                            'double' => doubleval($data),
                        };
                        break;

                    case 'date':
                        if (!strtotime($data)) {
                            continue 2; // Skip invalid dates
                        }
                        $storedValue = date('Y-m-d', strtotime($data));
                        break;

                    default:
                        $storedValue = (string) $data;
                        break;
                }

                AttributeManage::create([
                    'attribute_id' => $fieldId,
                    'value' => $storedValue,
                    'product_id' => $product->id,
                ]);
            }
        }

        if ($product && $request->tag) {

            foreach ($request->tag as $tag) {
                $productTag = new Product_Tags();
                $productTag->product_id = $product->id;
                $productTag->tag_id = $tag;
                $productTag->save();
            }
        }

        if ($product && $request->product_feature) {
            foreach ($request->product_feature as $feature) {
                $productFeature = new ProductFeature();
                $productFeature->product_id = $product->id;
                $productFeature->feature_id = $feature;
                $productFeature->save();
            }
        }

        if ($product && $request->concerns) {
            foreach ($request->concerns as $id) {
                $concern = new ProductConcern();
                $concern->product_id = $product->id;
                $concern->concern_id = $id;
                $concern->save();
            }
        }


        if ($product) {
            $variant = new Variant();
            $variant->product_id = $product->id;
            $variant->size = $request->size;
            $variant->color = $request->color;
            $variant->regular_price = $request->price;
            $variant->status = "Default";
            if ($request->variant_name) {
                $variant->variant_name = $request->variant_name;
            } else {
                $variant->variant_name = $product->product_name;
            }
            $variant->weight = $request->weight;
            $variant->flavor = $request->flavor;
            $variant->save();


            if ($variant->id) {
                if ($request->hasFile('product_main_image')) {
                    foreach ($request->file('product_main_image') as $image) {
                        $destinationPath = public_path('uploads/products/variant/');
                        // $filename = time() . '_' . uniqid() . '.' . $image->extension();
                        $imageName = $imageService->resizeAndOptimize($image, $destinationPath);
                        $image = 'uploads/products/variant/' . $imageName;

                        $productGallery = new VariantImageGallery;
                        $productGallery->variant_id = $variant->id;
                        $productGallery->product_id = $product->id;
                        $productGallery->image =  $image;
                        $productGallery->save();
                    }
                }
            }



            if ($product && $variant && $request->stock_quantity) {
                $stock = new ProductStock();
                $stock->product_id = $product->id;
                $stock->variant_id = $variant->id;
                $stock->StockQuantity = $request->stock_quantity;

                $stock->status = 'Available';
                $stock->save();
            }

            if ($variant->id && $request->promotion_id) {
                $promotion = new ProductPromotion();
                $promotion->product_id = $product->id;
                $promotion->variant_id = $variant->id;
                $promotion->promotion_id = $request->promotion_id;
                $promotion->save();

                $variantPromotion = new VariantPromotion;
                $variantPromotion->product_id = $product->id;
                $variantPromotion->variant_id = $variant->id;
                $variantPromotion->promotion_id = $request->promotion_id;
                $variantPromotion->save();
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Product Successfully Saved'
        ]);
    }



    // show all products function
    public function view()
    {
        $products = Product::latest()->get();
        return view('backend.products.view', compact('products'));
    }


    // view details product function
    public function viewDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.products.view_details', compact('product'));
    }

    // product edit function
    public function edit($id)
    {
        $product = Product::with('productdetails')->findOrFail($id);
        $setting = Setting::latest()->first();
        $attribute_manages = AttributeManage::where('product_id', $id)->get();
        $variants = Variant::where('product_id', $id)->get();
        $size = SizeModel::select('size_name')->get();
        $color = ColorModel::select('color_name')->get();
        $inserttag = Product_Tags::where('product_id', $id)->get();
        $extraFields = AttributeManage::where('product_id', $product->id)->get();
        $promotion = Coupon::where('type', 'promotion')->where('end_date', '>=', Carbon::now()->format('Y-m-d'))->get();
        $existPromotion = ProductPromotion::where('product_id', $product->id)->latest()->first();
        $categories = Category::where('status', 1)->whereNull('parent_id')->get();
        $selectedCategories = $product->productCategory;
        $brands = Brand::where('status', 1)->get();

        $concerns = Concern::where('status', 'active')->latest()->get();
        $selectedConcernId = ProductConcern::where('product_id', $product->id)->pluck('concern_id')->toArray();
        $features = Features::where('status', 1)->get();
        $selectFeatureIds = ProductFeature::where('product_id', $product->id)->pluck('feature_id')->toArray();
        $tags = TagName::where('status', 'active')->get();
        $selectedTagIds = Product_Tags::where('product_id', $product->id)->pluck('tag_id')->toArray();


        $selectedCategoryIds = $product->productCategory->pluck('category_id')->toArray();
        $selectedSubcategoryIds = $product->productSubCategories->pluck('category_id')->toArray();

        $subcategories = Category::whereIn('parent_id', $selectedCategoryIds)->get();

        return view('backend.products.edit', compact('product', 'attribute_manages', 'variants', 'inserttag', 'extraFields', 'size', 'color', 'promotion', 'categories', 'brands', 'setting', 'tags', 'features', 'concerns', 'selectedCategoryIds', 'selectedSubcategoryIds', 'subcategories', 'existPromotion', 'selectFeatureIds', 'selectedTagIds', 'selectedConcernId', 'selectedCategories'));
    }


    // product delete function
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $getVariants = Variant::where('product_id', $id)->get();
        $stock = ProductStock::where('product_id', $id)->get();
        foreach ($stock as $stocks) {
            $stocks->delete();
        }
        foreach ($getVariants as $variant) {
            if ($variant->image) {
                $imagePath = public_path($variant->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $variant->delete();
        }
        $product->delete();
        return redirect()->route('product.view')->with('success', 'Product deleted successfully');
    }

    // product status changed
    public function productStatus($id)
    {
        // dd($request);
        $product = Product::findOrFail($id);
        if ($product->status == 0) {
            $newStatus = 1;
        } else {
            $newStatus = 0;
        }

        $product->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('message', 'status changed successfully');
    }

    // product update function
    public function update(Request $request)
    {

        dd($request->category_id);
        $setting = Setting::latest()->first();

        $product = Product::findOrFail($request->product_id);
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        if ($product->product_name !== $request->product_name) {
            $product->slug = SlugService::generateUniqueSlug($request->product_name, Product::class);
        }
        $product->unit_id = $request->unit_id;
        if ($request->shipping_charge) {
            $product->shipping_charge = $request->shipping_charge;
        }
        $product->sku = $request->sku;
        $product->created_by = Auth::user()->id;
        $product->video_link = $request->video_link;
        $product->save();

        if ($product) {
            $productDetails = ProductDetails::where('product_id', $product->id)->first();
            $productDetails->product_id = $product->id;
            $productDetails->gender = $request->gender;
            $productDetails->description = $request->description;
            $productDetails->short_description = $request->short_description;
            $productDetails->product_policy = $request->product_policy;
            $productDetails->ingredients = $request->ingredients;
            $productDetails->usage_instruction = $request->usage_instruction;
            $productDetails->created_by = Auth::user()->id;
            $productDetails->save();

            // if ($setting->isMultipleCategory === 0) {
            //     $oldCat = $product->productCategory;

            //     if ($request->category_id !== null) {
            //         $productCategory = new ProductCategory;
            //         $productCategory->product_id = $product->id;
            //         $productCategory->category_id = $request->category_id;
            //         $productCategory->save();
            //     }
            //     if ($request->subcategory_id !== null) {
            //         $productCategory = new ProductCategory;
            //         $productCategory->product_id = $product->id;
            //         $productCategory->category_id = $request->category_id;
            //         $productCategory->type = 'subcategory';
            //         $productCategory->save();
            //     }
            // } else {
            //     foreach ($request->category_id as $id) {
            //         $productCategory = new ProductCategory;
            //         $productCategory->product_id = $product->id;
            //         $productCategory->category_id = $id;
            //         $productCategory->save();
            //     }

            //     foreach ($request->subcategory_id as $id) {
            //         $productCategory = new ProductCategory;
            //         $productCategory->product_id = $product->id;
            //         $productCategory->category_id = $id;
            //         $productCategory->type = 'subcategory';
            //         $productCategory->save();
            //     }
            // }

            if ($setting->isMultipleCategory === 0) {

                $oldCategories = ProductCategory::where('product_id', $product->id)->get()->pluck('category_id')->toArray();


                $newCategoryIds = [];
                if ($request->category_id !== null) {
                    $newCategoryIds[] = $request->category_id;
                }
                if ($request->subcategory_id !== null) {
                    $newCategoryIds[] = $request->subcategory_id;
                }


                if (!empty($newCategoryIds)) {
                    $categoriesToDelete = array_diff($oldCategories, $newCategoryIds);
                    if (!empty($categoriesToDelete)) {
                        ProductCategory::where('product_id', $product->id)
                            ->whereIn('category_id', $categoriesToDelete)
                            ->delete();
                    }
                } else {

                    ProductCategory::where('product_id', $product->id)->delete();
                }


                if ($request->category_id !== null) {
                    $productCategory = new ProductCategory;
                    $productCategory->product_id = $product->id;
                    $productCategory->category_id = $request->category_id;
                    $productCategory->type = 'category';
                    $productCategory->save();
                }
                if ($request->subcategory_id !== null) {
                    $productCategory = new ProductCategory;
                    $productCategory->product_id = $product->id;
                    $productCategory->category_id = $request->subcategory_id;
                    $productCategory->type = 'subcategory';
                    $productCategory->save();
                }
            } else {

                $oldCategories = ProductCategory::where('product_id', $product->id)->get()->pluck('category_id')->toArray();


                $newCategoryIds = array_merge(
                    is_array($request->category_id) ? $request->category_id : [],
                    is_array($request->subcategory_id) ? $request->subcategory_id : []
                );


                if (!empty($newCategoryIds)) {
                    $categoriesToDelete = array_diff($oldCategories, $newCategoryIds);
                    if (!empty($categoriesToDelete)) {
                        ProductCategory::where('product_id', $product->id)
                            ->whereIn('category_id', $categoriesToDelete)
                            ->delete();
                    }
                } else {

                    ProductCategory::where('product_id', $product->id)->delete();
                }


                if (is_array($request->category_id)) {
                    foreach ($request->category_id as $id) {
                        $productCategory = new ProductCategory;
                        $productCategory->product_id = $product->id;
                        $productCategory->category_id = $id;
                        $productCategory->type = 'category';
                        $productCategory->save();
                    }
                }

                if (is_array($request->subcategory_id)) {
                    foreach ($request->subcategory_id as $id) {
                        $productCategory = new ProductCategory;
                        $productCategory->product_id = $product->id;
                        $productCategory->category_id = $id;
                        $productCategory->type = 'subcategory';
                        $productCategory->save();
                    }
                }
            }
        }

        if ($request->promotion_id) {
            $variants = Variant::where('product_id', $product->id)->get();
            foreach ($variants as $variant) {
                $product_promotion = ProductPromotion::where('variant_id', $variant->id)->first();
                if ($product_promotion) {
                    $product_promotion->product_id = $product->id;
                    $product_promotion->variant_id = $variant->id;
                    $product_promotion->promotion_id = $request->promotion_id;
                    $product_promotion->save();
                } else {
                    $promotion = new ProductPromotion();
                    $promotion->product_id = $product->id;
                    $promotion->variant_id = $variant->id;
                    $promotion->promotion_id = $request->promotion_id;
                    $promotion->save();
                }
                $variantPromotion = VariantPromotion::where('variant_id', $variant->id)->first();
                if ($variantPromotion) {
                    $variantPromotion->product_id = $product->id;
                    $variantPromotion->variant_id = $variant->id;
                    $variantPromotion->promotion_id = $request->promotion_id;
                    $variantPromotion->save();
                } else {
                    $variantPromotion = new VariantPromotion;
                    $variantPromotion->product_id = $product->id;
                    $variantPromotion->variant_id = $variant->id;
                    $variantPromotion->promotion_id = $request->promotion_id;
                    $variantPromotion->save();
                }
            }
        }


        if ($request->has('extra_field')) {

            if (!is_array($request->extra_field)) {
                throw new \Exception("Invalid input! 'extra_field' must be an array.");
            }

            foreach ($request->extra_field as $fieldId => $data) {

                $extraFieldInfo = Attribute::find($fieldId);
                if (!$extraFieldInfo) {
                    throw new \Exception("Attribute ID $fieldId not found.");
                }


                switch ($extraFieldInfo->data_type) {
                    case 'json':
                        $storedValue = is_array($data) ? json_encode($data) : json_encode([$data]);
                        break;

                    case 'int':
                    case 'integer':
                        if (!is_numeric($data)) {
                            throw new \Exception("Invalid value for Attribute ID $fieldId! Expected an integer.");
                        }
                        $storedValue = intval($data);
                        break;

                    case 'float':
                    case 'decimal':
                    case 'double':
                        if (!is_numeric($data)) {
                            throw new \Exception("Invalid value for Attribute ID $fieldId! Expected a decimal number.");
                        }
                        $storedValue = floatval($data);
                        break;

                    case 'date':
                        if (!strtotime($data)) {
                            throw new \Exception("Invalid date format for Attribute ID $fieldId.");
                        }
                        $storedValue = date('Y-m-d', strtotime($data));
                        break;

                    default:
                        $storedValue = (string)$data;
                        break;
                }

                // Save or update the value
                AttributeManage::updateOrCreate(
                    [
                        'attribute_id' => $fieldId,
                        'product_id' => $product->id,
                    ],
                    [
                        'value' => $storedValue,
                    ]
                );
            }
        }




        if ($product) {
            $oldTags = Product_Tags::where('product_id', $product->id)
                ->pluck('tag_id')
                ->toArray();


            $newTags = is_array($request->tag) ? $request->tag : [];


            if (!empty($newTags)) {
                $tagsToDelete = array_diff($oldTags, $newTags);
                if (!empty($tagsToDelete)) {
                    Product_Tags::where('product_id', $product->id)
                        ->whereIn('tag_id', $tagsToDelete)
                        ->delete();
                }
            } else {
                Product_Tags::where('product_id', $product->id)->delete();
            }


            if (!empty($newTags)) {
                $insertData = [];
                foreach ($newTags as $tagId) {

                    $exists = Product_Tags::where('product_id', $product->id)
                        ->where('tag_id', $tagId)
                        ->exists();

                    if (!$exists) {
                        $insertData[] = [
                            'product_id' => $product->id,
                            'tag_id' => $tagId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }

                if (!empty($insertData)) {
                    DB::table('product_tags')->insert($insertData);
                }
            }


            $oldFeature = ProductFeature::where('product_id', $product->id)
                ->pluck('feature_id')
                ->toArray();
            $newFeature = is_array($request->product_feature) ? $request->product_feature : [];
            if (!empty($oldFeature)) {
                $featureToDelete = array_diff($oldFeature, $newFeature);
                if (!empty($featureToDelete)) {
                    ProductFeature::where('product_id', $product->id)
                        ->whereIn('feature_id', $featureToDelete)
                        ->delete();
                }
            } else {
                ProductFeature::where('product_id', $product->id)->delete();
            }
            if (!empty($newFeature)) {
                $insertData = [];
                foreach ($newFeature as $featureId) {

                    $exists = ProductFeature::where('product_id', $product->id)
                        ->where('feature_id', $featureId)
                        ->exists();

                    if (!$exists) {
                        $insertData[] = [
                            'product_id' => $product->id,
                            'feature_id' => $featureId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }

                if (!empty($insertData)) {
                    DB::table('product_features')->insert($insertData);
                }
            }

            // ProductFeature::where('product_id', $product->id)->delete();
            // foreach ($request->product_feature as $feature) {
            //     $productFeature = new ProductFeature();
            //     $productFeature->product_id = $product->id;
            //     $productFeature->feature_id = $feature;
            //     $productFeature->save();
            // }



            $oldConcern = ProductConcern::where('product_id', $product->id)
                ->pluck('concern_id')
                ->toArray();
            $newConcern = is_array($request->concerns) ? $request->concerns : [];
            if (!empty($oldConcern)) {
                $concernToDelete = array_diff($oldConcern, $newConcern);
                if (!empty($concernToDelete)) {
                    ProductConcern::where('product_id', $product->id)
                        ->whereIn('concern_id', $concernToDelete)
                        ->delete();
                }
            } else {
                ProductConcern::where('product_id', $product->id)->delete();
            }
            if (!empty($newConcern)) {
                $insertData = [];
                foreach ($newConcern as $concernId) {

                    $exists = ProductConcern::where('product_id', $product->id)
                        ->where('concern_id', $concernId)
                        ->exists();

                    if (!$exists) {
                        $insertData[] = [
                            'product_id' => $product->id,
                            'concern_id' => $concernId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }

                if (!empty($insertData)) {
                    DB::table('product_concerns')->insert($insertData);
                }
            }


            // foreach ($request->concerns as $id) {
            //     $concern = new ProductConcern();
            //     $concern->product_id = $product->id;
            //     $concern->concern_id = $id;
            //     $concern->save();
            // }
        }


        return response()->json([
            'status' => 200,
            'message' => 'Product Updated Successfully'
        ]);
    }

    public function getVariant_product_id()
    {
        $product_id = Product::where('created_by', Auth::user()->id)->latest()->first()->id;
        return response()->json([
            'status' => '200',
            'product_id' => $product_id,
            'product_name' => Product::where('id', $product_id)->first()->product_name,
        ]);
    }


    public function variantProductStore(Request $request, ImageOptimizerService $imageService)
    {
        try {

            if (!empty($request->price ?? 0)) {
                foreach ($request->price as $key => $price) {

                    $productVerify = Variant::where('product_id', $request->product_id)->first();

                    $variant = new Variant();
                    $variant->product_id = $request->product_id;
                    $variant->size = $request->size[$key];
                    // dd( $variant->size );
                    $variant->color = $request->color[$key];
                    $variant->regular_price = $price;
                    $variant->weight = $request->weight[$key] ?? null;
                    $variant->flavor = $request->flavor[$key] ?? null;
                    $variant->variant_name = $request->variant_name[$key] ?? null;

                    if ($productVerify) {
                        $variant->status = "Variant";
                    }
                    $variant->save();


                    if ($variant->id && $request->hasFile("image.$key")) {
                        foreach ($request->file("image.$key") as $image) {

                            // $filename = time() . '_' . uniqid() . '.' . $image->extension();
                            // $path = 'uploads/products/variant/';
                            // $image->move($path, $filename);

                            $destinationPath = public_path('uploads/products/variant/');
                            // $filename = time() . '_' . uniqid() . '.' . $image->extension();
                            $imageName = $imageService->resizeAndOptimize($image, $destinationPath);
                            $image = 'uploads/products/variant/' . $imageName;


                            $variantImage = new VariantImageGallery();
                            $variantImage->variant_id = $variant->id;
                            $variantImage->product_id = $request->product_id;
                            $variantImage->image = $image;
                            $variantImage->save();
                        }
                    }


                    if (!empty($request->stock_quantity[$key])) {
                        $stock = new ProductStock();
                        $stock->product_id = $request->product_id;
                        $stock->variant_id = $variant->id;
                        $stock->StockQuantity = $request->stock_quantity[$key];
                        $stock->status = 'Available';
                        $stock->save();
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Variant saved successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function ProductvariantUpdate(Request $request, ImageOptimizerService $imageService)
    {
        try {

            //  dd($request->all());
            $existingVariants = Variant::where('product_id', $request->product_id)->get()->keyBy('id');

            if (!empty($request->price)) {
                $first = true; //identify the first default variant of the product
                foreach ($request->price as $variant_id => $price) {

                    if (isset($existingVariants[$variant_id])) {
                        $variant = $existingVariants[$variant_id];
                    } else {
                        $variant = new Variant();
                        $variant->product_id = $request->product_id;
                        $variant->variant_name = $request->variant_name[$variant_id];

                        $variant->save();
                    }


                    $variant->size = $request->size[$variant_id] ?? null;
                    $variant->color = $request->color[$variant_id] ?? null;
                    $variant->regular_price = $price;
                    $variant->weight = $request->weight[$variant_id] ?? null;
                    $variant->flavor = $request->flavor[$variant_id] ?? null;
                    $variant->variant_name = $request->variant_name[$variant_id] ?? null;

                    if ($first) {
                        $variant->status = "Default";
                        $first = false;
                    } else {
                        $variant->status = "Variant";
                    }

                    $variant->save();

                    // Handle images
                    if ($variant->id && $request->hasFile("image.$variant_id")) {

                        foreach ($request->file("image.$variant_id") as $image) {
                            $destinationPath = public_path('uploads/products/variant/');
                            // $filename = time() . '_' . uniqid() . '.' . $image->extension();
                            $imageName = $imageService->resizeAndOptimize($image, $destinationPath);
                            $image = 'uploads/products/variant/' . $imageName;

                            $variantImage = new VariantImageGallery();
                            $variantImage->variant_id = $variant->id;
                            $variantImage->product_id = $request->product_id;
                            $variantImage->image =  $image;
                            $variantImage->save();
                        }
                    }




                    if (isset($request->stock_quantity[$variant_id])) {

                        ProductStock::updateOrCreate(
                            ['product_id' => $request->product_id, 'variant_id' => $variant->id],
                            ['StockQuantity' => $request->stock_quantity[$variant_id], 'status' => 'Available']
                        );
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Variants updated successfully',
                'product_id' => $variant->product_id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }


    public function variantImageDelete(Request $request)
    {
        try {
            $variantImage = VariantImageGallery::findOrFail($request->image_id);

            if (file_exists($variantImage->image)) {
                unlink($variantImage->image);
            }
            $variantImage->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Variant Image Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function variantDelete(Request $request)
    {
        try {
            $variant = Variant::findOrFail($request->variant_id);


            $images = VariantImageGallery::where('variant_id', $variant->id)->get();

            foreach ($images as $image) {
                $imagePath = public_path($image->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $image->delete();
            }

            $productStock = ProductStock::where('variant_id', $variant->id)->first();
            if ($productStock) {
                $productStock->delete();
            }

            $variant->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Variant Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage(),

            ]);
        }
    }
    //rest Api Start

}

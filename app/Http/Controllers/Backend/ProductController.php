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
use App\Services\ImageOptimizerService;
use Exception;
use App\Models\ProductFeature;
use App\Models\SizeModel;
use App\Models\ColorModel;
use File;
// use App\Models\
class ProductController extends Controller
{
    // product index function
    public function index()
    {
        return view('backend.products.insert');
    }
    public function findVariant($id)
    {
        $variant = Variant::where('product_id', $id)->first();
        return response()->json([
            'variant' => $variant
        ]);
    }

    // product add function
    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     $request->validate([
    //         'category_id' => 'required',
    //         'subcategory_id' => 'required',
    //         'brand_id' => 'required',
    //         'product_feature' => 'required',
    //         'product_name' => 'required|max:100',
    //         'short_desc' => 'required|max:255',
    //         'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    //         'sku' => 'required',
    //         'tag' => 'required',
    //     ]);
    //     $product = new Product;
    //     if ($request->product_image) {
    //         $productImage = rand() . '.' . $request->product_image->extension();
    //         $request->product_image->move(public_path('uploads/products/'), $productImage);

    //         $product->category_id = $request->category_id;
    //         $product->subcategory_id = $request->subcategory_id;
    //         $product->brand_id = $request->brand_id;
    //         $product->sub_subcategory_id = $request->sub_subcategory_id;
    //         $product->product_feature = implode(',', $request->product_feature);
    //         $product->product_name = $request->product_name;
    //         $product->slug = Str::slug($request->product_name);
    //         $product->short_desc = $request->short_desc;
    //         $product->long_desc = $request->long_desc;
    //         $product->product_image = $productImage;
    //         $product->sku = $request->sku;
    //         $product->tags = $request->tag;
    //         $product->shipping = $request->shipping;
    //         $product->save();
    //         if ($request->imageGallery) {
    //             $imagesGallery = $request->imageGallery;
    //             foreach ($imagesGallery as $image) {
    //                 $galleryImage = rand() . '.' . $image->extension();
    //                 $image->move(public_path('uploads/products/gallery/'), $galleryImage);
    //                 $productGallery = new ProductGallery;
    //                 $productGallery->product_id = $product->id;
    //                 $productGallery->image = $galleryImage;
    //                 $productGallery->save();
    //             }
    //         }
    //     }
    //     return back()->with('success', 'Product Successfully Saved');
    // }

    public function store(Request $request, ImageOptimizerService $imageService)
    {
        //   dd($request->all());
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

            // Validate product_main_image as an array
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

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->sub_subcategory_id = $request->sub_subcategory_id;
        if($request->shipping_charge){
            $product->shipping_charge = $request->shipping_charge;
        }

        $product->product_name = $request->product_name;
        $product->unit_id = $request->unit_id;
        $product->slug = Str::slug($request->product_name);
        $product->sku = $request->sku;
        $product->created_by = Auth::user()->id;
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

        if($product && $request->product_feature){
            foreach($request->product_feature as $feature){
                $productFeature = new ProductFeature();
                $productFeature->product_id = $product->id;
                $productFeature->feature_id = $feature;
                $productFeature->save();
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

            // if($request->hasFile('product_main_image')){
            //     $file = $request->file('product_main_image');
            //     $extension =$file->extension();
            //     $filename = time().'.'.$extension;
            //     $path='uploads/products/variant/';
            //     $file->move($path,$filename);
            //     $variant->image=$path.$filename;
            // }
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
        }

        return response()->json([
            'status' => 200,
            'message' => 'Product Successfully Saved'
        ]);
    }



    // show all products function
    public function view()
    {
        $products = Product::with('varient')->orderBy('id', 'desc')->get();



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

        $attribute_manages = AttributeManage::where('product_id', $id)->get();
        $variants = Variant::where('product_id', $id)->get();
        $size=SizeModel::select('size_name')->get();
        $color= ColorModel::select('color_name')->get();
        $inserttag = Product_Tags::where('product_id', $id)->get();
        $extraFields = AttributeManage::where('product_id', $product->id)->get();
        // ->pluck('value', 'attribute_id')
        // ->toArray();

        return view('backend.products.edit', compact('product', 'attribute_manages', 'variants', 'inserttag', 'extraFields','size','color'));
    }


    // product delete function
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $getVariants=Variant::where('product_id',$id)->get();
        $stock=ProductStock::where('product_id',$id)->get();
        foreach($stock as $stocks){
            $stocks->delete();
        }
        foreach($getVariants as $variant){
            if($variant->image){
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



        $product = Product::findOrFail($request->product_id);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->sub_subcategory_id = $request->sub_subcategory_id;
        // if ($request->product_feature) {
        //     $product->product_feature = json_encode($request->product_feature);
        // }

        $product->product_name = $request->product_name;
        $product->unit_id = $request->unit_id;
        if($request->shipping_charge){
            $product->shipping_charge = $request->shipping_charge;
        }
        $product->slug = Str::slug($request->product_name);
        $product->sku = $request->sku;
        $product->created_by = Auth::user()->id;
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

        if ($product && $request->tag) {
           Product_Tags::where('product_id', $product->id)->delete();
            foreach ($request->tag as $tag) {
                $productTag = new Product_Tags();
                $productTag->product_id = $product->id;
                $productTag->tag_id = $tag;
                $productTag->save();
            }
        }


        if($product && $request->product_feature){
            ProductFeature::where('product_id', $product->id)->delete();
            foreach($request->product_feature as $feature){
                $productFeature = new ProductFeature();
                $productFeature->product_id = $product->id;
                $productFeature->feature_id = $feature;
                $productFeature->save();
            }
        }



        return response()->json([
            'status' => 200,
            'message' => 'Product Updated Successfully'
        ]);
    }



    // delete variants function
    // public function deleteVariant($id)
    // {
    //     // dd($id);
    //     $variant = Variant::findOrFail($id);
    //     $variant->delete();
    //     return response()->json([
    //         'status' => '200',
    //         'message' => 'Variant Delete Successfully'
    //     ]);
    // }
    // public function editVariant($id)
    // {
    //     $variant = Variant::where('id', $id)->first();
    //     return response()->json([
    //         'status' => '200',
    //         'message' => 'Please Update variant',
    //         'variantData' => $variant
    //     ]);
    // }

    // public function updateVariant(Request $request, $id)
    // {
    //     // dd($request);
    //     $variant = Variant::findOrFail($id);
    //     $variant->regular_price    = $request->regular_price;
    //     $variant->discount    = $request->discount;
    //     $variant->discount_amount    = $request->discount_amount;
    //     $variant->stock_quantity    = $request->stock_quantity;
    //     $variant->barcode    = $request->barcode;
    //     $variant->color    = $request->color;
    //     $variant->size    = $request->size;
    //     $variant->unit    = $request->unit;
    //     $variant->weight    = $request->weight;
    //     $variant->expire_date    = $request->expire_date;
    //     $variant->manufacture_date    = $request->manufacture_date;
    //     $variant->product_id    = $request->product_id;
    //     $variant->update();
    //     return response()->json([
    //         'status' => '200',
    //         'message' => 'variant Updated successfully',

    //     ]);
    // }


    // variants store function
    // public function variantStore(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'product_id' => 'required',
    //         'regular_price' => 'required|numeric',
    //         'discount' => 'required|numeric',
    //         'discount_amount' => 'required|numeric',
    //         'stock_quantity' => 'required|numeric',
    //         'unit' => 'required|max:50',
    //     ]);

    //     if ($validator->passes()) {
    //         $variant = new Variant;
    //         $variant->regular_price    = $request->regular_price;
    //         $variant->discount    = $request->discount;
    //         $variant->discount_amount    = $request->discount_amount;
    //         $variant->stock_quantity    = $request->stock_quantity;
    //         $variant->barcode    = $request->barcode;
    //         $variant->color    = $request->color;
    //         $variant->size    = $request->size;
    //         $variant->unit    = $request->unit;
    //         $variant->weight    = $request->weight;
    //         $variant->expire_date    = $request->expire_date;
    //         $variant->manufacture_date    = $request->manufacture_date;
    //         $variant->product_id    = $request->product_id;
    //         $variant->save();
    //         return response()->json([
    //             'status' => '200',
    //             'message' => 'variant saved successfully',

    //         ]);
    //     }
    //     return response()->json([
    //         'status' => '500',
    //         'error' => $validator->messages()
    //     ]);
    // }

    // show variants function
    // public function variantShow($id)
    // {
    //     $variant = Variant::where('product_id', $id)->get();
    //     return response()->json([
    //         'status' => '200',
    //         'message' => 'variant saved successfully',
    //         'variantData' => $variant,
    //     ]);
    // }


    public function getVariant_product_id()
    {
        $product_id = Product::where('created_by', Auth::user()->id)->latest()->first()->id;
        return response()->json([
            'status' => '200',
            'product_id' => $product_id,
            'product_name' => Product::where('id', $product_id)->first()->product_name,
        ]);
    }



    //     public function variantProductStore(Request $request)
    // {

    //     try{

    //         if ($request->price ??0) {
    //             foreach ($request->price as $key => $price) {

    //                 $productVerify = Variant::where('product_id', $request->product_id)->first();

    //                 $variant = new Variant;
    //                 $variant->product_id = $request->product_id;
    //                 $variant->size = $request->size[$key];
    //                 $variant->color = $request->color[$key];
    //                 $variant->regular_price = $price;
    //                 $variant->weight = $request->weight[$key];
    //             $variant->flavor = $request->flavor[$key];
    //             $variant->variant_name = $request->variant_name[$key];

    //             if ($productVerify) {
    //                 $variant->status = "Variant";
    //             }
    //             $variant->save();


    //             if($variant->id){

    //                 if($request->hasFile('image')&& isset($request->image[$key])){
    //                     foreach($request->image as $key => $image) {
    //                     dd($request->image[$key]);
    //                     $file = $request->file('image')[$key];
    //                     $extension = $file->extension();
    //                     $filename = time() . '_' . $key . '.' . $extension;
    //                     $path = 'uploads/products/variant/';
    //                     $file->move($path,$filename);
    //                     $galleryImage = $path.$filename;

    //                     $variantImage = new VariantImageGallery();
    //                     $variantImage->variant_id = $variant->id;
    //                     $variantImage->product_id= $request->product_id;
    //                     $variantImage->image = $galleryImage;
    //                     $variantImage->save();
    //                 }
    //                }
    //             }








    //             if ($request->stock_quantity && isset($request->stock_quantity[$key])) {

    //                 $stock = new ProductStock();
    //                 $stock->product_id = $request->product_id;
    //                 $stock->variant_id = $variant->id;
    //                 $stock->StockQuantity = $request->stock_quantity[$key];
    //                 $stock->status = 'Available';

    //                 $stock->save();

    //             }
    //         }
    //     }

    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Variant saved successfully',
    //     ]);
    // }
    // catch (\Exception $e) {
    //     return response()->json([
    //         'status' => '500',
    //         'message' => 'Something went wrong',
    //     ]);
    // }
    // }

    // public function variantProductStore(Request $request)
    // {

    //     try {
    //         if ($request->price ?? 0) {
    //             foreach ($request->price as $key => $price) {

    //                 $productVerify = Variant::where('product_id', $request->product_id)->first();

    //                 $variant = new Variant;
    //                 $variant->product_id = $request->product_id;
    //                 $variant->size = $request->size[$key];
    //                 $variant->color = $request->color[$key];
    //                 $variant->regular_price = $price;
    //                 $variant->weight = $request->weight[$key];
    //                 $variant->flavor = $request->flavor[$key];
    //                 $variant->variant_name = $request->variant_name[$key];

    //                 if ($productVerify) {
    //                     $variant->status = "Variant";
    //                 }
    //                 $variant->save();


    //                 if ($variant->id && $request->hasFile('image')) {

    //                     foreach ($request->file('image')[$key] as $image) {

    //                         $extension = $image->extension();
    //                         $filename = time() . '_' . uniqid() . '.' . $extension;
    //                         $path = 'uploads/products/variant/';
    //                         $image->move($path,$filename);
    //                         $galleryImage = $path . $filename;


    //                         $variantImage = new VariantImageGallery();
    //                         $variantImage->variant_id = $variant->id;
    //                         $variantImage->product_id = $request->product_id;
    //                         $variantImage->image = $galleryImage;
    //                         $variantImage->save();
    //                     }
    //                 }

    //                 // **Handling stock for each variant**
    //                 if ($request->stock_quantity && isset($request->stock_quantity[$key])) {
    //                     $stock = new ProductStock();
    //                     $stock->product_id = $request->product_id;
    //                     $stock->variant_id = $variant->id;
    //                     $stock->StockQuantity = $request->stock_quantity[$key];
    //                     $stock->status = 'Available';
    //                     $stock->save();
    //                 }
    //             }
    //         }

    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Variant saved successfully',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 500,
    //             'message' => 'Something went wrong',
    //             'error' => $e->getMessage(),
    //         ]);
    //     }
    // }


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


                    if (!empty($request->stock_quantity[$variant_id])) {
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

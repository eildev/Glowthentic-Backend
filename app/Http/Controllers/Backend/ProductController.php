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

    public function store(Request $request)
    {
        //  dd($request->all());
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            // 'subcategory_id' => 'required',
            'brand_id' => 'required',
            // 'product_feature' => 'required|array',
            'product_name' => 'required|max:100',
            // 'description' => 'required',
            'unit_id' => 'required',
            // 'sku' => 'required',
            // 'tag' => 'required|array',
            'size' => 'required',
            'color' => 'required',
            'price' => 'required|numeric|min:1',
            // 'weight' => 'nullable|string',
            // 'flavor' => 'nullable|string',
            'gender' => 'required',
            // 'ingredients'=>'nullable|string',
            // 'usage_instruction'=>'nullable|string',
            'product_main_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_main_image' => 'required|array',

            'stock_quantity' => 'required|integer|min:0',
        ]);

        // dd($validator);
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
        if ($request->product_feature) {
            $product->product_feature = implode(',', $request->product_feature);
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
            $productDetails->description = $request->description;
            $productDetails->ingredients = $request->ingredients;
            $productDetails->usage_instruction = $request->usage_instruction;
            $productDetails->created_by = Auth::user()->id;
            $productDetails->save();
        }

        if ($product && $request->tag) {

            foreach ($request->tag as $tag) {
                $productTag = new Product_Tags();
                $productTag->product_id = $product->id;
                $productTag->tag_id = $tag;
                $productTag->save();
            }
        }

        if ($product) {
            $variant = new Variant();
            $variant->product_id = $product->id;
            $variant->size = $request->size;
            $variant->color = $request->color;
            $variant->regular_price = $request->price;
            $variant->variant_name = $request->variant_name;
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
                        $file = $image;
                        $extension = $file->extension();
                        $filename = time() . '_' . uniqid() . '.' . $image->extension();
                        $path = 'uploads/products/variant/';
                        $file->move($path, $filename);
                        $galleryImage = $path . $filename;
                        $productGallery = new VariantImageGallery;
                        $productGallery->variant_id = $variant->id;
                        $productGallery->product_id = $product->id;
                        $productGallery->image = $galleryImage;
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
        $products = Product::orderByDesc('id')->with('varient')->get();


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
        $product = Product::findOrFail($id);
        return view('backend.products.edit', compact('product'));
    }


    // product delete function
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        unlink(public_path('uploads/products/') . $product->product_image);
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
    public function update(Request $request, $id)
    {
        // dd($request->product_feature);
        if ($request->product_image) {
            $productImage = rand() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('uploads/products/'), $productImage);
            $product = Product::findOrFail($id);
            $path = public_path('uploads/products/') . $product->product_image;
            if (file_exists($path)) {
                @unlink($path);
            }
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->sub_subcategory_id = $request->sub_subcategory_id;
            $product->brand_id = $request->brand_id;
            $product->product_feature = implode(',', $request->product_feature);
            $product->product_name = $request->product_name;
            $product->slug = Str::slug($request->product_name);
            $product->short_desc = $request->short_desc;
            $product->long_desc = $request->long_desc;
            $product->product_image = $productImage;
            $product->sku = $request->sku;
            $product->tags = $request->tag;
            // $product->shipping = $request->shipping;
            $product->update();
            if ($request->imageGallery) {
                $imagesGallery = $request->imageGallery;
                foreach ($imagesGallery as $image) {
                    $galleryImage = rand() . '.' . $image->extension();
                    $image->move(public_path('uploads/products/gallery/'), $galleryImage);
                    $productGallery = ProductGallery::where('product_id', $product->id)->first();
                    $path = public_path('uploads/products/gallery/') . $productGallery->image;
                    if (file_exists($path)) {
                        @unlink($path);
                    }
                    $productGallery->delete();
                    $productGallery = new ProductGallery;
                    $productGallery->product_id = $id;
                    $productGallery->image = $galleryImage;
                    $productGallery->save();
                }
            }
            return redirect()->route('product.view')->with('success', 'Product Successfully updated');
        } else {
            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->sub_subcategory_id = $request->sub_subcategory_id;
            $product->brand_id = $request->brand_id;
            $product->product_feature = implode(',', $request->product_feature);
            $product->product_name = $request->product_name;
            $product->slug = Str::slug($request->product_name);
            $product->short_desc = $request->short_desc;
            $product->long_desc = $request->long_desc;
            $product->sku = $request->sku;
            $product->tags = $request->tag;
            // $product->shipping = $request->shipping;
            $product->update();
            if ($request->imageGallery) {
                $imagesGallery = $request->imageGallery;
                foreach ($imagesGallery as $image) {
                    $galleryImage = rand() . '.' . $image->extension();
                    $image->move(public_path('uploads/products/gallery/'), $galleryImage);
                    $productGallery = ProductGallery::where('product_id', $product->id)->first();
                    $path = public_path('uploads/products/gallery/') . $productGallery->image;
                    if (file_exists($path)) {
                        @unlink($path);
                    }
                    $productGallery->delete();
                    $productGallery = new ProductGallery;
                    $productGallery->product_id = $id;
                    $productGallery->image = $galleryImage;
                    $productGallery->save();
                }
            }
            return redirect()->route('product.view')->with('success', 'Product Successfully updated');
        }
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


    public function variantProductStore(Request $request)
    {
        try {
            if (!empty($request->price ?? 0)) {
                foreach ($request->price as $key => $price) {

                    $productVerify = Variant::where('product_id', $request->product_id)->first();

                    $variant = new Variant();
                    $variant->product_id = $request->product_id;
                    $variant->size = $request->size[$key];
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
                            $filename = time() . '_' . uniqid() . '.' . $image->extension();
                            $path = 'uploads/products/variant/';
                            $image->move($path, $filename);

                            $variantImage = new VariantImageGallery();
                            $variantImage->variant_id = $variant->id;
                            $variantImage->product_id = $request->product_id;
                            $variantImage->image = $path . $filename;
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




    //rest Api Start
    public function viewAll()
    {

        $products = Product::orderByDesc('id')->with('variants.variantImage', 'product_tags', 'productStock', 'productdetails', 'variantImage')->where('status', 1)->get();
        // dd($products);
        return response()->json([
            'status' => '200',
            'message' => 'Product List',
            'data' => $products,
        ]);
    }

    public function show($id)
    {
        $products = Product::with('variants.variantImage', 'product_tags', 'productStock', 'productdetails', 'variantImage')->where('id', $id)->first();

        return response()->json([
            'status' => '200',
            'message' => 'Product Search',
            'data' => $products,
            'ID' => $id,
        ]);
    }
}

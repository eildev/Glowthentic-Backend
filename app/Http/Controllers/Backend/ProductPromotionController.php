<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\ProductPromotion;
use App\Models\Variant;
use App\Models\Category;
use Validator;
use Exception;
class ProductPromotionController extends Controller
{

    public function index()
    {

        return view('backend.promotionProduct.index');
    }


    public function create(){
        $product = Product::where('status', 1)->get();
        $category=Category::where('status', 1)->get();
        $promotion = Coupon::where('type','promotion')->get();
        // $variant=Variant::all();
        return view('backend.promotionProduct.create',compact('product','category','promotion'));
    }
    public function getProductPromotion(){
        $product = Product::where('status', 1)->get();
        $promotion = Coupon::where('type','promotion')->get();
        $variant=Variant::all();

        return response()->json([
            'product' => $product,
            'promotion' => $promotion,
            'variant'=>$variant
        ]);
    }

    public function store(Request $request){

        //   dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'product_id' => 'required',
        //     'promotion_id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }
        // try{
        //      $product = new ProductPromotion();
        //     $product->product_id = $request->product_id;
        //     $product->promotion_id = $request->promotion_id;
        //     $product->variant_id = $request->variant_id;
        //     $product->save();

        //     return response()->json([
        //         'status'=>200,
        //         'message'=>'Data Saved Successfully'
        //     ]);
        // }
        // catch (Exception $e) {
        //     return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        // }

        try{
            if ($request->product_id) {
                foreach ($request->product_id as $key => $product_id) {

                    $productCategory = Product::where('id', $product_id)->value('category_id');

                    $exists = ProductPromotion::where('category_id', $productCategory)
                        ->exists();


                        $variants = $request->variant_id[$product_id] ?? [];
                        
                    if (!$exists && $request->category_id!= $productCategory) {
                        $productPromotion = new ProductPromotion();
                        $productPromotion->product_id = $product_id;
                        $productPromotion->promotion_id = $request->promotion_id[0];
                        $productPromotion->variant_id = json_encode($variants);

                        $productPromotion->save();
                    }
                }
            }

            if ($request->category_id) {
                foreach ($request->category_id as $key => $category_id) {

                        $productPromotion = new ProductPromotion();
                        $productPromotion->category_id = $category_id;
                        $productPromotion->promotion_id = $request->promotion_id[0];
                        $productPromotion->save();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Saved Successfully'
            ]);

            }

      catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

    }

    public function view(){
        $productPromotion = ProductPromotion::with('product','coupon','variant')->get();
        //   dd($productPromotion);
        return response()->json([
            'status'=>200,
            'productPromotion'=>$productPromotion
        ]);
    }

    public function edit($id){
        $productPromotion = ProductPromotion::find($id);
        $product = Product::where('status', 1)->get();
        $promotion = Coupon::where('type','promotion')->get();
        $variant=Variant::where('product_id',$productPromotion->product_id)->get();
        return response()->json([
            'status'=>200,
            'productPromotion'=>$productPromotion,
            'product'=>$product,
            'variant'=>$variant,
            'promotion'=>$promotion
        ]);
    }


    public function update(Request $request){

        try{
            $product = ProductPromotion::find($request->id);
            $product->product_id = $request->product_id;
            $product->promotion_id = $request->promotion_id;
            $product->variant_id = $request->variant_id;
            $product->save();
            return response()->json([
                'status'=>200,
                'message'=>'Data Updated Successfully'
            ]);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function delete(Request $request){
        try{
            $product = ProductPromotion::find($request->id);
            $product->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Data Deleted Successfully'
            ]);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

    }

    //rest Api
    public function show($id){
        $productPromotion = ProductPromotion::find($id);
        return response()->json([
            'status'=>200,
            'messege'=>'Product Promotion search',
            'productPromotion'=>$productPromotion
        ]);
    }

    public function getProductPromotionVariant(Request $request){
        $product_id = $request->product_id;
        $variant = Variant::where('product_id', $product_id)->get();
        return response()->json([
            'status'=>200,
            'variant'=>$variant
        ]);
    }

    public function productPromotionVariantShow(Request $request){
        try{
            if($request->product_id){
                $product_id=Product::with('variants')->find($request->product_id);
                // $variant=Variant::where('product_id',$product_id->id)->get();
            }

            $promotion=Coupon::where('id',$request->promotion_id)->first();


            return response()->json([
                'status'=>200,
                // 'variant'=>$variant??null,
                'product'=>$product_id??null,
                'promotion'=>$promotion,

            ]);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

    }

    public function productPromotionCategoryShow(Request $request){
        try{
            if($request->category_id){
                $category_id=Category::find($request->category_id);
                $promotion=Coupon::where('id',$request->promotion_id)->first();
                return response()->json([
                    'status'=>200,
                    'category'=>$category_id,
                    'promotion'=>$promotion,
                ]);

            }
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

}
}

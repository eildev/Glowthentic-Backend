<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\ProductPromotion;
use App\Models\Variant;
use Validator;
class ProductPromotionController extends Controller
{

    public function index()
    {

        return view('backend.promotionProduct.index');
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

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'promotion_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
             $product = new ProductPromotion();
            $product->product_id = $request->product_id;
            $product->promotion_id = $request->promotion_id;
            $product->variant_id = $request->variant_id;
            $product->save();

            return response()->json([
                'status'=>200,
                'message'=>'Data Saved Successfully'
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
}

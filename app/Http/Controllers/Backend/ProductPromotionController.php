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
use App\Models\VariantPromotion;
use Exception;
class ProductPromotionController extends Controller
{

    public function index()
    {
        $productPromotion = ProductPromotion::with(['product', 'coupon', 'category'])
        ->get()
        ->groupBy('promotion_id');


        return view('backend.promotionProduct.index', compact('productPromotion'));
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
        $promotion = Coupon::where('type','promotion')->where('status','Active')->get();
        $variant=Variant::all();

        return response()->json([
            'product' => $product,
            'promotion' => $promotion,
            'variant'=>$variant
        ]);
    }

    public function store(Request $request){



        try{
            if ($request->product_id) {
                foreach ($request->product_id as $key => $product_id) {

                    $productCategory = Product::where('id', $product_id)->value('category_id');

                    $exists = ProductPromotion::where('category_id', $productCategory)
                        ->where('promotion_id', $request->promotion_id[0])
                        ->latest()
                        ->exists();
                        $variants = $request->variant_id[$product_id] ?? [];
                        if (!$exists && $productCategory !== (int) $request->category_id) {
                            $productPromotion = new ProductPromotion();
                            $productPromotion->product_id = $product_id;
                            $productPromotion->promotion_id = $request->promotion_id[0];
                            // $productPromotion->variant_id = json_encode($variants);
                            $productPromotion->save();
                            foreach($variants as $variant){
                                $variantPromotion = new VariantPromotion();
                                $variantPromotion->variant_id = $variant;
                                $variantPromotion->product_id = $product_id;
                                $variantPromotion->promotion_id = $request->promotion_id[0];
                                $variantPromotion->save();
                            }

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

        $promotionProduct = ProductPromotion::with('category','product','coupon')->where('promotion_id',$id)->get();
        // $variant_promotion = VariantPromotion::with('variant')->where('promotion_id',$id)->get();

        $product = Product::where('status', 1)->get();
        $categories=Category::where('status', 1)->get();
        $promotion = Coupon::where('type','promotion')->get();
        return view('backend.promotionProduct.edit',compact('promotionProduct','product','categories','promotion'));
    }


    public function update(Request $request)
    {
        try {
            // Ensure promotion_id is a single integer if it's an array
            // dd($request->all());
            $promotionId = is_array($request->promotion_id) ? (int) $request->promotion_id[0] : (int) $request->promotion_id;

            if ($request->product_id) {
                foreach ($request->product_id as $key => $product_id) {
                    $productPromotion = ProductPromotion::where('product_id', $product_id)
                        ->where('promotion_id', $promotionId)
                        ->first();

                    if ($productPromotion) {
                        $productPromotion->product_id = $product_id;
                        $productPromotion->promotion_id = $promotionId;
                        // $productPromotion->variant_id = json_encode($request->variant_id[$product_id] ?? []);
                        $variants = $request->variant_id[$product_id] ?? [];
                        $productPromotion->save();
                        foreach($variants as $variant){
                            // dd($variant);
                            $variantPromotion = VariantPromotion::where('variant_id', $variant)
                            ->where('product_id', $product_id)
                            ->where('promotion_id', $promotionId)
                            ->first();

                            if (!$variantPromotion) {

                                 $variantPromotion = new VariantPromotion();
                                $variantPromotion->variant_id =$variant;
                                $variantPromotion->product_id = $product_id;
                                $variantPromotion->promotion_id = $promotionId;

                                $variantPromotion->save();
                            }

                            // $variantPromotion = new VariantPromotion();
                            // $variantPromotion->variant_id = $variant;
                            // $variantPromotion->product_id = $product_id;
                            // $variantPromotion->promotion_id = $request->promotion_id[0];
                            // $variantPromotion->save();
                        }

                    } else {
                        $productPromotion = new ProductPromotion();
                        $productPromotion->product_id = $product_id;
                        $productPromotion->promotion_id = $promotionId;
                        // $productPromotion->variant_id = json_encode($request->variant_id[$product_id] ?? []);
                        $variants = $request->variant_id[$product_id] ?? [];
                        foreach($variants as $variant){
                            $variantPromotion = new VariantPromotion();
                            $variantPromotion->variant_id = $variant;
                            $variantPromotion->product_id = $product_id;
                            $variantPromotion->promotion_id = $request->promotion_id[0];
                            $variantPromotion->save();
                        }

                        $productPromotion->save();
                    }
                }
            }

            if ($request->category_id) {
                foreach ($request->category_id as $key => $category_id) {
                    $productPromotion = ProductPromotion::where('category_id', $category_id)
                        ->where('promotion_id', $promotionId)
                        ->first();

                    if ($productPromotion) {
                        $productPromotion->category_id = $category_id;
                        $productPromotion->promotion_id = $promotionId;
                        $productPromotion->save();
                    } else {
                        $productPromotion = new ProductPromotion();
                        $productPromotion->category_id = $category_id;
                        $productPromotion->promotion_id = $promotionId;
                        $productPromotion->save();
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Updated Successfully'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }


    public function delete(Request $request){
        try{
            $product = ProductPromotion::find($request->id);
            $variantPromotion = VariantPromotion::where('product_id',$product->product_id)->get();

            foreach($variantPromotion as $variant){
                $variant->delete();
            }
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

public function variantDelete(Request $request){
    try{

         $variantPromotion = VariantPromotion::where('variant_id',$request->variant_id)->where('product_id',$request->product_id)->first();
        $variantPromotion->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Data Deleted Successfully'
        ]);
    }
    catch (Exception $e) {
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
    }
}

  public function Promotiondelete(Request $request){
    try{
        $promotion = ProductPromotion::where('id',$request->id)->first();
        $promotionVariant = VariantPromotion::where('product_id', $promotion->product_id)->get();
        foreach($promotionVariant as $variant){
            $variant->delete();
        }
        $promotion->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Data Deleted Successfully'
        ]);
    }
    catch (Exception $e) {
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
    }
}


   public function PromotionView($promotion_id){
    $promotionProduct = ProductPromotion::with('category','product','coupon')->where('promotion_id',$promotion_id)->get();

    return view('backend.promotionProduct.view',compact('promotionProduct'));

   }
}

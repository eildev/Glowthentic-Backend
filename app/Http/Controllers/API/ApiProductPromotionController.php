<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\ProductPromotion;
use App\Models\Variant;
class ApiProductPromotionController extends Controller
{
    public function view(){
        $productPromotion = ProductPromotion::with('product','coupon','variant')->get();
        //   dd($productPromotion);
        return response()->json([
            'status'=>200,
            'productPromotion'=>$productPromotion
        ]);
    }

    public function show($id){
        $productPromotion = ProductPromotion::find($id);
        return response()->json([
            'status'=>200,
            'messege'=>'Product Promotion search',
            'productPromotion'=>$productPromotion
        ]);
    }

}

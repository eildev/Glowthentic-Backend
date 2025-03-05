<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductStock;
class ProductStockManageController extends Controller
{

    public function index(){
       $product = Product::where('status', 1)->get();
        return view('backend.ProductStockManage.index',compact('product'));
    }

    public function getVariant($id){
         $variant = Variant::where('product_id', $id)->get();

         return response()->json([
            'status' => 200,
            'variant' => $variant
         ]);
    }

    public function getVariantRow($id){
        $variant = Variant::where('id', $id)->with('product','productStock')->first();

        $stockQuantity=$variant->productStock->StockQuantity??0;
        // dd($stockQuantity);
        return response()->json([
           'status' => 200,
           'variant' => $variant,
           'stockQuantity' => $stockQuantity??0
        ]);
    }

    public function updateMultipleStock(Request $request){

        try{
            $updatestock=[];
        if($request->variant_id){
            foreach($request->variant_id as $key => $variant_id){
               $productStock = ProductStock::where('variant_id', $variant_id)->where('product_id',$request->product_id[$key])->first();

               if($productStock){
                $productStock->StockQuantity =$productStock->StockQuantity + $request->quantity[$key];
                $productStock->save();
               }

               else{
                $productStock = new ProductStock();
                $productStock->variant_id = $variant_id;
                $productStock->product_id = $request->product_id[$key];
                $productStock->StockQuantity = $request->quantity[$key];
                $productStock->save();
               }
               $updatestock[]=$productStock;
            }
            return response()->json([
                'status' => 200,
                'message' => 'Stock Quantity Updated Successfully',
                'updatestock' => $updatestock
            ]);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function view(){
        $productStock = ProductStock::with('variant','product')->get();
        return view('backend.ProductStockManage.view',compact('productStock'));
    }
}

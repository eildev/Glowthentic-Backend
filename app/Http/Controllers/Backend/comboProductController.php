<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComboProduct;
use App\Models\Combo;
use App\Models\Product;
use App\Models\Variant;
use Validator;
use Illuminate\Http\Request;

class comboProductController extends Controller
{
    public function index(){

        return view('backend.comboProduct.index');
    }

   public function view(){
    $comboProduct=ComboProduct::with('product','combo','variant')->get();

    return response()->json([
        'status'=>200,
         'message'=>'Data Get Successfully',
        'comboProduct'=>$comboProduct

    ]);
   }

   public function product_and_combo(){
    $product=Product::where('status',1)->get();
    $combo=Combo::where('status','active')->get();

    return response()->json([
        'status'=>200,
        'product'=>$product,
        'combo'=>$combo,
        'message'=>'Data Get Successfully'
    ]);

   }


//    public function store(Request $request){
//     $validator = Validator::make($request->all(), [
//         'product_id' => 'required',
//         'combo_id' => 'required',
//         'quantity' => 'required',
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'status' => 422,
//             'errors' => $validator->messages(),
//         ], 422);
//     }



//     $comboProduct = new ComboProduct();
//     $comboProduct->product_id = $request->product_id;
//     $comboProduct->combo_id = $request->combo_id;
//     $comboProduct->quantity = $request->quantity;
//     $comboProduct->save();

//     return response()->json([
//         'status' => 200,
//         'message' => 'Data Saved Successfully'
//     ]);
// }

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'product_id' => 'required',
        'combo_id' => 'required',
        'quantity' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages(),
        ], 422);
    }


    $existingCombo = ComboProduct::where('product_id', $request->product_id)
                                //  ->where('combo_id', $request->combo_id)
                                 ->first();

    if ($existingCombo && !$request->has('force_save')) {
        return response()->json([
            'status' => 409,
            'message' => 'This product is already in the combo. Do you want to continue?',
        ], 409);
    }
    $comboProduct = new ComboProduct();
    $comboProduct->product_id = $request->product_id;
    $comboProduct->variant_id = $request->variant_id;

    $comboProduct->combo_id = $request->combo_id;
    $comboProduct->quantity = $request->quantity;
    $comboProduct->save();

    return response()->json([
        'status' => 200,
        'message' => 'Data Saved Successfully'
    ]);
}







 public function edit($id){
    $comboProduct=ComboProduct::find($id);
    $product=Product::where('status',1)->get();
    $combo=Combo::where('status','active')->get();
    $variant=Variant::where('product_id',$comboProduct->product_id)->get();

    return response()->json([
        'status'=>200,
        'comboProduct'=>$comboProduct,
        'product'=>$product,
        'combo'=>$combo,
        'variant'=>$variant,
        'message'=>'Data Get Successfully'
    ]);
}

 public function update(Request $request){

    $comboProduct = ComboProduct::findOrFail($request->comboProduct_id);
    $comboProduct->product_id = $request->product_id;
    $comboProduct->combo_id = $request->combo_id;
    $comboProduct->quantity = $request->quantity;
    $comboProduct->variant_id = $request->variant_id;
    $comboProduct->save();
    return response()->json([
        'status'=>200,
        'message'=>'Data Update Successfully'
    ]);

 }

 public function delete(Request $request){
    $comboProduct=ComboProduct::findOrFail($request->id);
    $comboProduct->delete();
    return response()->json([
        'status'=>200,
        'message'=>'Data Delete Successfully'
    ]);
 }

 public function statusUpdate(Request $request){
    $comboProduct=ComboProduct::findOrFail($request->id);
    if($comboProduct->status=='active'){
        $comboProduct->status='inactive';
    }else{
        $comboProduct->status='active';
    }
    $comboProduct->save();
    return response()->json([
        'status'=>200,
        'message'=>'Status Update Successfully'
    ]);
 }

 //start rest api

}



<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComboProduct;
use App\Models\Combo;
use App\Models\Product;
use App\Models\Variant;
class ApiComboProductController extends Controller
{
    public function view(){
        $comboProduct=ComboProduct::with('product','combo','variant')->get();

        return response()->json([
            'status'=>200,
             'message'=>'Data Get Successfully',
            'comboProduct'=>$comboProduct

        ]);
       }


  public function show($id){
    $comboProduct=ComboProduct::where('status','active')->with('product','combo')->find($id);
    return response()->json([
        'status'=>200,
        'comboProduct'=>$comboProduct,
        'message'=>'Data Search Successfully'
    ]);
  }
}

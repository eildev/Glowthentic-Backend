<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
class ApiBrandController extends Controller
{
    public function view(){
        $Brands = Brand::all();
        return response()->json([
            'status'=>200,
            'Brands'=>$Brands,
            'message'=>'Brands Get Successfully'
        ]);
    }

    public function showIndividual($id){
        $Brands = Brand::find($id);
        return response()->json([
            'status'=>200,
            'Brands'=>$Brands,
            'message'=>'Brands Search Successfully'
        ]);
    }
}

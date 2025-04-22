<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SizeModel;
class SizeController extends Controller
{


  public function SizeView(){

            $sizes = SizeModel::all();
            return view('backend.products.size.view', compact('sizes'));

    }





    public function SizeStore(Request $request){
        try{
            $size = new SizeModel();
            $size->size_name = $request->size_name;
            $size->save();
            return response()->json([
                'status' => 200,
                'message' => 'Size Added Successfully',
                'data' => $size
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function SizeGet(){
        try{
            $sizes = SizeModel::select('id','size_name')->get(); // Only send what you need

            return response()->json([
                'status' => 200,
                'message' => 'Size Get Successfully',
                'size' => $sizes
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function SizeDelete(Request $request){
        try{
            $size = SizeModel::find($request->id);
            $size->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Size Deleted Successfully',
                'data' => $size
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function SizeUpdate(Request $request){
        try{

            $size = SizeModel::find($request->id);
            $size->size_name = $request->size_name;
            $size->save();
            return response()->json([
                'status' => 200,
                'message' => 'Size Updated Successfully',
                'data' => $size
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}

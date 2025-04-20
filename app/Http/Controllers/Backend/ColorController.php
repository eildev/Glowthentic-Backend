<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColorModel;
class ColorController extends Controller
{


    public function ColorView(){
        return view('backend.products.color.view');

    }
    public function ColorStore(Request $request){
        try{
            $color = new ColorModel();
            $color->color_name = $request->color_name;
            $color->save();
            return response()->json([
                'status' => 200,
                'message' => 'Color Added Successfully',
                'data' => $color
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function ColorGet(){
        try{
           
            $colors = ColorModel::select('color_name')->get(); // Only send what you need

            return response()->json([
                'status' => 200,
                'message' => 'Color Get Successfully',
                'color' => $colors
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

  public function ColorDelete(Request $request){
        try{
            $color = ColorModel::find($request->id);
            $color->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Color Deleted Successfully',
                'data' => $color
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function ColorUpdate(Request $request){
        try{
            $color = ColorModel::find($request->id);
            $color->color_name = $request->color_name;
            $color->save();
            return response()->json([
                'status' => 200,
                'message' => 'Color Updated Successfully',
                'data' => $color
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}

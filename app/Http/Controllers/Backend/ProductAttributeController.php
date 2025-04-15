<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;
class ProductAttributeController extends Controller
{
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'field_name' => 'required',
                'data_type' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ]);
            }

            $extraField = new Attribute();
            $extraField->field_name = $request->field_name;
            $extraField->data_type = strtolower($request->data_type);

            if ($extraField->data_type == 'string') {
                $extraField->data_type = 'string';
            }

            if ($extraField->data_type == 'json') {
                $extraField->options = json_encode($request->multi_input);
            }

            // Save entry
            $extraField->save();

            return response()->json([
                'status' => 200,
                'message' => 'Data Type Added Successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong',
                'error' => $e->getMessage(), // Debug error message
            ]);
        }
    }



    public function getExtraField($id){

        $extraField=Attribute::where('id',$id)->first();
        return response()->json([
            'status'=>200,
            'extraField'=>$extraField
        ]);
      }

      public function getExtraFieldInfoProductPageShow(){
        $extraField=Attribute::all();
        // dd($extraField);
        return response()->json([
            'status'=>200,
            'extraField'=>$extraField
        ]);
      }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Http\Request;

class ApiFeatureController extends Controller
{
    public function viewAll()
    {
        try{
            $features = Features::get();

            return response()->json([
                'status' => 200,
                'features' => $features
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function show($id){
        try{
            $feature = Features::find($id);
            return response()->json([
                'status' => 200,
                'feature' => $feature
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}

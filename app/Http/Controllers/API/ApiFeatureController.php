<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Http\Request;

class ApiFeatureController extends Controller
{
    public function viewAll()
    {
        $features = Features::get();

        return response()->json([
            'status' => 200,
            'features' => $features
        ]);
    }
}
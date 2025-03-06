<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageGallery;
use App\Models\HomeBanner;
class ApiHomeBannerController extends Controller
{
    public function viewAll(){
        $banners = HomeBanner::get();
        return response()->json([
            'banners' => $banners,
            'status' => '200',
            'message' => 'banner fetched successfully',
        ]);
    }

    public function show($id){
        $banner = HomeBanner::findOrFail($id);
        return response()->json([
            'banner' => $banner,
            'status' => '200',
            'message' => 'banner Search successfully',
        ]);
    }
}

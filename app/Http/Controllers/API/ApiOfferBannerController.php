<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanner;
class ApiOfferBannerController extends Controller
{
    public function viewAll(){
        $banners = OfferBanner::all();
        return response()->json([
            'offerbanners' => $banners,
            'status' => '200',
            'message' => 'Offerbanner fetched successfully',
        ]);
    }

    public function show($id){
        $banner = OfferBanner::find($id);
        return response()->json([
            'offerbanner' => $banner,
            'status' => '200',
            'message' => 'offerbanner Search successfully',
        ]);
    }
}

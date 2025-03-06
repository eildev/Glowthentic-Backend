<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanner;
class ApiOfferBannerController extends Controller
{
    public function viewAll(){
        try{
            $banners = OfferBanner::with('images')->get();
            return response()->json([
                'offerbanners' => $banners,
                'status' => '200',
                'message' => 'Offerbanner fetched successfully',
            ]);
        }
      catch(\Exception $e){
            return response()->json([
                'status' => '500',
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function show($id){

        try{
            $banner = OfferBanner::with('images')->find($id);
            return response()->json([
                'offerbanner' => $banner,
                'status' => '200',
                'message' => 'offerbanner Search successfully',
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => '500',
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiWishListController extends Controller
{

    public function addWishList(Request $request){
        $user = auth('sanctum')->user();
      

    }
}

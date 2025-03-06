<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
use Auth;
class ApiWishListController extends Controller
{
    public function addWishList(Request $request)
    {
        try {


            $request->validate([
                'product_id' => 'required|integer',
                'variant_id' => 'nullable|integer',
            ]);


            $wishlist = new WishList();
            $wishlist->user_id = $request->user_id;
            $wishlist->product_id = $request->product_id;
            $wishlist->variant_id = $request->variant_id;
            $wishlist->loved = 1;
            $wishlist->save();

            return response()->json([
                'status' => 200,
                'message' => 'Wishlist added successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500, // Internal Server Error
                'error' => $e->getMessage()
            ]);
        }
    }
    public function getWishList($user_id){
        try {
            $wishlist = WishList::where('user_id', $user_id)->with('wishlistProduct','variant')->get();
            return response()->json([
                'status' => 200,
                'wishlist' => $wishlist
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500, // Internal Server Error
                'error' => $e->getMessage()
            ]);
        }
    }
}

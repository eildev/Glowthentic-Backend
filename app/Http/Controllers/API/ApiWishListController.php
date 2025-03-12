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
            if($request->user_id){
                $wishlist->user_id = $request->user_id;
            }
          else if($request->session_id){
            $wishlist->session_id = $request->session_id;
          }
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
    public function getWishList($user_id_or_session_id){
        try {
            $wishlist = WishList::where('user_id', $user_id_or_session_id)->OrWhere('session_id',$user_id_or_session_id)->with('wishlistProduct','variant','variant.variantImage')->get();
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


    public function deleteWishList($id){
        try {
            $wishlist = WishList::find($id);

            if($wishlist){
                $wishlist->delete();
                
                return response()->json([
                    'status' => 200,
                    'message' => 'Wishlist deleted successfully'
                ]);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Wishlist not found'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500, // Internal Server Error
                'error' => $e->getMessage()
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class WishListController extends Controller
{
    public function wishlistAdd(Request $request)
    {
        $checkedLoved = Wishlist::where("user_id", Auth::user()->id)->where('product_id', $request->product_id)->latest()->first();
        if (!$checkedLoved) {
            $loved = new WishList;
            $loved->user_id = Auth::user()->id;
            $loved->product_id = $request->product_id;
            $loved->save();
            return response()->json([
                "status" => 200,
                "loved_id" => $loved->id,
                'message' => "successfully Added to your WishList",
            ]);
        } else {
            $wishlist = WishList::where('product_id', $request->product_id);
            $wishlist->delete();
            return response()->json([
                "status" => 500,
                'message' => "Removed from your WishList",
            ]);
        }
    }


    // WishList Delete function
    public function wishlistDelete($id)
    {
        $wishlist = WishList::findOrFail($id);
        $wishlist->delete();
        return back()->with('danger', 'Wishlist Successfully deleted');
    }
}

<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\BillingInfo;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function addToCart(Request $request){
        // @dd($request->all());
        $product = Product::findOrFail($request->product_id);
        if($product->varient[0]->stock_quantity > 0) {
            Cart::add([
            'id' => $request->product_id,
            'name' => $product->product_name,
            'qty' => $request->pr_quantity,
            'price' => $request->selling_price,
            'weight' => $request->weight,
            'options' => [
                'image' => $product->product_image,
                'unit' => $request->unit,
                'variant_id' => $request->variant_id
            ]
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Product added successfully',
            'cartData' => Cart::content()
        ]);

        } else {
            return response()->json([
            'status' => 400,
            'message' => 'Product Stock Out',
        ]);
        }


    }



    public function showCart()
    {
        $products = Cart::content();
        return response()->json([
            'status' => '200',
            'cartData' => $products,
        ]);
    }

    public function showCartProducts()
    {
        $products = Cart::content();
        return view('frontend.e-com.cart', compact('products'));
    }

    public function removeCartProduct($id)
    {
        // dd($id);
        $rowId = $id;
        Cart::remove($rowId);
        return response()->json([
            'status' => '200',
            'message' => 'Product Remove successfully',
        ]);
    }

    public function cartPageRemoveItem($id)
    {
        // dd($id);
        $rowId = $id;
        Cart::remove($rowId);
        return back()->with('success', 'Product Remove successfully');
    }

    public function cartPageUpdateItem(Request $request, $id)
    {
        // dd($request);
        $quantity = $request->quantity;
        Cart::update($id, $quantity);
        // $rowId = Cart::content()->rowId;
        // dd(Cart::content());
        // return response()->json([
        //     'status' => '200',
        //     'message' => 'Product Quantity Update successfully',
        //     'id' => $id,
        // ]);
        return redirect()->back()->with('success', 'Product Quantity Update successfully');
    }


    public function checkout()
    {
        // dd(Auth::user());
        // $billingInfo = BillingInfo::where('user_id', Auth::user()->id)->first();
        // if (!$billingInfo) {
        //  return view('frontend.e-com.checkout', compact('billingInfo'));
        // }
        return view('frontend.e-com.checkout');
    }


}

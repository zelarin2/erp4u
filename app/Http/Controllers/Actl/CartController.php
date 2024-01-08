<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{
    public function CartAll(){
        $carts = Cart::latest()->get();
        return view('backend.cart.cart_all', compact('carts'));
    }
    public function CartAdd(){
       /* $products = Product::latest()->get();
        return view('backend.cart.cart_all', compact('products'));*/
        $products = Product::find($item->description);
        
        return redirect()->route('cart.all')->with($notification);
    }
    public function CartStore(Request $request){
        try{
            Cart::insert([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Cart Inserted Successfully.',
                'alert-type' => 'success',
            );
        } catch(\Exception $e) {
            $notification = array(
                'message' => 'Cart Inserted Insuccessfully.',
                'alert-type' => 'error',
            );
        }
        return redirect()->route('cart.all')->with($notification);
    }

}

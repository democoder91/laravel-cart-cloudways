<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {

        return view('cart.cart',[

        ]);
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cartItems = session()->get('cartItems', []);


        if (isset ($cartItems[$product->name])) {
            $cartItems [$product->name] ['quantity'] ++;
        } else {
            $cartItems[$product->name] = [
                'name'=>$product->name,
                "id" => $product->id,
                "brand" => $product->brand,
                "image_path" => $product->image_path,
                "details" => $product->details,
                "price" => $product->price,
                "quantity" => 1
            ];

        }
        session()->put('cartItems', $cartItems);


        return redirect('/cart')->with('success', 'Product added to cart');
//
    }
    public function delete(Request $request)
    {
        if($request->id){
            $cartItems = session()->get('cartItems');
            if(isset($cartItems[$request->id])) {
                unset($cartItems[$request->id]);
                session()->put('cartItems', $cartItems);

            }
            return back()->with('success', 'Product deleted successfully');
        }
    }
    public function update(Request $request)
    {
        if ($request->id && $request->quantity){
            $cartItems = session()->get('cartItems');
            $cartItems[$request->id]['quantity'] = $request->quantity;
            session()->put('cartItems', $cartItems);
            return back();

        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->with('product')->get();
        $cart = Cart::toBase()->get();

        return view('frontend.cart', compact('cart'));
    }
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {return response()->json( ['status' => 'Login to continue']);}
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        $product = Product::find($request->product_id);
        $maxToBuy = $product?->max_to_buy ?? 10;
        if ($cart) {
            $request->validate([
                'quantity' => 'required|numeric|min:1',
            ]);
            $newQuantity = $cart->quantity + $request->quantity;
            if ($newQuantity > $maxToBuy || $newQuantity > $product->qty) {
                $message = $newQuantity > $maxToBuy ? 
                'Maximum ' . $maxToBuy . ' quantity allowed you have in your cart '.$cart->quantity . ' you can add only ' .$maxToBuy-$cart->quantity :
                'Only ' . $product->qty . ' in stock you have in your cart '.$cart->quantity . ' you can add only' . $product->qty-$cart->quantity;
                return response()->json(['status' => $message]);
            }
            $cart->update(['quantity' => $newQuantity]);
            $message = $product->name . ' added to cart successfully now you have ' . $newQuantity.' '.$product->name . ' in your cart';
            return response()->json(['status' => $message]);
        } else {
            $requestedQuantity = $request->quantity;
            $availableQuantity = $product->qty;
            if ($requestedQuantity > $maxToBuy || $requestedQuantity > $availableQuantity) {
                $message = $requestedQuantity > $maxToBuy ? 'Maximum ' . $maxToBuy . ' quantity allowed' : 'Only ' . $availableQuantity . ' in stock';
                return response()->json(['status' => $message]);
            }
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'quantity' => $requestedQuantity,
            ]);
            return response()->json(['status' => $product->name . ' added to cart successfully now you have ' . $requestedQuantity.' ' .$product->name . ' in your cart']);
        }
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        Cart::find($id)->delete();
        return response()->json(['status' => 'Product removed from cart']);
    }
    public function updateQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        Cart::where('id', $id)->update(['quantity' => $quantity]);
        return response()->json(['status' => 'Quantity updated successfully']);
    }

}

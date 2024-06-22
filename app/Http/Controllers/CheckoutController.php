<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\wishlist;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $oldCartItems = Cart::where('user_id', auth()->id())->get();
        foreach ($oldCartItems as $item) {
            if (!Product::where('id', $item->product_id)->where('qty', '>=', $item->quantity)->exists()) {
                $data = ['product_id' => $item->product_id];
                
                $data['user_id'] = auth()->user()->id;
                wishlist::UpdateOrCreate($data);
                $removeItem = Cart::where('user_id', auth()->id)->where('product_id', $item->product_id)->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id', auth()->id())->get();
        return view('frontend.checkout', compact('cartItems'));
    }
    public function placeOrder(Request $request)
    {
        $user_data = $request->validate([
            'fname' => 'required|string'
            , 'lname' => 'required|string'
            , 'email' => 'required|string'
            , 'phone' => 'required|string'
            , 'address1' => 'required|string'
            , 'address2' => 'required|string'
            , 'city' => 'required|string'
            , 'state' => 'required|string'
            , 'country' => 'required|string'
            , 'zipCode' => 'required|string'
        ]);
        $user_id=Auth::user()->id;
        if (Auth::user()->address1==null) {
            User::where('id',$user_id)->update($user_data);
        }
        $data=$user_data;
        $data['user_id'] =$user_id;
        $data['message'] =$request->input('message');
        $data['tracking_number'] ='order' . round(1111, 9999);
        
        $order = Order::create($data);
        $cartItems = Cart::where('user_id', auth()->id())->get();
        foreach ($cartItems as $item) {
            ProductOrder::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->quantity,
                'price' => $item->product->selling_price,
            ]);
            $product=Product::where('id', $item->product_id)->first();
            $product->qty -=$item->quantity;
            $product->update();
        }
        Cart::destroy($cartItems);
        return redirect('/')->with('status',"Order placed Successfully");        
    }
}

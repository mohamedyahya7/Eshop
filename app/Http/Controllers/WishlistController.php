<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller{

    public function index(){
        $wishlists = wishlist::with('product')->where('user_id',auth()->user()->id)->get();
        return view('frontend.wishlist',compact('wishlists'))->with('product_qty', Product::pluck('qty'));
    }

    public function addToWishlist(Request $request){
        $data= $request->validate([
            'product_id' => 'required'
        ]);
        $data['user_id'] = auth()->user()->id;
        wishlist::UpdateOrCreate($data);
        $product = Product::find($request->product_id);
        return response()->json(['status' => $product->name.' added to wishlist']);
    }

    public function removeFromWishlist(Request $request){
        $id = $request->id;
        wishlist::where('id',$id)->delete();
        return redirect()->back();
    }
}

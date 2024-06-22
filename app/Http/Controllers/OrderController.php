<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(){
      ;
        return view('frontend.order',compact('orders'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function SellerAllOrder()
    {
        $id = Auth::user()->id;
        $order = Order::where('buyer_id',$id)->get();
        return view('seller.order.order_all',compact('order'));
    }
}

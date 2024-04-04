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
        $order = Order::where('seller_id',$id)->latest()->paginate(10);
        return view('seller.order.order_all',compact('order'));
    }

    public function SellerDetailOrder($id)
    {
        $seller_id = Auth::user()->id;
        $order = Order::where('seller_id',$seller_id)->find($id);
        return view('seller.order.order_detail',compact('order'));
    }
}

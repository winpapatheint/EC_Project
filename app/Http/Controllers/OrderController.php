<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function sellerAllOrder()
    {
        $id = Auth::user()->id;
        $order = Order::where('seller_id', $id)
                  ->where('status', '!=', 'Cancel')
                  ->latest()
                  ->paginate(10);
        return view('seller.order.order_all',compact('order'));
    }

    public function sellerDetailOrder($id)
    {
        $seller_id = Auth::user()->id;
        $order = Order::where('seller_id',$seller_id)->find($id);
        return view('seller.order.order_detail',compact('order'));
    }

    public function updateOrderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->input('status');
        $order = Order::find($id);
        if(empty($order->confirmed_date))
        {
            $request->validate([
                'expected_from' => 'required|string|max:255',
                'expected_to' => 'required|string|max:255',
            ]);
            $order->expected_from = now();
            $order->expected_to = now();
            $order->confirmed_date = now();
            $order->status = 'Confirmed';
        }
        else
        {
            switch ($status) {
                case 'processing':
                    $order->processing_date = now();
                    $order->status = 'Processing';
                    break;
                case 'picked':
                    $order->picked_date = now();
                    $order->status = 'Picked';
                    break;
                case 'shipped':
                    $order->shipped_date = now();
                    $order->status = 'Shipped';
                    break;
                case 'delivered':
                    $order->delivered_date = now();
                    $order->status = 'Delivered';
                    break;
                default:
                    $order->cancel_date = now();
                    $order->status = 'Cancel';
                    break;
            }
        }
        $order->updated_by = Auth::user()->name;
        $order->save();

        // Save process record
        $process = new Process();
        $process->order_id = $id;
        $process->{$status . '_date'} = now();
        $process->created_at = now();
        $process->save();

        return back()->with('success', 'Order status updated successfully');

    }

    public function cancelOrder(Request $request)
    {
        $id = $request->id;
        $seller_id = Auth::user()->id;
        $order = Order::where('seller_id',$seller_id)->find($id);
        return view('seller.order.order_cancel',compact('order'));
    }

    public function cancelOrderReason(Request $request)
    {
        $request->validate([
            'cancelled_reason' => 'required|string|max:255',
        ]);

        $order = Order::find($request->id);
        $order->cancelled_reason = $request->cancelled_reason;
        $order->updated_at = now();
        $order->save();

        return redirect('/seller/orderlist');
    }


    public function orderTracking($id)
    {
        $order = Order::find($id);
        $process = Process::where('order_id',$id)->latest()->get();
        return view('seller.order.order_tracking',compact('order','process'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Process;
use Barryvdh\DomPDF\PDF;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function sellerAllOrder()
    {
        $limit = 10;
        $id = Auth::user()->created_by ?? Auth::id();

        $order = OrderDetail::with('order')
            ->where('seller_id', $id)
            ->where('status', '!=', 'Cancel')
            ->groupBy('order_id')
            ->selectRaw('order_id, MAX(created_at) as created_at, MAX(id) as id, MAX(amount) as amount, MAX(status) as status')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        $ttl = $order->total();
        $ttlpage = ceil($ttl / $limit);

        return view('seller.order.order_all', compact('order', 'ttl', 'ttlpage'));
    }


    public function sellerDetailOrder($id)
    {
        $sellerId = Auth::user()->created_by ?? Auth::id();
        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', 'orders.id')
            ->join('products', 'products.id', 'order_details.product_id')
            ->join('users', 'orders.seller_id', '=', 'users.id')
            ->with('prefecture')
            ->select('orders.id as order_id', 'order_details.id as order_detail_id','products.id as product_id','orders.*',
            'products.*','products.selling_price as price', 'order_details.*', 'orders.created_at as order_created_at',
            'order_details.name as order_details_name', 'order_details.phone as order_details_phone')
            ->where('users.id', $sellerId)
            ->where('orders.id', $id)
            ->get();
        dd($orderDetails);
        return view('seller.order.order_detail', compact('orderDetails'));
    }


    public function updateOrderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->input('status');
        $order = OrderDetail::find($id);
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
                case 'Processing':
                    $order->processing_date = now();
                    $order->status = 'Processing';
                    break;
                case 'Picked':
                    $order->picked_date = now();
                    $order->status = 'Picked';
                    break;
                case 'Shipped':
                    $order->shipped_date = now();
                    $order->status = 'Shipped';
                    break;
                case 'Delivered':
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

        $process = new Process();
        $process->order_id = $id;
        $process->{$status . '_date'} = now();
        $process->created_at = now();
        $process->save();

        $inquiry_email = 'info-test@asia-hd.com';
        $user = User::where('id', Auth::user()->id)->select('email', 'name')->first();

        $email = $user->email;
        $name = $user->name;
        $data = array('name'=>$name);
        if (!empty($request->email)) {
            $mail = Mail::send([], $data, function($message) use ($request, $inquiry_email,$name,$email) {
                $message->to($inquiry_email, 'Ecommerce ')->subject($name.'からの質問');
                $message->from($email,$name);
                $message->setBody("E commerce 公式サイトから、以下の通知がありました。
                \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                \r\n名前：　".$name."
                \r\n"."メールアドレス：　".$email."
                \r\n
                \r\n"."通知のお知らせ：　
                \r\n
                \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
            });
        }

        $notification = Notification::find(4);
        $newval = array('time' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        );
        $notification->update( $newval);

        $msg = ('Order status updated Successfully');
        return back()->with('success', $msg);

    }

    public function cancelOrder(Request $request)
    {
        $order_id = $request->id;
        $id = Auth::user()->created_by ?? Auth::id();
        $order = OrderDetail::where('seller_id',$id)->find($order_id);
        return view('seller.order.order_cancel',compact('order'));
    }

    public function cancelOrderReason(Request $request)
    {
        $request->validate([
            'cancelled_reason' => 'required|string|max:255',
        ]);

        $order = OrderDetail::find($request->id);
        $order->cancelled_reason = $request->cancelled_reason;
        $order->updated_at = now();
        $order->save();

        return redirect('/orderlist');
    }

    public function orderTracking($id)
    {
        $order = OrderDetail::find($id);
        $process = Process::where('order_id',$id)->latest()->get();
        return view('seller.order.order_tracking',compact('order','process'));
    }

    public function generatePDF($id)
    {
        $data = Order::find($id);
        $pdf = PDF::loadView('seller.order.invoice',compact('data'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

}

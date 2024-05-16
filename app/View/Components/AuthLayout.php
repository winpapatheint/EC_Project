<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuthLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $currentDate = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $totalcount = 0;


        $seller = DB::table('users')
                    ->select('users.id','users.*', DB::raw('TIMESTAMPDIFF(MINUTE, users.created_at, NOW()) AS minutes_ago'),
                    'users.created_at')
                    ->where('role','seller')
                    ->whereNotNull('email_verified_at')
                    ->latest('created_at')
                    ->first();
        $sellerhour = $seller->created_at ?? '';
        if($sellerhour)
        {
            $totalcount = 1 ?? 0;
        }

        $product = DB::table('products')
                    ->select('products.id', 'products.*','products.created_at',
                    DB::raw('TIMESTAMPDIFF(MINUTE, products.created_at, NOW()) AS minutes_ago'))
                    ->latest('created_at')
                    ->first();

        $producthour = $product->created_at ?? '';

        $customer = DB::table('customers')
                    ->select('customers.id', 'customers.*','customers.created_at',
                    DB::raw('TIMESTAMPDIFF(MINUTE, customers.created_at, NOW()) AS minutes_ago'))
                    ->latest('created_at')
                    ->first();

        $customerhour = $customer->created_at ?? '';

        $buyer = DB::table('users')
                    ->select('users.id','users.*','users.created_at',DB::raw('TIMESTAMPDIFF(MINUTE, users.created_at, NOW()) AS minutes_ago'))
                    ->whereIn('role',['buyer'])
                    ->where('email_verified_at','<>','')
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                    ->orWhereNull('email_verified_at');
                    })
                    ->latest('created_at')
                    ->first();

        $buyerhour = $buyer->created_at ?? '';

        $order = DB::table('order_details')
                        ->select('order_details.confirmed_date','order_details.id','order_details.created_at',DB::raw('TIMESTAMPDIFF(MINUTE, order_details.created_at, NOW()) AS minutes_ago'))
                        ->latest('created_at')
                        ->first();

        $orderhour = $order->created_at ?? '';

        $notifications = Notification::select('message', 'time')->get();
        $notiCount=0;
        foreach($notifications as $notify)
        {
            if(!empty($notify->time))
            {
            $notiCount++;
            }
        }


        return view('layouts.auth',compact('seller','sellerhour','buyer','buyerhour','product','producthour','order','orderhour',
       'notiCount','notifications','customer','customerhour',));
    }
}

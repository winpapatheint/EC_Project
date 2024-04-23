<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
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

        $seller = DB::table('users')
                    ->select('users.id','users.*')
                    ->whereIn('role',['seller'])
                    ->where('email_verified_at','<>','')
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                    ->orWhereNull('email_verified_at');
                    })
                    ->where('created_at','<=',$currentDate)->first();

        $buyer = DB::table('users')
                    ->select('users.id','users.*')
                    ->whereIn('role',['buyer'])
                    ->where('email_verified_at','<>','')
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                    ->orWhereNull('email_verified_at');
                    })
                    ->where('created_at','<=',$currentDate)->first();
        $product = DB::table('products')
                        ->select('products.id')
                        ->where('created_at','<=',$currentDate)->first();
        $order = DB::table('orders')
                        ->select('orders.confirmed_date','orders.id')
                        ->where('created_at','<=',$currentDate)->first();

        $sellerlist = DB::table('users')
                        ->select('users.id','users.*')
                        ->whereIn('role',['seller'])
                        ->where('email_verified_at','<>','')
                        ->where(function ($query) {
                            $query->whereNotNull('email_verified_at')
                        ->orWhereNull('email_verified_at');
                        })
                        ->where('id','<>',$seller->id)
                        ->where('created_at','<=',$currentDate)->get();

        $sellerlist = DB::table('users')
                    ->select('users.id','users.*')
                    ->whereIn('role',['seller'])
                    ->where('email_verified_at','<>','')
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                    ->orWhereNull('email_verified_at');
                    })
                    ->where('id','<>',$buyer->id)
                    ->where('created_at','<=',$currentDate)->get();

        $buyerlist = DB::table('users')
                    ->select('users.id','users.*')
                    ->whereIn('role',['seller'])
                    ->where('email_verified_at','<>','')
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                    ->orWhereNull('email_verified_at');
                    })
                    ->where('id','<>',$buyer->id)
                    ->where('created_at','<=',$currentDate)->get();

        $productlist = DB::table('products')
                    ->select('products.id')
                    ->where('id','<>',$product->id)
                    ->where('created_at','<=',$currentDate)->get();

        $orderlist = DB::table('orders')
                    ->select('orders.id')
                    ->where('id','<>',$order->id ?? '')
                    ->where('created_at','<=',$currentDate)->get();



        return view('layouts.auth',compact('seller','buyer','product','order','sellerlist','buyerlist','productlist','orderlist'));
    }
}

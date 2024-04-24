<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Seller;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function SellerRegister()
    {
        $prefecture = Prefecture::get();
        return view('auth.seller_register',compact('prefecture'));
    }

    public function SellerRegistered(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'bank_name' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'bank_acc_no' => 'required|string|max:255',
            'bank_acc_name' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'shop_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shop_establish' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'chome' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'room' => 'required|string|max:255',

        ]);

        $img = $request->file('shop_logo');
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $img->move('upload/shop', $filename);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'seller',
            'password' => Hash::make($request->input('password')),
            'status' => 1,
        ]);
        event(new Registered($user));

        $user->assignRole('seller');
        $user->givePermissionTo(['product.list', 'product.add','product.edit','product.delete',
        'order.list', 'order.add','order.edit','order.delete',
        'subseller.list', 'subseller.add','subseller.edit','subseller.delete',
        'review.list', 'review.add','review.edit','review.delete',
        'help.list', 'help.add','help.edit','brand.add','profile', 'dashboard']);

        $seller = Seller::create([
            'user_id' => $user->id,
            'prefecture_id' => $request->prefecture,
            'bank_name' => $request->bank_name ,
            'bank_branch' => $request->bank_branch,
            'bank_acc_type' => $request->bank_acc_type,
            'bank_acc_no' => $request->bank_acc_no,
            'bank_acc_name' => $request->bank_acc_name,
            'shop_name' => $request->shop_name,
            'shop_logo' => $filename,
            'shop_establish' => $request->shop_establish,
            'phone' => $request->phone,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'chome' => $request->chome,
            'building' => $request->building,
            'room' => $request->room,
            'url' => $request->url
        ]);

        event(new Registered($seller));

        $inquiry_email = 'info-test@asia-hd.com';
        $user = User::where('id', $user->id)->select('email', 'name')->first();

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

        $notification = Notification::find(1);
        $newval = array('time' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        );
        $notification->update( $newval);

        $email = $request->email;
        return view('auth.verify-email',compact('email'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Seller;
use App\Models\Prefecture;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $validatedData = $request->validate([
            'user_name' => 'present|string|max:255',
            'mail' => 'present|string|email|max:255|unique:users,email',
            'password' => 'present|string|min:8',
            'confirmed' => 'required|string|same:passwords',
            'bank_name' => 'present|string|max:255',
            'bank_acc_type' => 'present|string',
            'bank_branch' => 'present|string|max:255',
            'bank_acc_no' => 'present|string|max:255',
            'bank_acc_name' => 'present|string|max:255',
            'shop_name' => 'present|string|max:255',
            'shop_logo' => 'present|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shop_establish' => 'present|string|max:255',
            'phone' => 'present|string|max:255',
            'zip_code' => 'present|string|max:255',
            'prefecture' => 'required|exists:prefectures,id',
            'city' => 'present|string|max:255',
            'chome' => 'present|string|max:255',
            'building' => 'present|string|max:255',
            'room' => 'present|string|max:255',

        ]);

        $img = $request->file('shop_logo');
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('upload/shop'), $filename);

        $user = User::create([
            'name' => $validatedData['user_name'],
            'email' => $validatedData['mail'],
            'role' => 'seller',
            'password' => Hash::make($validatedData['password']),
            'status' => 1,
        ]);
        event(new Registered($user));

        $seller = Seller::create([
            'user_id' => $user->id,
            'prefecture_id' => $validatedData['prefecture'],
            'bank_name' => $validatedData['bank_name'],
            'bank_branch' =>$validatedData['bank_branch'],
            'bank_acc_type' => $validatedData['bank_acc_type'],
            'bank_acc_no' => $validatedData['bank_acc_no'],
            'bank_acc_name' => $validatedData['bank_acc_name'],
            'shop_name' => $validatedData['shop_name'],
            'shop_logo' => $filename,
            'shop_establish' => $validatedData['shop_establish'],
            'phone' => $validatedData['phone'],
            'zip_code' => $validatedData['zip_code'],
            'city' => $validatedData['city'],
            'chome' => $validatedData['chome'],
            'building' => $validatedData['building'],
            'room' => $validatedData['room'],
            'url' => $request->url,
            'commission' => 0,
            'status' => 1
        ]);

        event(new Registered($seller));

        $email = $request->email;
        $inquiry_email = 'info-test@asia-hd.com';
        $user = User::where('id', $user->id)->select('email', 'name')->first();

        $email = $user->email;
        $name = $user->name;
        $data = array('name'=>$name);
        if (!empty($request->email)) {
            $mail = Mail::send([], $data, function($message) use ($request, $inquiry_email,$name,$email) {
                $message->to($inquiry_email, 'Ecommerce ')->subject($name.'Question form');
                $message->from($email,$name);
                $message->setBody("The following notification was received from the E-commerce official website.
                \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                \r\Name".$name."
                \r\n"."Email：　".$email."
                \r\n
                \r\n"."Notice：　
                \r\n
                \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
            });
        }

        $adminMails = DB::table('users')->where('role', 'admin')->pluck('email')->toArray();
        $inquiry_email = 'info-test@asia-hd.com';
        $name = $user->name;
        $data = array('name'=>$name);
        if (!empty(  $adminMails)) {
            foreach ($adminMails as $email) {
                Mail::send([], $data, function ($message) use ($request, $adminMails,$name,$email) {
                    $message->to($email, 'Ecommerce ')->subject($request->name.'Question form');
                    $message->from($email,$name);
                    $message->setBody("The following notification was received from the E-commerce official website.
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                    \r\Name".$name."
                    \r\n"."Email：　".$email."
                    \r\n
                    \r\n"."Notice：　
                    \r\n
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                });
            }
        }

        $notification = Notification::find(1);
        $newval = array('time' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        );
        $notification->update( $newval);
        return view('auth.verify-email',compact('email'));
    }
}

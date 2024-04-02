<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|string|min:8|confirmed',
            'shop_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $img = $request->file('shop_logo');
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $img->move('upload/shop', $filename);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'seller',
            'password' => Hash::make($request->input('password')),
        ]);

        $seller = Seller::create([
            'user_id' => $user->id,
            'bank_name' => $request->input('bank_name') ,
            'bank_branch' => $request->input('bank_branch'),
            'bank_acc_type' => $request->input('bank_acc_type'),
            'bank_acc_no' => $request->input('bank_acc_no'),
            'bank_acc_name' => $request->input('bank_acc_name'),
            'shop_name' => $request->input('shop_name'),
            'shop_logo' => $filename,
            'shop_establish' => $request->input('shop_establish'),
            'phone' => $request->input('phone'),
            'zip_code' => $request->input('zip_code'),
            'address' => $request->input('address'),
            'url' => $request->input('url')
        ]);
        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers\Auth;
use App\Models\Shop;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function SellerRegister()
    {
        return view('auth.seller_register');
    }

    public function SellerRegistered(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($request->hasFile('shop_logo')) {
                $filename = $request->file('shop_logo')->store('upload/shop');
            }

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => 'seller',
                'password' => Hash::make($request->input('password')),

            ]);

            $seller = new Seller($request->all());
            $seller->password = Hash::make($request->input('password'));
            if (isset($filename)) {
                $seller->shop_logo = $filename;
            }
            $seller->save();

            $shop = new Shop($request->only(['shop_name', 'shop_establish']));
            if (isset($filename)) {
                $shop->shop_logo = $filename;
            }
            $shop->save();

            DB::commit();

            return redirect('/seller');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to register seller: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to register seller.']);
        }
    }
}

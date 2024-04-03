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

<<<<<<< HEAD
<<<<<<< HEAD
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => 'seller',
                'password' => Hash::make($request->input('password')),

            ]);
            event(new Registered($user));
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



        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to register seller: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to register seller.']);
        }
               //verify email
               $email = $request->email;
               return view('auth.verify-email',compact('email'));
               //return redirect()->route('auth.verify-email', compact('email'));
=======
=======
>>>>>>> b6070b616b42d5bc9da8926f70a2882252856643
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
<<<<<<< HEAD
>>>>>>> 57894d7f12fd487bbd28f8f224834025836b61b7
=======
>>>>>>> b6070b616b42d5bc9da8926f70a2882252856643
    }
}

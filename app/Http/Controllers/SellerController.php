<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Help;
use App\Models\User;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function dashboard()
    {
        $id = Auth::user()->id;
        $transfer = Order::where('seller_id',$id)->latest()->paginate(5);
        $orders = Order::selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name")
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("MONTH(created_at)"), 'created_at')
        ->pluck('count', 'month_name');

        $labels = $orders->keys();
        $data = $orders->values();
        return view('seller.index',compact('labels', 'data','transfer'));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $shop = Seller::where('user_id', $id)->first();
        $prefecture = Prefecture::get();
        return view('seller.profile',compact('data','shop','prefecture'));
    }

    public function storeProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|string|min:8',
        ]);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move('upload/profile', $filename);
            $data->user_photo = $filename;
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        return redirect('/seller');
    }

    public function updateShop(Request $request)
    {
        $old_img = $request->old_img;
        $id = $request->seller_id;
        $seller = Seller::find($id);

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'chome' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'bank_acc_type' => 'required|string|max:255',
            'bank_acc_name' => 'required|string|max:255',
            'bank_acc_no' => 'required|string|max:255',
            'shop_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('shop_logo')) {
            if (File::exists($old_img)) {
                File::delete($old_img);
            }
            $img = $request->file('shop_logo');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move('upload/shop', $filename);
        } else {
            $filename = $old_img;
        }

        $seller->shop_name = $request->shop_name;
        $seller->shop_logo = $filename;
        $seller->shop_establish = $request->shop_establish;
        $seller->phone = $request->phone;
        $seller->zip_code = $request->zip_code;
        $seller->city = $request->city;
        $seller->chome = $request->chome;
        $seller->building = $request->building;
        $seller->room = $request->room;
        $seller->url = $request->url;
        $seller->bank_name = $request->bank_name;
        $seller->bank_branch = $request->bank_branch;
        $seller->bank_acc_type = $request->bank_acc_type;
        $seller->bank_acc_name = $request->bank_acc_name;
        $seller->bank_acc_no = $request->bank_acc_no;
        $seller->updated_at = Carbon::now();
        $seller->update();
        return redirect('/seller');
    }


    public function help()
    {
        $helps = Help::latest()->paginate(4);
        return view('seller.help.help',compact('helps'));
    }

    public function detailHelp($id)
    {
        $helps = Help::find($id);
        return view('seller.help.help_detail',compact('helps'));
    }

    public function addHelp()
    {
        return view('seller.help.help_add');
    }

    public function storeHelp(Request $request)
    {
        $help = new Help();
        $request->validate([
            'title' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        if($request->hasFile('image'))
        {
            $img = $request->file('image');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move('upload/shop', $filename);
            $help->img = $filename;
        }

        $help->user_id = Auth::user()->id;
        $help->title = $request->title;
        $help->reason = $request->reason;
        $help->created_at = Carbon::now();
        $help->save();
        return redirect('/seller/help')->with('flash_message', 'Data added successfully');
    }

    public function deleteHelp($id)
    {
        $help = Help::findOrFail($id);
        $img = $help->img;
        if (File::exists($img)) {
            File::delete($img);
        }
        $help->delete();
        return back()->with('flash_message', 'Data deleted successfully');
    }

}
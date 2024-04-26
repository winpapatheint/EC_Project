<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Help;
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Subseller;
use App\Models\Prefecture;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class SellerController extends Controller
{
    public function dashboard()
    {
        $id = Auth::user()->created_by ?? Auth::id();
        $revenue = OrderDetail::where('seller_id', $id)->where('status', 'Delivered')->sum('amount');
        $order = OrderDetail::where('seller_id', $id)->get();
        $pending = OrderDetail::where('seller_id', $id)->where('status', 'Pending')->get();
        $product = Product::where('seller_id', $id)->get();
        $transfer = OrderDetail::where('seller_id',$id)->latest()->paginate(5);
        $orders = OrderDetail::where('seller_id',$id)->selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name")
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("MONTH(created_at)"), 'created_at')
                ->pluck('count', 'month_name');

        $labels = $orders->keys();
        $data = $orders->values();
        return view('seller.index',compact('labels', 'data','transfer','revenue','order','pending','product'));
    }


    public function profile()
    {
        $user = Auth::user();
        $id = $user->created_by !== null ? $user->created_by : $user->id;
        $data = Seller::where('user_id', $id)->first();
        $prefecture = Prefecture::get();

        return view('seller.profile', compact('user', 'data', 'prefecture'));
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
        return redirect('/dashboard');
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
        return redirect('/dashboard');
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
        return redirect('/help')->with('flash_message', 'Data added successfully');
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


    public function allSubseller()
    {
        $id = Auth::user()->id;
        $subseller =  Subseller::where('seller_id',$id)->latest()->get();
        return view('seller.subseller.subseller_all',compact('subseller'));
    }


    public function addSubseller()
    {
        $id = Auth::user()->id;
        $seller =  Seller::where('user_id',$id)->latest()->first();;
        return view('seller.subseller.subseller_add',compact('seller'));
    }


    public function storeSubseller(Request $request)
    {
        $seller_id = $request->seller_id;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'seller',
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
        ]);
        event(new Registered($user));

        $subseller = Subseller::create([
            'user_id' => $user->id,
            'seller_id' => Auth::user()->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        event(new Registered($subseller));

        $email = $request->email;
        return view('auth.verify-email',compact('email'));
    }


    public function deleteSubseller(Request $request)
    {
        $id = $request->id;
        Subseller::findOrFail($id)->delete();
        User::where('user_id',$id)->delete();
        return back()->with('flash_message', 'Data deleted successfully');
    }


}

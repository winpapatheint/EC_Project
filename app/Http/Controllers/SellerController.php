<?php

namespace App\Http\Controllers;

use Mail;
use DateTime;
use Carbon\Carbon;
use App\Models\Help;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Subseller;
use App\Models\Transfer;
use App\Models\Prefecture;
use App\Models\OrderDetail;
use App\Models\Notification;
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
        $limit=10;
        $id = Auth::user()->created_by ?? Auth::id();
        $revenue = OrderDetail::where('seller_id', $id)->where('status', 'Delivered')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount');
        $order = OrderDetail::where('seller_id', $id)
                ->where('status', '!=', 'Cancel')
                ->groupBy('order_id')
                ->selectRaw('order_id, MAX(created_at) as created_at, MAX(id) as id')
                ->get();
        $pending = OrderDetail::where('seller_id', $id)->where('status', 'Pending')->get();
        $product = Product::where('seller_id', $id)->get();
        // $transfer = OrderDetail::where('seller_id',$id)->latest()->paginate($limit);
        $orders = OrderDetail::where('seller_id',$id)->selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name")
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("MONTH(created_at)"), 'created_at')
                ->pluck('count', 'month_name');

        $ordergraph = OrderDetail::where('seller_id',$id)->selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name, MONTH(created_at) as month_number")
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("DATE_FORMAT(created_at, '%M')"))
                    ->orderBy(DB::raw("MONTH(created_at)"))
                    ->get();

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data = array_fill(0, 12, 0);

        foreach ($ordergraph as $item) {
            $monthIndex = $item->month_number - 1;
            $data[$monthIndex] = $item->count;
        }

        $transfer_history = Transfer::latest()
                                ->with('seller')
                                ->where('seller_id',Auth::user()->id) // Eager load the seller relationship
                                ->paginate($limit);

        $ttl = $transfer_history->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('seller.index',compact('labels', 'data','transfer_history','revenue','order','pending','product','ttl','ttlpage'));
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

        $img = $request->file('photo');
        if ($img) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('upload/profile'), $filename);
            $data->user_photo = $filename;
        }

        $data->name = $request->name;
        $data->email = $request->email;


        if ($request->password !== $data->password) {
            $data->password = Hash::make($request->password);
        }

        $data->save();
        $msg = ('Data updated successfully');
        return redirect('/profile')->with('success', $msg);
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
            $img->move(public_path('upload/shop'), $filename);
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

        $msg = ('Data updated successfully');
        return redirect('/seller')->with('success', $msg);
    }



    public function help()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $userEmail = Auth::user()->email;
        $receivedQuery = Help::where('to', $userEmail)->latest();
        $sentQuery = Help::where('from', $userEmail)->latest();
        if ($search) {
            $receivedQuery->where(function($q) use ($search) {
                $q->where('to', 'LIKE', "%{$search}%")
                ->orWhere('from', 'LIKE', "%{$search}%")
                ->orWhere('subject', 'LIKE', "%{$search}%")
                ->orWhere('body', 'LIKE', "%{$search}%");
            });

            $sentQuery->where(function($q) use ($search) {
                $q->where('to', 'LIKE', "%{$search}%")
                ->orWhere('from', 'LIKE', "%{$search}%")
                ->orWhere('subject', 'LIKE', "%{$search}%")
                ->orWhere('body', 'LIKE', "%{$search}%");
            });
        }

        $received = $receivedQuery->paginate(10);
        $sent = $sentQuery->paginate(10);

        return view('seller.help.help', compact('received', 'sent'));
    }




    public function detailHelp($id)
    {
        $getId = Help::find($id);
        $helpId = $getId->help_id;
        if ($helpId) {
            $start = Help::find($helpId);
            $reply = Help::where('help_id', $helpId)->get();
        } else {
            $start = $getId;
            $reply = null;
        }

        return view('seller.help.help_detail', compact('start', 'reply'));

    }



    public function addHelp()
    {
        return view('seller.help.help_add');
    }



    public function storeHelp(Request $request)
    {
        // $validatedData = $request->validate([
        //     'subject' => 'present|string|max:255',
        //     'body' => 'present|string|max:255',
        // ]);

        $help = new Help();
        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $shopName = Seller::where('user_id', Auth::user()->id)->value('shop_name');
        $help->name = Auth::user()->name;
        $help->shop_name = $shopName;
        $help->help_id = Auth::user()->id;
        $help->to = 'info-test@asia-hd.com';
        $help->from = Auth::user()->email;
        $help->subject = $request->title;
        $help->body =  $request->message;
        $help->img =   $imageName;
        $help->created_at = Carbon::now();
        $help->save();

        $inquiry_email = 'info-test@asia-hd.com';
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $mail = Mail::send('seller.help.helpEmail', ['name' => $name, 'email' => $email, 'title' => $request->title, 'reason' => $request->reason], function($message) use ($name, $inquiry_email) {
            $message->to($inquiry_email, 'Asian Food Museum')->subject($name.'Question form');
            $message->from(Auth::user()->email, Auth::user()->name);
        });
        $notification = Notification::find(5);
        $newval = array('time' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        );
        $notification->update( $newval);
        $msg = ('Data sent successfully');
        return redirect('/help')->with('success', $msg);
    }


    public function reply($id)
    {
        $getId = Help::find($id);
        $helpId = $getId->help_id;
        $data = Help::where(function ($query) use ($helpId) {
                $query->where('help_id', $helpId)
                ->orWhere('id', $helpId);
                })->get();
        return view('seller.help.help_reply',compact('data'));
    }


    public function storeReply(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'present|string|max:255',
        ]);

        $help = new Help();
        if($request->hasFile('image'))
        {
            $img = $request->file('image');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('upload/shop'), $filename);
            $help->img = $filename;
        }
        $shopName = Seller::where('user_id', Auth::user()->id)->value('shop_name');

        $check = Help::find($request->id);
        $help->help_id = $check ? $check->help_id ?? $request->id : $request->id;
        $help->name = Auth::user()->name;
        $help->to = 'info-test@asia-hd.com';
        $help->from = Auth::user()->email;
        $help->shop_name = $shopName;
        $help->subject = $request->subject;
        $help->body = $validatedData['body'];
        $help->updated_at = Carbon::now();
        $help->save();

        $inquiry_email = 'info-test@asia-hd.com';
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $mail = Mail::send('seller.help.helpEmail', ['name' => $name, 'email' => $email, 'title' => $request->title, 'reason' => $request->reason], function($message) use ($name, $inquiry_email) {
            $message->to($inquiry_email, 'Ecommerce')->subject($name.'からの質問');
            $message->from(Auth::user()->email, Auth::user()->name);
        });

        $msg = ('Data sent successfully');
        return redirect('/help')->with('success', $msg);
    }


    public function deleteHelp(Request $request)
    {
        $id = $request->id;
        $help = Help::findOrFail($id);
        $imagePath = public_path('upload/shop/' . $help->img);
        $help->delete();
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $msg = ('Data deleted successfully');
        return back()->with('success', $msg);
    }



    public function allSubseller()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $id = Auth::user()->id;
        $query =  User::where('created_by', $id);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $subseller = $query->latest()->get();
        return view('seller.subseller.subseller_all', compact('subseller'));
    }



    public function addSubseller()
    {
        $id = Auth::user()->id;
        $seller =  Seller::where('user_id',$id)->latest()->first();;
        return view('seller.subseller.subseller_add',compact('seller'));
    }


    public function storeSubseller(Request $request)
    {
        $time = new Datetime();
        $seller_id = $request->seller_id;
        $validatedData = $request->validate([
            'user_name' => 'present|string|max:255',
            'mail' => 'present|string|email|max:255|unique:users,email',
            'passwords' => 'present|string|min:8',
            'confirmed' => 'required|string|same:passwords',
        ]);

        $user = User::create([
            'name' => $validatedData['user_name'],
            'email' => $validatedData['mail'],
            'role' => 'seller',
            'password' => Hash::make($validatedData['passwords']),
            'phone' => $request->input('phone'),
            'email_verified_at' => $time->format('Y-m-d H:i:s'),
            'status' => 1,
        ]);

        $subseller = Subseller::create([
            'user_id' => $user->id,
            'seller_id' => Auth::user()->id,
            'name' => $validatedData['user_name'],
            'email' => $validatedData['mail'],
            'password' => Hash::make($validatedData['passwords']),
            'phone' => $request->input('phone'),
        ]);

        return redirect('/subsellerlist');
    }


    public function deleteSubseller(Request $request)
    {
        $id = $request->id;

        User::whereExists(function ($query) use ($id) {
            $query->select(DB::raw(1))
                ->from('subsellers')
                ->whereColumn('subsellers.email', 'users.email')
                ->where('subsellers.id', $id);
        })->delete();

        Subseller::findOrFail($id)->delete();

        $msg = ('Subseller deleted successfully');
        return back()->with('success', $msg);
    }


}

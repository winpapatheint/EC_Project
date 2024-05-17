<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Buyer;
use App\Models\BuyerAddress;
use App\Models\BuyerPayment;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Process;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CouponDetail;
use App\Models\seller;
use App\Models\Prefecture;
use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{

    public function index()
    {

        $prefecture = Prefecture::get();
        return view('front-end.user-register',compact('prefecture'));
    }

    //for new user registration for login
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'birthday' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'zip_code' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'chome' => 'required|string|max:255',
        'building' => 'required|string|max:255',
        'room' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'buyer',
            'password' => Hash::make($request->input('password')),
            'status' => '1',
        ]);

        event(new Registered($user));

        $buyer = Buyer::create([
            'user_id' => $user->id,
            'prefecture_id' => $request->prefecture,
            'name' => $request->name,
            'email' => $user->email,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'phone' => $request->phone,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'chome' => $request->chome,
            'building' => $request->building,
            'room_no' => $request->room,
        ]);

        $buyerAddress = BuyerAddress::create([
            'buyer_id' => $buyer->id,
            'name' => $request->name,
            'post_code' => $request->zip_code,
            'prefecture_id' => $request->prefecture,
            'city' => $request->city,
            'chome' => $request->chome,
            'building' => $request->building,
            'room_no' => $request->room,
            'phone' => $request->phone,
            'place' => "HOME",
            'default' => 1,
        ]);

        event(new Registered($buyer));

        $email = $request->email;
        return view('auth.verify-email', compact('email'));

    }
    public function indexuser()
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();

                if (Auth::check()) {
                    $address = Buyer::where('user_id', $user->id)->first();
                        
                    $profile = route('user_profile');

                    $buyer = DB::table('buyers')->where('user_id',Auth::user()->id)->first();
                    $orderCount = Order::where('buyer_id', $buyer->id)->count();

                    $orderDetails = OrderDetail::where('buyer_id', $buyer->id)->get();
                    $countForPending = [];
                    foreach ($orderDetails as $orderDetail) {
                        if (!isset($countForPending[$orderDetail->order_id])) {
                            $countForPending[$orderDetail->order_id] = 1;
                        }
                    
                        if (is_null($orderDetail->delivered_date)) {
                            $countForPending[$orderDetail->order_id] = 0;
                        }
                    }
                    $pendingCount = array_sum($countForPending);

                    $wishlist = DB::table('wishlists')
                        ->join('buyers', 'wishlists.buyer_id', '=', 'buyers.id')
                        ->where('buyers.user_id', Auth::user()->id)
                        ->select('wishlists.*', 'buyers.*')

                        ->get();

                    $wishlistCount = $wishlist->count();

                    return view('front-end.user-dashboard', compact(
                        'user',
                        'address',
                        'profile',
                        'orderCount',
                        'wishlistCount',
                        'pendingCount'
                    ));
                } else {
                    return redirect()->route('login');
                }

    }
    //Show Orders
    public function showOrders(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $limit = 10;

            $orders = DB::table('orders')
                ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
                ->where('buyers.user_id', $user->id)
                ->select('orders.*','orders.created_at as order_created_at', 'orders.id as order_id', 'buyers.*')
                ->orderBy('orders.created_at', 'desc')
                ->paginate($limit);

            $ttl = $orders->total();
            $ttlpage = ceil($ttl / $limit);

            return view('front-end.user-order', compact('user', 'orders', 'ttl', 'ttlpage'));
        } else {
            return redirect()->route('login');
        }
    }
   //Show Order Details
    public function showOrderDetails(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $auth = Auth::user()->id;

        $orderDetails = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->where('orders.id', $request->id)
            ->select('orders.id as order_id', 'order_details.id as order_detail_id','products.id as product_id','orders.*',
            'products.*','products.selling_price as price', 'order_details.*','buyers.*', 'orders.created_at as order_created_at',
            'order_details.name as order_details_name', 'order_details.phone as order_details_phone')
            ->get();

        return view('front-end.user-order-details', compact('orderDetails', 'user'));

    }

    public function showOrderDetailTracking(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $orderDetail = OrderDetail::select('order_details.*', 'products.*', 'sellers.*', 'sellers.zip_code as shop_post_code',
                                            'sellers.city as shop_city','sellers.chome as shop_chome','sellers.building as shop_building',
                                            'sellers.room as shop_room','order_details.post_code as cus_post_code', 'order_details.city as cus_city',
                                            'order_details.chome as cus_chome','order_details.building as cus_building', 
                                            'order_details.room_no as cus_room', 'order_details.created_at as order_detail_created_at')
                                    ->leftjoin('products', 'order_details.product_id', 'products.id')
                                    ->leftjoin('sellers', 'products.seller_id', 'sellers.user_id')
                                    ->where('order_details.id', $request->id)->first();
        return view('front-end.user-order-detail-tracking', compact('user', 'orderDetail'));
    }
    //Show Order Tracking
    public function orderTracking(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $id = $request->id;
        $order = Order::find($id);
        $process = Process::where('order_id',$id)->latest()->get();
        $orderDetails = DB::table('order_details')
            ->join('sellers', 'order_details.seller_id', '=', 'sellers.id')
            ->join('buyers', 'order_details.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->where('order_details.id', $id)
            ->select('order_details.*', 'order_details.id as order_id','sellers.*','order_details.post_code as code','order_details.city as buyercity','order_details.chome as buyerchome','order_details.building as buyerbuilding','order_details.room_no as buyerroom' )
            ->get();

            foreach ($orderDetails as $location)
            {
                $locationcity = $location->buyercity;
                $locationchome = $location->buyerchome;
            }
        return view('front-end.user-order-tracking', compact('user', 'order', 'process','orderDetails','locationcity','locationcity'));

    }
    //Show Delivery Status
    public function showDelistatus(Request $request)
    {
        $limit = 10;
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $orders = Product::leftjoin('order_details', 'products.id', 'order_details.product_id')
                    ->where('order_details.buyer_id', $buyer->id)
                    ->whereNotNull('order_details.delivered_date')
                    ->orderBy('order_details.created_at', 'desc')
                    ->paginate($limit);
        // $orders = DB::table('order_details')
        //             ->join('buyers', 'order_details.buyer_id', 'buyers.id')
        //             ->leftjoin('orders','order_details.order_id','orders.id')
        //             ->where('buyers.user_id', Auth::user()->id)
        //             ->select('order_details.*', 'order_details.id as order_id', 'orders.*')
        //             ->paginate($limit);
        // $processes = [];
        // foreach ($orders as $order) {
        //     $checkid = $order->order_id;
        //     $processes[$checkid] = Process::where('order_id', $checkid)->latest()->first();
        // }

        $ttl = $orders->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.user-delivery-status', compact('user','orders','ttl', 'ttlpage'));

    }
    //Show Addresses
    public function showAddresses(Request $request)
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $prefecture = Prefecture::get();
        $data = BuyerAddress::select('buyer_addresses.*', 'buyers.name as username','buyers.email as useremail',)
                     ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
                     ->where('buyers.user_id', $user->id)
                     ->with('prefecture')->get();

        //$user = Buyers::first();
            return view('front-end.user-address',compact('data','user','prefecture'));
    }
    //Add New Address
    public function createNewaddress(Request $request)
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $buyer =Buyer::where('user_id', Auth::user()->id)->first();
        $prefecture = Prefecture::get();
        $data = BuyerAddress::select('buyer_addresses.id','buyer_addresses.name','buyer_addresses.post_code','buyer_addresses.city','buyer_addresses.chome','buyer_addresses.building','buyer_addresses.room_no','buyer_addresses.prefecture_id','buyer_addresses.phone','buyer_addresses.place','buyers.id as userid', 'buyers.name as username','buyers.email as useremail',)
                     ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
                     ->get();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'prefectures' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'chome' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'roomno' => 'required|string|max:255',
            'place' => 'required|in:Home,Office,Other',
            'phone' => 'required|string|max:255',
        ]);

        if ($request->filled('name', 'post_code', 'city', 'chome', 'building', 'roomno', 'place', 'phone')) {

            $Buyer_addresses = BuyerAddress::create([
                'buyer_id' => $buyer->id,
                'name' => $request->name,
                'post_code' => $request->post_code,
                'prefecture_id' => $request->prefectures,
                'city' => $request->city,
                'chome' => $request->chome,
                'building' => $request->building,
                'room_no' => $request->roomno,
                'place' => $request->place,
                'phone' => $request->phone,
                'default' => 0,
            ]);

            if ($Buyer_addresses) {
                return redirect()->route('user_addresses',compact('data','user','prefecture'));
            } else {
                // Handle failure to save
                return back()->withInput()->withErrors(['error' => 'Failed to save address.']);
            }
        } else {
            // Handle missing data
            return back()->withInput()->withErrors(['error' => 'Missing data for address.']);
        }
    }

    //Edit Address
    public function editAddress(Request $request)
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $buyer =Buyer::where('user_id', Auth::user()->id)->first();
        $prefecture = Prefecture::get();

        $buyerAddress = BuyerAddress::find($request->id);

        $data = BuyerAddress::select('buyer_addresses.id','buyer_addresses.name','buyer_addresses.post_code','buyer_addresses.city',
                                    'buyer_addresses.chome','buyer_addresses.building','buyer_addresses.room_no','buyer_addresses.prefecture_id',
                                    'buyer_addresses.phone','buyer_addresses.place','buyers.id as userid', 'buyers.name as username','buyers.email as useremail',)
                     ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
                     ->get();

        if ($buyerAddress) {

            $buyerAddress->update([
                'buyer_id' => $buyer->id,
                'name' => $request->name,
                'post_code' => $request->post_code,
                'prefecture_id' => $request->prefectures,
                'city' => $request->city,
                'chome' => $request->chome,
                'building' => $request->building,
                'room_no' => $request->roomno,
                'place' => $request->place,
                'phone' => $request->phone,
            ]);
            return redirect()->route('user_addresses',compact('data','user','prefecture'));
        } else {
            // Return an error response
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
    //Remove Address
    public function removeAddress($id)
    {
        $prefecture = Prefecture::get();
        $address = BuyerAddress::find($id);
        if ($address)
        {
            $address->delete();
            return redirect()->route('user_addresses',compact('prefecture'));
        }
        else
        {
            return back()->with('error', 'Address not found.');
        }
    }
    //Show Payment Method
    public function showCard(Request $request)
    {
    // Retrieve the encrypted account number from the database
    //$encryptedAccountNumber = $model->account_number; // Assuming $model contains the database record

    // Decrypt the account number
    //$decryptedAccountNumber = Crypt::decryptString($encryptedAccountNumber);

    // Extract the last four digits
    //$lastFourDigits = substr($decryptedAccountNumber, -4);

    // Use $lastFourDigits as needed
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $data = BuyerPayment::select('buyer_payments.*','buyers.id as userid', 'buyers.name as username', 'buyers.email as useremail')
        ->join('buyers', 'buyer_payments.buyer_id', '=', 'buyers.id')
        ->where('buyers.user_id', Auth::user()->id)
        ->get();
        return view('front-end.user-payment-method',compact('data','user'));
    }
    //Add New Card
    public function createNewcard(Request $request)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $validatedData = $request->validate([
                'acc_name' => 'required|string|max:255',
                'acc_no_1' => 'required|string|max:4',
                'acc_no_2' => 'required|string|max:4',
                'acc_no_3' => 'required|string|max:4',
                'acc_no_4' => 'required|string|max:4',
                'expired_date_1' => 'required|string|max:2',
                'expired_date_2' => 'required|string|max:2',
                'card_type' => 'required|in:Visa,Master,RuPay,Maestro',

            ], [
                'acc_name.required' => 'Please provide your account name.',
                'acc_name.max' => 'The account name must not exceed 255 characters.',
                'acc_no_*.required' => 'Please provide your account number.',
                'acc_no_*.max' => 'Each part of the account number must not exceed 4 characters.',
                'expired_date_*.required' => 'Please provide the expired date.',
                'expired_date_*.max' => 'Each part of the expiration date must not exceed 2 characters.',
                'card_type.required' => 'Please select a card type.',
                'card_type.in' => 'Please select a valid card type (Visa, Master, RuPay, Maestro).',
            ]);
        $acc_no = $request->acc_no_1 . $request->acc_no_2 . $request->acc_no_3 . $request->acc_no_4;
        $expired_date = $request->expired_date_1 . $request->expired_date_2;

        $Buyer_cards = BuyerPayment::create([

            'buyer_id' => $buyer->id,
            'acc_name' => $request->acc_name,
            'acc_no' => $acc_no,
            'expired_date' => $expired_date,
            'card_type' => $request->card_type,

        ]);
        $saved = $Buyer_cards->save();
        return redirect()->route('user_cards');
    }
    //Edit Card
    public function editCard(Request $request)
    {
        $buyerCard = BuyerPayment::find($request->id);

        if ($buyerCard) {

            $buyerCard->update([
                'id'=> $request->id,
                'acc_name' => $request->acc_name,
                'acc_no' => $request->acc_no,
                'expired_date' => $request->expired_date,
                'card_type' => $request->card_type,

            ]);
            return redirect()->route('user_cards');
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
   //Remove Card
   public function removeCard($id)
   {
       $card = BuyerPayment::find($id);
       if ($card) {
       $card->delete();
       return back()->with('success', 'Address removed successfully.');
       return redirect()->route('user_cards');
       } else {
           return back()->with('error', 'Address not found.');
       }
   }
   //Show Profile
   public function showProfile(Request $request)
   {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        $buyer = DB::table('buyers')

                    ->join('users', 'buyers.user_id', '=', 'users.id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select('users.*', 'buyers.*')
                    ->first();

        $maskedPassword = str_repeat('*', strlen($user->password));
        if($user && $buyer)
        {
            return view('front-end.user-profile',compact('user','buyer','maskedPassword'));

        }
        else
        {
            return redirect()->route('login');
        }
   }
    //Edit Profile
    public function editProfile(Request $request)
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $user = User::find(Auth::user()->id);
        $password = User::find($request->oldpassword);
        $buyer = buyer::find($request->buyer_id);

        if ($user && $buyer)
        {
            if ($request->has('password'))
                {
                    $userData['password'] = bcrypt($request->input('password'));
                    $user->update($userData);
                    $buyer->update($userData);
                    DB::commit();
                    return redirect()->route('user_profile');
                }
                else
                {
                    $user->update([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),

                    ]);
                    $buyer->update([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                    ]);
                    return redirect()->route('user_profile');
                }
        }
        else
        {
            return response()->json(['error' => 'Profile not found'], 404);
        }
    }
    //Edit Password
    public function editPassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
        ]);

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->oldpassword, $user->password)) {

            $newPasswordHash = Hash::make($request->newpassword);
            $user->password = $newPasswordHash;
            $user->save();

            return redirect()->route('edit_password');

        }
        else
        {
            return back()->withErrors(['oldpassword' => 'Incorrect old password'])->withInput();
        }
    }
    //Show Cart Product
    public function showCarts(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $productid = $request->id;

        if(isset($productid)){
            $product = DB::table('products')->where('id', $productid)->first();
            $buyer = Buyer::where('user_id', Auth::user()->id)->first();

            if($product)
                $cart = Cart::firstorcreate([
                    'product_id' => $product->id,
                    'seller_id' => $product->seller_id,
                    'buyer_id' => $buyer->id,
                    'quantity' => '1',
                ]);
        }

        $cartLists = DB::table('carts')
                    ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                    ->leftJoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                    ->leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select(
                        'carts.*',
                        'carts.id as cart_id',
                        'buyers.*',
                        'buyers.id as buyer_id',
                        'carts.product_id as product_id',
                        'products.*',
                        DB::raw('CASE 
                                    WHEN sellers.coupon_id IS NOT NULL THEN sellers.coupon_id
                                    WHEN products.coupon_id IS NOT NULL THEN products.coupon_id
                                    ELSE NULL 
                                END AS coupon_id'),
                        DB::raw('CASE 
                                    WHEN sellers.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = sellers.coupon_id)
                                    WHEN products.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = products.coupon_id)
                                    ELSE NULL 
                                END AS coupon_code')
                    )
                    ->get();
        $maxDeliveryPrices = [];
        foreach($cartLists as $key => $cartItem){
            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;

            $shopName = DB::table('sellers')
                        ->where('sellers.user_id', $sellerID)
                        ->select('sellers.shop_name as shopname')
                        ->first();
            $cartItem->shop_name = $shopName->shopname;

            $sellerID = $cartItem->seller_id;
            if (!isset($maxDeliveryPrices[$sellerID])) {
                $maxDeliveryPrices[$sellerID] = $cartItem->delivery_price;
            } else {
                $maxDeliveryPrices[$sellerID] = max($maxDeliveryPrices[$sellerID], $cartItem->delivery_price);
            }
        }
        $shippingFee = array_sum($maxDeliveryPrices);
        if ($shippingFee >= 5000)
            $shippingFee = 0;

        $discount = 0;
        $couponapplycheck = 0;
        return view('front-end.cart', compact('cartLists', 'discount', 'couponapplycheck' ,'shippingFee'));
    }
    public function removeCart($id)
    {
        $cartItem = DB::table('carts')
                    ->delete($id);

                    $cartLists = DB::table('carts')
                    ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                    ->leftJoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                    ->leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select(
                        'carts.*',
                        'carts.id as cart_id',
                        'buyers.*',
                        'buyers.id as buyer_id',
                        'carts.product_id as product_id',
                        'products.*',
                        DB::raw('CASE 
                                    WHEN sellers.coupon_id IS NOT NULL THEN sellers.coupon_id
                                    WHEN products.coupon_id IS NOT NULL THEN products.coupon_id
                                    ELSE NULL 
                                END AS coupon_id'),
                        DB::raw('CASE 
                                    WHEN sellers.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = sellers.coupon_id)
                                    WHEN products.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = products.coupon_id)
                                    ELSE NULL 
                                END AS coupon_code')
                    )
                    ->get();

        $maxDeliveryPrices = [];
        foreach($cartLists as $key => $cartItem){
            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;

            $shopName = DB::table('sellers')
                        ->where('sellers.user_id', $sellerID)
                        ->select('sellers.shop_name as shopname')
                        ->first();
            $cartItem->shop_name = $shopName->shopname;

            $sellerID = $cartItem->seller_id;
            if (!isset($maxDeliveryPrices[$sellerID])) {
                $maxDeliveryPrices[$sellerID] = $cartItem->delivery_price;
            } else {
                $maxDeliveryPrices[$sellerID] = max($maxDeliveryPrices[$sellerID], $cartItem->delivery_price);
            }
        }
        $shippingFee = array_sum($maxDeliveryPrices);
        if ($shippingFee >= 5000)
            $shippingFee = 0;

        $result = DB::table('coupons')
                ->join('coupon_details', 'coupon_details.coupon_id', '=', 'coupons.id')
                ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
                ->select('coupons.discount_amount')
                ->pluck('coupons.discount_amount');
                $discount = 0;
        $couponapplycheck = 0;
        return view('front-end.cart', compact('cartLists', 'discount', 'couponapplycheck', 'shippingFee'));

    }
    public function removeCartProduct($id)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $cartItem = Cart::where('buyer_id', $buyer->id)->where('product_id', $id)->first();
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Cart item deleted successfully']);
        } else {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
    }
    //Update Cart Quantity
    public function updateCartQty(Request $request, $id)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $quantity = $request->input('quantity');
        $cartItem = Cart::find($id);
        $couponapplycheck = 0;

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();

            $cartLists = DB::table('carts')
                            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                            ->leftJoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                            ->leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
                            ->where('buyers.user_id', Auth::user()->id)
                            ->select(
                                'carts.*',
                                'carts.id as cart_id',
                                'buyers.*',
                                'buyers.id as buyer_id',
                                'carts.product_id as product_id',
                                'products.*',
                                DB::raw('CASE 
                                            WHEN sellers.coupon_id IS NOT NULL THEN sellers.coupon_id
                                            WHEN products.coupon_id IS NOT NULL THEN products.coupon_id
                                            ELSE NULL 
                                        END AS coupon_id'),
                                DB::raw('CASE 
                                            WHEN sellers.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = sellers.coupon_id)
                                            WHEN products.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = products.coupon_id)
                                            ELSE NULL 
                                        END AS coupon_code')
                            )
                            ->get();

            $maxDeliveryPrices = [];
            foreach($cartLists as $key => $cartItem){
                $productID = $cartItem->id;
                $sellerID = $cartItem->seller_id;
    
                $shopName = DB::table('sellers')
                            ->where('sellers.user_id', $sellerID)
                            ->select('sellers.shop_name as shopname')
                            ->first();
                $cartItem->shop_name = $shopName->shopname;
    
                $sellerID = $cartItem->seller_id;
                if (!isset($maxDeliveryPrices[$sellerID])) {
                    $maxDeliveryPrices[$sellerID] = $cartItem->delivery_price;
                } else {
                    $maxDeliveryPrices[$sellerID] = max($maxDeliveryPrices[$sellerID], $cartItem->delivery_price);
                }
            }
            $shippingFee = array_sum($maxDeliveryPrices);
            if ($shippingFee >= 5000)
                $shippingFee = 0;

            $result = DB::table('coupons')
                ->join('coupon_details', 'coupon_details.coupon_id', '=', 'coupons.id')
                ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
                ->select('coupons.discount_amount')
                ->pluck('coupons.discount_amount');
            $discount = $result[0];
        }
        return response()->json([
            'message' => 'Quantity updated successfully.',
            'redirect_url' => route('show_carts', compact('cartLists', 'discount', 'couponapplycheck', 'shippingFee'))
        ]);
        
        // return response()->json(['message' => 'Cart item added successfully']);
        
    }

    //Product Cupon
    public function applyCouponCode(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $buyerCoupon = Buyer::where('user_id', Auth::user()->id)->first();
        $buyerid = $buyerCoupon->id;
        $couponcode = $request->input('coupon');
        $cartLists = DB::table('carts')
                            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                            ->leftJoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                            ->leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
                            ->where('buyers.user_id', Auth::user()->id)
                            ->select(
                                'carts.*',
                                'carts.id as cart_id',
                                'buyers.*',
                                'buyers.id as buyer_id',
                                'carts.product_id as product_id',
                                'products.*',
                                DB::raw('CASE 
                                            WHEN sellers.coupon_id IS NOT NULL THEN sellers.coupon_id
                                            WHEN products.coupon_id IS NOT NULL THEN products.coupon_id
                                            ELSE NULL 
                                        END AS coupon_id'),
                                DB::raw('CASE 
                                            WHEN sellers.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = sellers.coupon_id)
                                            WHEN products.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = products.coupon_id)
                                            ELSE NULL 
                                        END AS coupon_code')
                            )
                            ->get();

        $maxDeliveryPrices = [];
        foreach($cartLists as $key => $cartItem){
            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;

            $shopName = DB::table('sellers')
                        ->where('sellers.user_id', $sellerID)
                        ->select('sellers.shop_name as shopname')
                        ->first();
            $cartItem->shop_name = $shopName->shopname;

            $sellerID = $cartItem->seller_id;
            if (!isset($maxDeliveryPrices[$sellerID])) {
                $maxDeliveryPrices[$sellerID] = $cartItem->delivery_price;
            } else {
                $maxDeliveryPrices[$sellerID] = max($maxDeliveryPrices[$sellerID], $cartItem->delivery_price);
            }
        }
        $shippingFee = array_sum($maxDeliveryPrices);
        if ($shippingFee >= 5000)
            $shippingFee = 0;

        $discount = 0;
        $couponapplycheck = null;

        $couponcheck = DB::table('coupons')
        ->where('coupon_code', $couponcode)
        ->where('status', 1)
        ->first();
        if ($couponcheck) 
        {
            $discount = $couponcheck->discount_amount;
        }

        if(empty($couponcheck)){
            $couponapplycheck = 1;
            return view('front-end.cart', compact('cartLists', 'discount', 'couponapplycheck', 'shippingFee'));
        }
        else 
        {
            $couponusedtime = $couponcheck->valid_count;
            $couponusedcount = DB::table('coupon_details')
                                ->select(DB::raw("COUNT(coupon_id) as count"))
                                ->where('coupon_id', $couponcheck->id)
                                ->get()
                                ->first()
                                ->count;

            if($couponusedtime <= $couponusedcount)
            {
                // Update the Coupons.status to 0
                DB::table('coupons')
                    ->where('id', $couponcheck->id)
                    ->update(['status' => 0]);
                
                $couponapplycheck = 1;
                return view('front-end.cart', compact('cartLists', 'discount','couponapplycheck', 'shippingFee'));
            }
            else
            {
                // $sellercouponcheck = DB::table('sellers')
                //                     ->where('coupon_id', $couponcheck->id)
                //                     ->first();
                $sellercouponcheck = Cart::leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
                                    ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                                    ->where('carts.buyer_id', $buyerid)
                                    ->where('sellers.coupon_id', $couponcheck->id)
                                    ->get();
            
                if($sellercouponcheck->count() > 0)
                {
                    $totalSubtotal = 0;
                    foreach($cartLists as $product)
                    {
                        $totalSubtotal += $product->selling_price * $product->quantity; 
                    }
                    if($totalSubtotal < $couponcheck->mini_amount)
                    {
                        $couponapplycheck = $couponcheck->mini_amount;
                    }
                    return view('front-end.cart', compact('cartLists', 'discount','couponapplycheck', 'shippingFee'));
                }
                else
                {
                    // $productcouponcheck = DB::table('products')
                    //                 ->where('Coupon_id', $couponcheck->id)
                    //                 ->where('buyer_id', $buyerid)
                    //                 ->first();
                    $productcouponcheck = Cart::leftJoin('products', 'products.id', '=', 'carts.product_id')
                                    ->where('carts.buyer_id', $buyerid)
                                    ->where('products.coupon_id', $couponcheck->id)
                                    ->get();
                    if($productcouponcheck->count() > 0)
                    {
                        $totalSubtotal = 0;
                        foreach($cartLists as $product)
                        {
                            $totalSubtotal += $product->selling_price * $product->quantity; 
                        }
                        if($totalSubtotal < $couponcheck->mini_amount)
                        {
                            $couponapplycheck = $couponcheck->mini_amount;
                        }
                        return view('front-end.cart', compact('cartLists', 'discount','couponapplycheck', 'shippingFee'));
                    }
                    $couponapplycheck = 1;
                    return view('front-end.cart', compact('cartLists', 'discount','couponapplycheck', 'shippingFee'));

                }
            }
        }
        return view('front-end.cart', compact('cartLists', 'discount', 'couponapplycheck', 'shippingFee'));
    }
    //Product Checkout
    public function showCheckout(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $subTotal = $request->subTotal;
        $couponDiscount = $request->coupon_discount;
        $shippingFee = $request->shipping;
        $total1 = $request->total;
        
        $buyerAddress = BuyerAddress::select('buyer_addresses.*', 'buyers.name as username','buyers.email as useremail',)
                     ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
                     ->where('buyers.user_id', Auth::user()->id)
                     ->with('prefecture')->get();

        $buyerPayment = BuyerPayment::select('buyer_payments.id', 'buyer_payments.acc_name', 'buyer_payments.acc_no', 'buyer_payments.card_type', 'buyer_payments.expired_date', 'buyer_payments.security_code', 'buyer_payments.img', 'buyers.id as userid', 'buyers.name as username', 'buyers.email as useremail')
                    ->join('buyers', 'buyer_payments.buyer_id', '=', 'buyers.id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->get();

        $cartLists = DB::table('carts')
                    ->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select('carts.*', 'carts.id as cart_id','buyers.*','buyers.id as buyer_id', 'carts.product_id as product_id', 'products.*')
                    ->get();

            foreach($cartLists as $cartItem){

                $productID = $cartItem->id;
                $sellerID = $cartItem->seller_id;


                $shopName = DB::table('sellers')
                            ->where('sellers.user_id', $sellerID)
                            ->select('sellers.shop_name as shopname')
                            ->first();
                $cartItem->shop_name = $shopName->shopname;
            }

            return view('front-end.checkout',compact('buyerAddress','buyerPayment','cartLists','subTotal','couponDiscount','shippingFee','total1'));

    }
    //Purchase
    public function paymentCompleted(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        try {
            $productIds = $request->productid;
            $buyerId = $request->buyerid;
            $sellerId = $request->sellerid;
            $colors = $request->color;
            $sizes = $request->size;
            $quantities = $request->quantity;
            $productamounts = $request->productamount;
            $totalQty = $request->totalqty;
            $amount = $request->amount;
            $amount1 = $request->amount1;
            $totalAmount = $request->totalamount;
            $subTotalAmount = $request->subtotalamount;
            $shippingFee = $request->shippingfee;
            $couponDiscountAmount = $request->coupondiscountamount;
            $buyerAddressId = $request->buyeraddressid;
            $buyerAddressFirst = BuyerAddress::find($buyerAddressId);
            $name = $buyerAddressFirst->name;
            $phone = $buyerAddressFirst->phone;
            $prefectureId = $buyerAddressFirst->prefecture_id;
            $postcode = $buyerAddressFirst->post_code;
            $city = $buyerAddressFirst->city;
            $chome = $buyerAddressFirst->chome;
            $building = $buyerAddressFirst->building;
            $room = $buyerAddressFirst->room_no;
            $payment = $request->payment;

            // return response()->json(['message' => $postcode.",".$city.",".$chome.",".$building.",".$room]);
            
            
            // Generate a unique order code
            //$id = IdGenerator::generate(['table' => 'orders', 'length' => 10, 'prefix' => date('yd')]);

            $datePrefix = date('ym');
            $latestOrder = Order::where('order_code', 'like', $datePrefix . '%')->latest()->first();
            $sequentialNumber = 1;
            if ($latestOrder) {
                $latestOrderCode = $latestOrder->order_code;
                $sequentialNumber = intval(substr($latestOrderCode, strlen($datePrefix))) + 1;
            }
            $newOrderCode = $datePrefix . str_pad($sequentialNumber, 6, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_code' => $newOrderCode,
                'seller_id' => (int)$sellerId,
                'buyer_id' => (int)$buyerId,
                'total_amount' => $totalAmount,
                'sub_total_amount' => $subTotalAmount,
                'coupon_discount_amout' => $couponDiscountAmount,
                'shipping_fee' => $shippingFee,
                'total_qty'=> $totalQty,
                'payment_type'=> $payment,
            ]);
            Payment::create([
                'order_id' => $order->id,
                'seller_id' => (int)$sellerId,
                'buyer_id' => (int)$buyerId,
                'total_amount' => $totalAmount,
                'payment_method' => $payment
                ]);

            foreach ($productIds as $key => $product_id) {
                if (isset($amount[$key]) && $amount[$key]) {
                    $orderdetailsData = [
                        'order_id' => $order->id,
                        'buyer_id' => (int)$buyerId,
                        'seller_id' => $sellerId[$key],
                        'product_id' => (int)$product_id,
                        'prefecture_id' => $prefectureId,
                        'color' => $colors[$key],
                        'size' => $sizes[$key],
                        'qty' => $quantities[$key],
                        'amount' => $productamounts[$key],
                        'name' => $name,
                        'phone' => $phone,
                        'post_code' => $postcode,
                        'city' => $city,
                        'chome' => $chome,
                        'building' => $building,
                        'room_no' => $room,
                    ];
                } else {
                    $orderdetailsData = [
                        'order_id' => $order->id,
                        'buyer_id' => (int)$buyerId,
                        'seller_id' => $sellerId[$key],
                        'product_id' => (int)$product_id,
                        'prefecture_id' => $prefectureId,
                        'color' => $colors[$key],
                        'size' => $sizes[$key],
                        'qty' => $quantities[$key],
                        'amount' => $productamounts[$key],
                        'name' => $name,
                        'phone' => $phone,
                        'post_code' => $postcode,
                        'city' => $city,
                        'chome' => $chome,
                        'building' => $building,
                        'room_no' => $room,
                    ];
                }
                OrderDetail::create($orderdetailsData);

                $productForInStock = Product::find($product_id);
                $productForInStock->in_stock = $productForInStock->product_qty - $quantities[$key];
                $productForInStock->save();
            }
            $cartItem = DB::table('carts')->where('buyer_id',$buyerId)
                    ->delete();

            return response()->json(['message' => 'Your order has been successfully placed.']);

        } catch (\Exception $e) {
            // Log any exceptions for debugging
            \Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
        //Show Footer Tracking
    public function footertracking(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $id = $request->id;
        $order = Order::find($id);
        $process = Process::where('order_id',$id)->latest()->get();
        $orderDetails = DB::table('orders')
            ->join('sellers', 'orders.seller_id', '=', 'sellers.id')
            ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->where('orders.id', $id)
            ->select('orders.*', 'orders.id as order_id','sellers.*','orders.post_code as code','orders.city as buyercity','orders.chome as buyerchome','orders.building as buyerbuilding','orders.room_no as buyerroom' )
            ->get();

            foreach ($orderDetails as $location)
            {
                $locationcity = $location->buyercity;
                $locationchome = $location->buyerchome;
            }
        return view('front-end.user-order-tracking', compact('user', 'order', 'process','orderDetails',));

    }

    public function userProfileUpload(Request $request)
    {
        $request->validate([
            'user_profile' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust validation rules as needed
        ]);

        // Get the uploaded file
        $file = $request->file('user_profile');

        // Generate a unique name for the file
        $fileName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified directory
        $filePath = 'upload/profile/' . $fileName;
        $file->move(public_path('upload/profile'), $fileName);

        // Update the user's photo path in the database
        $user = Auth::user(); // Assuming you're using authentication
        $user->user_photo = $fileName;
        $user->save();
        $fileUrl = '{{ asset(\'' . $filePath . '\') }}';

        // Return a JSON response with the file path
        // return response()->json(['success' => true, 'file_url' => $fileUrl]);
        return response()->json(['success' => true, 'file_url' => asset($filePath)]);
    }

    public function setDefaultAddress($id)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $buyerAddresses = BuyerAddress::where('buyer_id', $buyer->id)->get();
        foreach($buyerAddresses as $buyerAddress)
        {
            if($buyerAddress->id == $id)
            {
                $buyerAddress->default = TRUE;
                $buyerAddress->save();
            }
            else
            {
                $buyerAddress->default = FALSE;
                $buyerAddress->save();
            }
        }

        // return response()->json(['success' => 'Successfully set default address']);
        return response()->json(['success' => 'Successfully set default address']);
    }
}

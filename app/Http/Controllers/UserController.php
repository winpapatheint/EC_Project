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
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CouponDetail;
use App\Models\seller;
use App\Models\Prefecture;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birthday' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'chome' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'room' => 'required|string|max:255',

        ]);

            $img = $request->file('shop_logo');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move('upload/user', $filename);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => 'buyer',
                'password' => Hash::make($request->input('password')),
            ]);
            event(new Registered($user));
            $buyer = Buyer::create([
                'user_id' => $user->id,
                'prefecture_id' => $request->prefecture,
                'name' => $request->name,
                'email' => $user->email,
                'birthday' => $request->birthday,
                'address'=> $user->address,
                'photo' => $filename,
                'phone' => $request->phone,
                'zip_code' => $request->zip_code,
                'city' => $request->city,
                'chome' => $request->chome,
                'building' => $request->building,
                'room_no' => $request->room


            ]);

            event(new Registered($buyer));
            $email = $request->email;
            return view('auth.verify-email',compact('email'));

            // DB::commit();
            // return redirect()->route('user_dashboard')->with('success','Data have been successfully inserted.');
        
    }
    public function indexuser()
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();

                if (Auth::check()) {
                    $addresses = BuyerAddress::select(
                        'buyer_addresses.id',
                        'buyer_addresses.name',
                        'buyer_addresses.city',
                        'buyer_addresses.chome',
                        'buyer_addresses.building',
                        'buyer_addresses.room_no',
                        'buyer_addresses.post_code',
                        'buyer_addresses.address',
                        'buyer_addresses.phone',
                        'buyer_addresses.place',
                        'buyers.id as userid',
                        'buyers.name as username',
                        'buyers.email as useremail'
                    )->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
                        ->get();
                    
                    $firstAddress = $addresses->first()->address ?? null;
                    $profile = route('user_profile');
                    
                    $userOrders = DB::table('orders')
                        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
                        ->where('buyers.user_id', Auth::user()->id)
                        ->select('orders.*', 'orders.id as order_id', 'buyers.*', 'buyers.address as buyer_address')
                        ->get();
                    
                    $orderCount = $userOrders->count();
                    
                    $pendingCount = $userOrders->filter(function ($order) {
                        return !is_null($order->processing_date);
                    })->count();
                    
                    $userAddresses = $userOrders->pluck('buyer_address')->unique()->toArray();
                    
                    $wishlist = DB::table('wishlists')
                        ->join('buyers', 'wishlists.buyer_id', '=', 'buyers.id')
                        ->where('buyers.user_id', Auth::user()->id)
                        ->select('wishlists.*', 'buyers.*')

                        ->get();
                    
                    $wishlistCount = $wishlist->count();
                
                    return view('front-end.user-dashboard', compact(
                        'user',
                        'firstAddress',
                        'profile',
                        'userOrders',
                        'orderCount',
                        'wishlistCount',
                        'userAddresses',
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
                ->select('orders.*', 'orders.id as order_id', 'buyers.*')
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
        $orderItem = $request->id;

        $orderDetails = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->where('orders.id', $orderItem)
            ->select('orders.*', 'orders.id as order_id', 'products.*', 'order_details.*','buyers.*')
            ->get();  
                
        return view('front-end.user-order-details', compact('orderDetails', 'user'));
        
    }
    //Show Delivery Status
    public function showDelistatus(Request $request)
    {
        $limit = 10;
        $user = DB::table('users')->where('id', Auth::user()->id)->first();   
        $order = DB::table('orders')
                    ->join('buyers', 'orders.buyer_id', 'buyers.id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select('orders.*', 'orders.id as order_id', 'orders.created_at')
                    ->orderBy('order_id', 'desc')
                    ->paginate($limit);

        $ttl = $order->total();
        $ttlpage = (ceil($ttl / $limit));
    
        return view('front-end.user-delivery-status', compact('user','order','ttl', 'ttlpage'));

    }
    //Show Addresses
    public function showAddresses(Request $request)
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $data = BuyerAddress::select('Buyer_addresses.id','Buyer_addresses.name','Buyer_addresses.division','Buyer_addresses.district','Buyer_addresses.post_code','Buyer_addresses.address','Buyer_addresses.phone','Buyer_addresses.place','Buyers.id as userid', 'Buyers.name as username','Buyers.email as useremail',)
                     ->join('Buyers', 'Buyer_addresses.buyer_id', '=', 'Buyers.id')
                     ->get();

        //$user = Buyers::first();
            return view('front-end.user-address',compact('data','user'));
    }
    //Add New Address
    public function createNewaddress(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);


        if(empty($request->id))
        {

                $Buyer_addresses = BuyerAddress::create([

                    'buyer_id' => "1",
                    'name' => $request->name,
                    'division' => $request->division,
                    'district' => $request->district,
                    'post_code'=> $request->post_code,
                    'address' => $request->address,
                    'place' => $request->place,
                    'phone' => $request->phone,

                ]);
                $saved = $Buyer_addresses->save();
                return redirect()->route('user_addresses');

        }
    }
    //Edit Address
    public function editAddress(Request $request)
    {
        $buyerAddress = BuyerAddress::find($request->id);

        if ($buyerAddress) {

            $buyerAddress->update([
                'id'=> $request->id,
                'name' => $request->name,
                'division' => $request->division,
                'district' => $request->district,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'place' => $request->place,
                'phone' => $request->phone,
            ]);
            return redirect()->route('user_addresses');
        } else {
            // Return an error response
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
    //Remove Address
    public function removeAddress($id)
    {
        $address = BuyerAddress::find($id);
        if ($address) 
        {
            $address->delete();
            return redirect()->route('user_addresses');
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
        $data = BuyerPayment::select('buyer_payments.id', 'buyer_payments.acc_name', 'buyer_payments.acc_no', 'buyer_payments.card_type', 'buyer_payments.expired_date', 'buyer_payments.security_code', 'buyer_payments.img', 'buyers.id as userid', 'buyers.name as username', 'buyers.email as useremail')
        ->join('buyers', 'buyer_payments.buyer_id', '=', 'buyers.id')
        ->where('buyers.user_id', Auth::user()->id)
        ->get();
        return view('front-end.user-payment-method',compact('data','user'));
    }
    //Add New Card
    public function createNewcard(Request $request)
    {

        $validatedData = $request->validate([

                'acc_name' => 'required|string|max:255',
                'acc_no' => 'required|string|max:255',
                'expired_date' => 'required|string|max:255',
                'card_type' => 'required|string|max:255',

        ]);

        $Buyer_cards = BuyerPayment::create([

            'buyer_id' => "1",
            'acc_name' => $request->acc_name,
            'acc_no' => $request->acc_no,
            'expired_date' => $request->expired_date,
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
                        'address' => $request->input('address'),
                        'phone' => $request->input('phone'),
        
                    ]);
                    $buyer->update([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'address' => $request->input('address'),
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
        
            $product = DB::table('products')->where('id', $productid)->first();
            $sellerid = $product->seller_id;

            $buyer = Buyer::where('user_id', Auth::user()->id)->first();
            $buyerid = $buyer->id;
        
            $cart = Cart::create([
                'product_id' => $productid,
                'seller_id' => $sellerid,
                'buyer_id' => $buyerid,
                'quantity' => '1',
            ]);
        
        
            $cartLists = DB::table('carts')
                        ->leftjoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                        ->leftjoin('products', 'carts.product_id', '=', 'products.id')           
                        ->where('buyers.user_id', Auth::user()->id)
                        ->select('carts.*', 'carts.id as cart_id','buyers.*','buyers.id as buyer_id', 'carts.product_id as product_id', 'products.*')
                        ->get();
                    
            foreach($cartLists as $cartItem){

                $productID = $cartItem->id;
                $sellerID = $cartItem->seller_id;
        

                $shopName = DB::table('sellers')
                            ->where('sellers.id', $sellerID)
                            ->select('sellers.shop_name as shopname')
                            ->first();
                $cartItem->shop_name = $shopName->shopname;
            }

            $discountedPrices = [];
                foreach ($cartLists as $product) 
                {
                    
                    if ($product->discount_percent) 
                    {
                        $discountAmount = $product->selling_price * ($product->discount_percent / 100);
                        $discountedPrice = $product->selling_price - $discountAmount;
                    } 
                    else 
                    {
                        $discountedPrice = $product->selling_price;
                    }
                    $saveAmount = $product->selling_price - $discountedPrice;

                    $discountedPrices[$product->id] = [
                        'discounted_price' => $discountedPrice,
                        'save_amount' => $saveAmount
                    ];
                }

            $result = DB::table('coupons')
                    ->join('coupon_details', 'coupon_details.coupon_code', '=', 'coupons.coupon_code')
                    ->join('buyers', 'coupon_details.buyer_id', '=', 'coupon_details.buyer_id')
                    ->select('coupons.discount_amount')
                    ->pluck('coupons.discount_amount');
                    $discount = $result[0];

            $couponapplycheck = 0;
            return view('front-end.cart', compact('cartLists','discountedPrices', 'discount', 'couponapplycheck'));
        
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
                        ->leftjoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                        ->leftjoin('products', 'carts.product_id', '=', 'products.id')           
                        ->where('buyers.user_id', Auth::user()->id)
                        ->select('carts.*', 'carts.id as cart_id','buyers.*','buyers.id as buyer_id', 'carts.product_id as product_id', 'products.*')
                        ->get();
                    
            foreach($cartLists as $cartItem){

                $productID = $cartItem->id;
                $sellerID = $cartItem->seller_id;
        

                $shopName = DB::table('sellers')
                            ->where('sellers.id', $sellerID)
                            ->select('sellers.shop_name as shopname')
                            ->first();
                $cartItem->shop_name = $shopName->shopname;
            }

            $discountedPrices = [];
                foreach ($cartLists as $product) 
                {
                    
                    if ($product->discount_percent) 
                    {
                        $discountAmount = $product->selling_price * ($product->discount_percent / 100);
                        $discountedPrice = $product->selling_price - $discountAmount;
                    } 
                    else 
                    {
                        $discountedPrice = $product->selling_price;
                    }
                    $saveAmount = $product->selling_price - $discountedPrice;

                    $discountedPrices[$product->id] = [
                        'discounted_price' => $discountedPrice,
                        'save_amount' => $saveAmount
                    ];
                }

            $result = DB::table('coupons')
                ->join('coupon_details', 'coupon_details.coupon_code', '=', 'coupons.coupon_code')
                ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
                ->select('coupons.discount_amount')
                ->pluck('coupons.discount_amount');
            $discount = $result[0];

            return view('front-end.cart', compact('cartLists','discountedPrices', 'discount', 'couponapplycheck'));
          
        } else {
            return redirect()->back()->with('error', 'Cart item not found.');
        }
    }
    //Remove Cart Product
    public function removeCart($id)
    {
        $cartItem = DB::table('carts')
                    ->delete($id);

        $cartLists = DB::table('carts')
        ->leftjoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
        ->leftjoin('products', 'carts.product_id', '=', 'products.id')           
        ->where('buyers.user_id', Auth::user()->id)
        ->select('carts.*', 'carts.id as cart_id','buyers.*','buyers.id as buyer_id', 'carts.product_id as product_id', 'products.*')
        ->get();

        foreach($cartLists as $cartItem){

            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;
    

            $shopName = DB::table('sellers')
                        ->where('sellers.id', $sellerID)
                        ->select('sellers.shop_name as shopname')
                        ->first();
            $cartItem->shop_name = $shopName->shopname;
        }

        $discountedPrices = [];
            foreach ($cartLists as $product) 
            {
                
                if ($product->discount_percent) 
                {
                    $discountAmount = $product->selling_price * ($product->discount_percent / 100);
                    $discountedPrice = $product->selling_price - $discountAmount;
                } 
                else 
                {
                    $discountedPrice = $product->selling_price;
                }
                $saveAmount = $product->selling_price - $discountedPrice;

                $discountedPrices[$product->id] = [
                    'discounted_price' => $discountedPrice,
                    'save_amount' => $saveAmount
                ];
            }

        $result = DB::table('coupons')
                ->join('coupon_details', 'coupon_details.coupon_code', '=', 'coupons.coupon_code')
                ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
                ->select('coupons.discount_amount')
                ->pluck('coupons.discount_amount');
                $discount = $result[0];
        $couponapplycheck = 0;
        return view('front-end.cart', compact('cartLists','discountedPrices', 'discount', 'couponapplycheck'));

    }  
    //Product Cupon
    public function applyCouponCode(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $buyerid = $request->buyer_id;
        $couponcode = $request->input('coupon');
        $cartLists = DB::table('carts')
                        ->leftjoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                        ->leftjoin('products', 'carts.product_id', '=', 'products.id')           
                        ->where('buyers.user_id', Auth::user()->id)
                        ->select('carts.*', 'carts.id as cart_id','buyers.*','buyers.id as buyer_id', 'carts.product_id as product_id', 'products.*')
                        ->get();
                    
            foreach($cartLists as $cartItem){

                $productID = $cartItem->id;
                $sellerID = $cartItem->seller_id;
        

                $shopName = DB::table('sellers')
                            ->where('sellers.id', $sellerID)
                            ->select('sellers.shop_name as shopname')
                            ->first();
                $cartItem->shop_name = $shopName->shopname;
            }

            $discountedPrices = [];
                foreach ($cartLists as $product) 
                {
                    
                    if ($product->discount_percent) 
                    {
                        $discountAmount = $product->selling_price * ($product->discount_percent / 100);
                        $discountedPrice = $product->selling_price - $discountAmount;
                    } 
                    else 
                    {
                        $discountedPrice = $product->selling_price;
                    }
                    $saveAmount = $product->selling_price - $discountedPrice;

                    $discountedPrices[$product->id] = [
                        'discounted_price' => $discountedPrice,
                        'save_amount' => $saveAmount
                    ];
                }

            $result = DB::table('coupons')
                ->join('coupon_details', 'coupon_details.coupon_code', '=', 'coupons.coupon_code')
                ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
                ->select('coupons.discount_amount')
                ->pluck('coupons.discount_amount');
                $discount = $result[0];
            
            $couponapplycheck = null;
            $couponcheck = DB::table('coupons')->where('coupon_code', $couponcode)
                            ->where('status', 1)->first();
            if(empty($couponcheck)){
                
                $couponapplycheck = 1;
                return view('front-end.cart', compact('cartLists','discountedPrices', 'discount', 'couponapplycheck'));
            }
            else {
                $couponusedtime = ceil($couponcheck->valid_amount / $couponcheck->discount_amount);

                $couponusedcount = DB::table('coupon_details')
                                    ->select(DB::raw("COUNT('coupon_id') as count"))
                                    ->where('coupon_id', $couponcheck->id)
                                    ->get()
                                    ->first()
                                    ->count;
                if($couponusedtime == $couponusedcount)
                {
                    // Update the Coupons.status to 0
                    DB::table('coupons')
                        ->where('id', $couponcheck->id)
                        ->update(['status' => 0]);
                }
                $coupondetailcheck = DB::table('coupon_details')
                            ->where('Coupon_id', $couponcheck->id)
                            ->where('buyer_id', $buyerid)
                            ->first();
                if(!empty($coupondetailcheck)){
                    
                    $couponapplycheck = 1;
                    return view('front-end.cart', compact('cartLists','discountedPrices', 'discount', 'couponapplycheck'));
                }
            }
            
            $couponid = DB::table('coupons')
                        ->where('coupon_code', $couponcode)
                        ->where('status', 1)
                        ->select('Coupons.id')
                        ->first();
                        if ($couponid) {
                         
                            DB::table('coupon_details')->insert([
                                'coupon_id' => $couponid->id,
                                'buyer_id' => $buyerid,
                                'coupon_code' => $couponcode,
                                'updated_at' => now(),
                                'created_at' => now(),
                            ]);
                            $result = DB::table('coupons')
                                ->join('coupon_details', 'coupon_details.coupon_code', '=', 'coupons.coupon_code')
                                ->join('buyers', 'Coupon_details.buyer_id', '=', 'buyers.id')
                                ->select('coupons.discount_amount')
                                ->pluck('coupons.discount_amount');
                                $discount = $result[0];
                        } else {
                        
                        }
            return view('front-end.cart', compact('cartLists','discountedPrices', 'discount', 'couponapplycheck'));
    }
    //Product Checkout
    public function showCheckout(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        $buyerAddress = BuyerAddress::select('buyer_addresses.id','buyer_addresses.name','buyer_addresses.city','buyer_addresses.chome','buyer_addresses.building','buyer_addresses.room_no','buyer_addresses.post_code','buyer_addresses.address','buyer_addresses.phone','buyer_addresses.place','buyers.id as userid', 'buyers.name as username','buyers.email as useremail',)
                     ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
                     ->where('buyers.user_id', Auth::user()->id)
                     ->get();

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
                        ->where('sellers.id', $sellerID)
                        ->select('sellers.shop_name as shopname')
                        ->first();
            $cartItem->shop_name = $shopName->shopname;
        }

        $discountedPrices = [];
            foreach ($cartLists as $product) 
            {
                
                if ($product->discount_percent) 
                {
                    $discountAmount = $product->selling_price * ($product->discount_percent / 100);
                    $discountedPrice = $product->selling_price - $discountAmount;
                } 
                else 
                {
                    $discountedPrice = $product->selling_price;
                }
                $saveAmount = $product->selling_price - $discountedPrice;

                $discountedPrices[$product->id] = [
                    'discounted_price' => $discountedPrice,
                    'save_amount' => $saveAmount
                ];
            }

        $result = DB::table('coupons')
                    ->join('coupon_details', 'coupon_details.coupon_code', '=', 'coupons.coupon_code')
                    ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
                    ->select('coupons.discount_amount')
                    ->pluck('coupons.discount_amount');
                $discount = $result[0];
        

            return view('front-end.checkout',compact('buyerAddress','buyerPayment','cartLists','discountedPrices','discount'));
        
    }
    //Purchase 
    public function paymentCompleted(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $id = IdGenerator::generate(['table' => 'orders','length' => 10, 'prefix' => date('yd')]);
        $address = $request->addressId;
        if($address)
       {
        $test = 1;
       }

        // $order = Order::create([

        //     'id'=>$id,
        //     'seller_id' => $request->sellerid,
        //     'color' => $request->color,
        //     'size' => $request->size,
        //     'qty' => $request->qty,
        //     'price' => $request->totalamount,
        // ]);

        // $payment = Payment::create([
        //     'seller_id' => $request->sellerid,
        //     'buyer_id' => $request->buyerid,
        //     'amt' => $request->totalamount,
        // ]);

        // $orderdetails = OrderDetail::create([

            
        //     'seller_id' => $request->sellerid,
        //     'buyer_id' => $request->buyerid,
        //     'product_id' => $request->productid,
        //     'color' => $request->color,
        //     'size' => $request->size,
        //     'qty' => $request->qty,
        //     'amount' => $request->totalamount,
        //     'post_code' => $request->totalamount,
        //     'city' => $request->city,
        //     'chome' => $request->chome,
        //     'building' => $request->building,
        //     'room_no' => $request->room,

        // ]);
        return response()->json(['success'=>  $test]);

        // return redirect()->route('user_dashboard');
        //return response()->json(['message' => 'Successfully Pay']);
    }
        
}

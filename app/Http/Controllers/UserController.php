<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Buyers;
use App\Models\Buyer_addresses;
use App\Models\Buyer_payments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{

    public function index()
    {
        return view('user_register');
    }

    //for new user registration for login
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([

                'role' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:255',

            ]);

            if(empty($request->id))
            {

                $user = User::create([
                    'role' => "buyer",
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'phone' => $request->phone,

                ]);
                event(new Registered($user));
                $buyer = Buyers::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'phone' => $request->phone,

                ]);


                // Commit the transaction if both inserts are successful
                DB::commit();

                return back()->with('success','Data have been successfully inserted.');

            }
        } catch (\Exception $e) {

            DB::rollback();
            return back()->with('fail','Something went wrong.');
        }

        $email = $request->email;
        return view('auth.verify-email',compact('email'));

    }
    //Show Dashboard
    public function indexuser()
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        if ($user)
            {
                $addresses = Buyer_addresses::select('Buyer_addresses.id','Buyer_addresses.name','Buyer_addresses.division','Buyer_addresses.district','Buyer_addresses.post_code','Buyer_addresses.address','Buyer_addresses.phone','Buyer_addresses.place','Buyers.id as userid', 'Buyers.name as username','Buyers.email as useremail',)
                     ->join('Buyers', 'Buyer_addresses.buyer_id', '=', 'Buyers.id')
                     ->get();
                $firstAddress = $addresses->first()->address;
                $profile = route('user_profile');
                $userOrders = DB::table('orders')
                    ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select('orders.*', 'orders.id as order_id','buyers.*','buyers.address as buyer_address')
                    ->get();
                $orderCount = $userOrders->count();
                $wishlist = DB::table('wishlist')
                    ->join('buyers', 'wishlist.buyer_id', '=', 'buyers.id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select('wishlist.*','buyers.*')
                    ->get();
                $wishlistCount = $wishlist->count();
                return view('front-end.user-dashboard', compact('user', 'firstAddress','userOrders', 'profile','orderCount','wishlistCount'));
            }
            else
            {
                return redirect()->route('login');
            }
    }
    //Show Orders
   public function showOrders(Request $request)
   {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $orders = DB::table('orders')
            ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->select('orders.*', 'orders.id as order_id','buyers.*')
            ->get();


        if($user)
        {
            return view('front-end.user-order', compact('user', 'orders'));
        }
        else
        {
            return redirect()->route('login');
        }
   }
   //Show Order Details
   public function showOrderDetails(Request $request)
   {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $productId = $request->id;

        $orderDetails = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.product_id', $productId)
            ->where('buyers.user_id', Auth::user()->id)
            ->select('orders.*', 'orders.id as order_id', 'products.*')
            ->get();

        return view('front-end.user-order-details', compact('orderDetails', 'user'));
   }

    //Show Addresses
    public function showAddresses(Request $request)
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $data = Buyer_addresses::select('Buyer_addresses.id','Buyer_addresses.name','Buyer_addresses.division','Buyer_addresses.district','Buyer_addresses.post_code','Buyer_addresses.address','Buyer_addresses.phone','Buyer_addresses.place','Buyers.id as userid', 'Buyers.name as username','Buyers.email as useremail',)
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

                $Buyer_addresses = Buyer_addresses::create([

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
        $buyerAddress = Buyer_addresses::find($request->id);

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
        $address = Buyer_addresses::find($id);
        if ($address) {
        $address->delete();
        return back()->with('success', 'Address removed successfully.');
        return redirect()->route('user_addresses');
        } else {
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
        $data = Buyer_payments::select('Buyer_payments.id', 'Buyer_payments.acc_name', 'Buyer_payments.acc_no', 'Buyer_payments.card_type', 'Buyer_payments.expired_date', 'Buyer_payments.security_code', 'Buyer_payments.img', 'Buyers.id as userid', 'Buyers.name as username', 'Buyers.email as useremail')
        ->join('Buyers', 'Buyer_payments.buyer_id', '=', 'Buyers.id')
        ->get();

        return view('front-end.user-payment-method',compact('data','user'));
    }
    //Add New Card
    public function createNewcard(Request $request)
    {
        //dd($request->card_type) ;
        $validatedData = $request->validate([

                'acc_name' => 'required|string|max:255',
                'acc_no' => 'required|string|max:255',
                'expired_date' => 'required|string|max:255',
                'card_type' => 'required|string|max:255',

        ]);

        $Buyer_cards = Buyer_payments::create([

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
        $buyerCard = Buyer_payments::find($request->id);

        if ($buyerCard) {

            //dd($request->card_type) ;
            $buyerCard->update([
                'id'=> $request->id,
                'acc_name' => $request->acc_name,
                'acc_no' => $request->acc_no,
                'expired_date' => $request->expired_date,
                'card_type' => $request->card_type,

            ]);
            return redirect()->route('user_cards');
        } else {
            // Return an error response
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
   //Remove Card
   public function removeCard($id)
   {
       $card = Buyer_payments::find($id);
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
        $buyer = Buyers::find($request->buyer_id);

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
        } else {
            // Return an error response
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
        } else {
            return back()->withErrors(['oldpassword' => 'Incorrect old password'])->withInput();
        }

    }
    //Show Cart Product
    public function showCart(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $cartLists = DB::table('carts')
                    ->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->where('buyers.user_id', Auth::user()->id)
                    ->select('carts.*', 'carts.id as cart_id','buyers.*', 'carts.product_id as product_id', 'products.*')
                    ->get();

        foreach($cartLists as $cartItem){

            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;


            $shopName = DB::table('sellers')
                        ->where('sellers.id', $sellerID)
                        ->select('sellers.shop_name as shopname')
                        ->first();

            // Add the shop name to the cart item object
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
        return view('front-end.cart', compact('cartLists','discountedPrices'));
    }
    //Update Cart Quantity
    public function updateCartQty(Request $request)
    {

        $quantity = $request->input('quantity');
        $cartItemId = $request->input('cart_item_id');

        // Update the quantity in the database
        $cartItem = Cart::find($cartItemId);
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return redirect()->route('show_cart');
        } else
        {
            return redirect()->back()->with('error', 'Cart item not found.');
        }


    }
    //Remove Cart Product
    public function removeCart($id)
    {

        $cartItem = DB::table('Carts')
                    ->delete($id);
            return redirect()->route('checkout')->with('success', 'Product removed successfully');

    }

    //Product Checkout
    public function checkout(Request $request)
    {
        //$user = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('front-end.checkout');
      }

}

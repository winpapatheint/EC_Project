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
        
    }
    //Show Addresses
    public function showAddresses(Request $request)
    {
        $data = Buyer_addresses::select('Buyer_addresses.id','Buyer_addresses.name','Buyer_addresses.division','Buyer_addresses.district','Buyer_addresses.post_code','Buyer_addresses.address','Buyer_addresses.phone','Buyer_addresses.place','Buyers.id as userid', 'Buyers.name as username','Buyers.email as useremail',)
                     ->join('Buyers', 'Buyer_addresses.buyer_id', '=', 'Buyers.id')
                     ->get();
                
        $user = Buyers::first();
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
        $data = Buyer_payments::select('Buyer_payments.id', 'Buyer_payments.acc_name', 'Buyer_payments.acc_no', 'Buyer_payments.card_type', 'Buyer_payments.expired_date', 'Buyer_payments.security_code', 'Buyer_payments.img', 'Buyers.id as userid', 'Buyers.name as username', 'Buyers.email as useremail')
        ->join('Buyers', 'Buyer_payments.buyer_id', '=', 'Buyers.id')
        ->get();
                        
        $user = Buyers::first();
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
        /*if(empty($request->id)) {
            $id = $request->id;
            $profile = Buyers::where('id', $id)->get();
            return view('front-end.user-profile', compact('profile'));
        } else { */
            $profile = Buyers::all();
            return view('front-end.user-profile', compact('profile'));
        //}
        
   }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buyers;
use App\Models\Buyer_addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;



use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){

        return view('front-end.user-register');

    }
    //for user registration for login
    public function store(Request $request){

        $validatedData = $request->validate([

            'role' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',

        ]);

        if(empty($request->id))
        {

                $user = User::create([
                    'role' => "buyer",
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),

                ]);
                $saved = $user->save();
                if($saved){
                    return back()->with('success','Data have been successfully inserted.');
                }else{
                    return back()->with('fail','Something went wrong.');
                }


        }
    }

    //for show all address in form load
    public function showAddress()
    {

        $data = Buyer_addresses::select('Buyer_addresses.id','Buyer_addresses.name','Buyer_addresses.address','Buyer_addresses.phone','Buyer_addresses.place','Buyers.id as userid', 'Buyers.name as username','Buyers.email as useremail')
                     ->join('Buyers', 'Buyer_addresses.buyer_id', '=', 'Buyers.id')
                     ->get();

                    return view('front-end.user-address',compact('data'));
    }

    //Add new address
    function updateUserInfo(Request $request){

        $validatedData = $request->validate([

            'role' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
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
                return redirect()->route('showAddress');

        }
    }

    //update address
    public function updateAddress(Request $request) {
        // Validate the incoming request data

        // Find the Buyer_addresses record with the specified ID
        $buyerAddress = Buyer_addresses::find($request->id);

        // Check if the record exists
        if ($buyerAddress) {
            // Update the record with the new data
            $buyerAddress->update([
                'name' => $request->name,
                'email' => $request->email,
                'division' => $request->division,
                'district' => $request->district,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'place' => $request->place,
                'phone' => $request->phone,
            ]);
        // Optionally, you can return a success response
        return redirect()->route('showAddress')->with('success', 'Address updated successfully');
        } else {
            // Optionally, you can return an error response
            return redirect()->route('showAddress')->with('error', 'Address not found');
        }
    }

    //Delete Address
    function removeAddress($id){
        $address = Buyer_addresses::find($id);
        if ($address) {
        $address->delete();
        return back()->with('success', 'Address removed successfully.');
        return redirect()->route('showAddress');
        } else {
            return back()->with('error', 'Address not found.');
        }
    }


}

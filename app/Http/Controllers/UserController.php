<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){
        return view('front-end.user-register');
    }
    
    function add(Request $request){

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
    
}
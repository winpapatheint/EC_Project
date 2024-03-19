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
       
       
     

if(empty($request->id))
{
 
        $user = User::create([
            'role' => "buyer",
            'name' => $request->name,
            
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
        ]);
        $user->save();
        
      
       


    }
}
    
}

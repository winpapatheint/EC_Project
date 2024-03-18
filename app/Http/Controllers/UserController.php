<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){
        return view('front-end.user-register');
    }
    //
    function adduser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $query = DB::table('Users')->insert([
            'name'->$request->input('name'),
            'email'->$request->nput('emailS'),
            'password'->$request->input('password'),
            'role'->$request->input('buyer'),
        ]);

        if($query){
            return back()->with('success','Data have been successfully registration');
        }else{
            return back()->with('fail','Something went wrong');
        }
    }
    
}

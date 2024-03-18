<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Validator;
use Carbon\Carbon;

use Mail;

use App\Providers\RouteServiceProvider;
// use App\User;
use DateTime;

use App;

use Response;

use Illuminate\Support\Facades\Notification;
use App\Notifications\MsgNotiAdminUser;
use App\Notifications\MsgNotiAdminHcompany;
use App\Notifications\MsgNotiHcompanyHost;
use App\Notifications\MsgNotiHostHcompany;

use App\UserController\Adduser;


class AdminController extends Controller
{
   

    public function welcome()
    {  
       

        return view('front-end.index');
        
    }

    //adduser
    public function adduser(Request $request)
    {
        $data new users;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->role='buyer';
        $data->save();
        return redirect()->back();

        $data new buyers;
    }


}

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


class AdminController extends Controller
{


    public function welcome()
    {
        return view('front-end.index');

    }

    public function storecategory(Request $request)
    {

        $valarr = array('title' => 'required|string|max:255',
                        'category_icon' => 'not_in:0',
                            );

        if (empty($request->id)) {
            $valarr['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }


        $request->validate($valarr);

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }


        $time = new DateTime();

        if (empty($request->id)) {


dd($request->id);
            DB::table('category')->insert([
                'title' => $request->title,
                'content' => $request->content,
                'category' => $request->category,
                'headimg' => $imageName,
                'created_by' => Auth::user()->id,
                'author' => Auth::user()->name,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/news')->with('success', $msg );
        } else {

            $updval = array('title' => $request->title,
                            'content' => $request->content,
                            'category' => $request->category,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['headimg'] = $imageName;
            }

            DB::table('blog')->where('id',$request->id)->update($updval);

            return redirect('/admin/news')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

        }


    }



}

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

    public function indexcategory()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

        $lists = DB::table('Category')
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.category',compact('lists','ttlpage','ttl'));
    }

    public function indexsubtitle()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

        $lists = DB::table('Sub_categories_title')
                    ->select('C.category_name as category','Sub_categories_title.*')
                    ->join('Category as C', function ($join) {
                    $join->on('Sub_categories_title.category_id', '=', 'C.id');
                })
                ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.allsubtitle',compact('lists','ttlpage','ttl'));
    }

    public function deletecategory(Request $request)
    {
dd($request->id);
        $data = DB::table('Category')
                    ->delete($request->id);
        return redirect('/admin/all/category')->with('success','削除されました。');

    }
    public function addsubtitle()
    {
        $categories = DB::table('Category')
                    ->select('Category.*')
                    ->orderBy('Category.created_at', 'asc')->get();
        return view('admin.addsubtitle',compact('categories'));
    }


    public function editcategory($id)
    {
        $data = DB::table('Category')
                    ->find($id);

        return view('admin.addcategory',compact('data'));
    }

    public function storesubtitle(Request $request)
    {

        $valarr = [
            'subtitle' => 'required|array',
            'subtitle.*' => 'required|string|max:255', // Validate each subtitle individually
        ];

        $request->validate($valarr);
        $subtitle_arr = $request->subtitle;
        $time = new DateTime();
        if (empty($request->id)) {

            foreach ($subtitle_arr as $subtitle) {
                DB::table('Sub_categories_title')->insertOrIgnore([
                    'category_id' => $request->category,
                    'sub_category_titlename' => $subtitle,
                    'created_by' => $request->category,
                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                    ]);
            }

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/all/subtitle')->with('success', $msg );
        } else {

            $updval = array('category_name' => $request->title,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['headimg'] = $imageName;
            }

            DB::table('Sub_categories_title')->where('id',$request->id)->update($updval);

            return redirect('/admin/all/subtitle')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
        }

    }

    public function storecategory(Request $request)
     {

        $valarr = array('title' => 'required|string|max:255',

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

       // if (!empty($request->image)) {
          // $imageName = time().'.'.$request->image->extension();
           // $request->image->move(public_path('images'), $imageName);
        //} else {
          //  $imageName = '';
      //  }

        $time = new DateTime();

        if (empty($request->id)) {

            DB::table('Category')->insert([
                'category_name' => $request->title,
                'category_icon' => $imageName,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/all/category')->with('success', $msg );
        } else {

            $updval = array('category_name' => $request->title,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['headimg'] = $imageName;
            }

            DB::table('Category')->where('id',$request->id)->update($updval);

            return redirect('/admin/all/category')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

        }


    }



}

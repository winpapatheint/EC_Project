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

    public function indexblog()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

        $lists = DB::table('Blog')
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.blog.blog',compact('lists','ttlpage','ttl'));
    }


    public function indexsubcategory()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

        $lists = DB::table('Category')
        ->select('Category.id', 'Category.category_name as category', 'Category.*', 'Sb.*', 'S.*')
        ->leftJoin('Sub_categories_title as S', function ($join) {
            $join->on('Category.id', '=', 'S.category_id');
        })
        ->leftJoin('Sub_categories as Sb', function ($join) {
            $join->on('Sb.sub_category_title_id', '=', 'S.id');
            $join->on('Sb.category_id', '=', 'Category.id');
        })

        ->orderBy('Sb.created_at', 'desc')
        ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.allsubcategory',compact('lists','ttlpage','ttl'));
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

        $data = DB::table('Sub_categories_title')
                    ->delete($request->id);
        return redirect('/admin/all/subcategory')->with('success','削除されました。');

    }

    public function deleteblog(Request $request)
    {

        $data = DB::table('Blog')
                    ->delete($request->id);
        return redirect('/admin/all/blog')->with('success','削除されました。');

    }
    public function addsubtitle()
    {
        $categories = DB::table('Category')
                    ->select('Category.*')
                    ->orderBy('Category.created_at', 'asc')->get();
        return view('admin.addsubtitle',compact('categories'));
    }

    public function addsubcategory()
    {
        $categories = DB::table('Category')
                    ->select('Category.*')
                    ->orderBy('Category.created_at', 'asc')->get();
        return view('admin.addsubcategory',compact('categories'));
    }



    public function editcategory($id)
    {
        $data = DB::table('Category')
                    ->find($id);
        $editmode = true;

        return view('admin.addcategory',compact('data','editmode'));

    }

    public function editblog($id)
    {
        $data = DB::table('Blog')
                    ->find($id);
        $editmode = true;

        return view('admin.blog.addblog',compact('data','editmode'));

    }
    public function editsubtitle($id)
    {
        $subtitle = DB::table('Sub_categories_title')
                    ->find($id);

        $categories = DB::table('Category')
                    ->select('Category.*')
                    ->orderBy('Category.created_at', 'asc')->get();

        $category = DB::table('Category')
                    ->select('Category.*')
                    ->where('id', $subtitle->sub_category_id)
                    ->pluck('id')->toArray();

        $editmode = true;
        return view('admin.addsubtitle',compact('subtitle','categories','category','editmode'));

    }

    public function editsubcategory($id)
    {

       $subtitle = DB::table('Sub_categories_title')
                    ->find($id);
       $categories = DB::table('Category')
                    ->select('Category.*')
                    ->orderBy('Category.created_at', 'asc')->get();


        $category = DB::table('Sub_categories_title')
                    ->select('S.sub_category_name as subcategory_name')
                    ->join('Sub_categories as S', function ($join) {
                        $join->on('Sub_categories_title.sub_category_id', '=', 'S.sub_category_title_id');
                    })
                    ->orderBy('Sub_categories_title.created_at', 'desc')->get();

        $subcategory_name = DB::table('Sub_categories')
                       ->select('Sub_categories.sub_category_name')
                       ->where('sub_category_title_id', $id)
                       ->first();

        $subcategory_title = DB::table('Sub_categories_title')
                       ->select('Sub_categories_title.*')
                       ->where('id',$id)
                       ->orderBy('Sub_categories_title.created_at', 'desc')->first();

        $editmode = true;

        return view('admin.editcategory',compact('subtitle','categories','subcategory_title','subcategory_name','editmode'));

    }

    public function storesubtitle(Request $request)
    {

        $valarr = [
            'category' => 'not_in:0',
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
                    'sub_category_id' => $request->category,
                    'sub_category_titlename' => $subtitle,

                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                    ]);
            }

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/all/subcategory')->with('success', $msg );
        } else {


            $updval = array( 'category_id' => $request->category,
                            'sub_category_id' => $request->category,
                            'sub_category_titlename' => $request->subtitle[0],
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('Sub_categories_title')->where('id',$request->id)->update($updval);

            return redirect('/admin/all/subcategory')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
        }

    }


    public function storesubcategory(Request $request)
    {
        $valarr = [
            'category' => 'not_in:0',
            'subcategory' => 'required|string|max:255',
            'subname' => 'required|string|max:255', // Validate each subtitle individually
        ];

        $request->validate($valarr);
        $time = new DateTime();
        if (empty($request->id)) {

                DB::table('Sub_categories')->insert([
                    'category_id' => $request->category,
                    'sub_category_name' => $request->subname,
                    'sub_category_title_id' => $request->subcategory,
                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                    ]);

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/all/subcategory')->with('success', $msg );
        } else {

            $updval = array( 'category_id' => $request->category,
                            'sub_category_id' => $request->category,
                            'sub_category_titlename' => $request->subcategory,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('Sub_categories_title')->where('id',$request->id)->update($updval);

            $updval = array( 'category_id' => $request->category,
            'sub_category_name' => $request->subname,
            'sub_category_title_id' => $request->id,
            'updated_at' => $time->format('Y-m-d H:i:s')
            );
            DB::table('Sub_categories')->where('sub_category_title_id',$request->id)->update($updval);
            return redirect('/admin/all/subcategory')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
        }

    }


    public function storeblog(Request $request)
    {

       $valarr = array('title' => 'required|string|max:255',
                       'content' => 'required|string|max:255',

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

           DB::table('Blog')->insert([
               'title' => $request->title,
               'content' => $request->content,
               'image' => $imageName,
               'created_at' => $time->format('Y-m-d H:i:s'),
               'updated_at' => $time->format('Y-m-d H:i:s')
           ]);

           $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
           return redirect('/admin/all/blog')->with('success', $msg );
       } else {

           $updval = array('title' => $request->title,
                           'updated_at' => $time->format('Y-m-d H:i:s')
                           );

           if (!empty($request->image)) {
               $updval['content'] = $imageName;
           }

           DB::table('Blog')->where('id',$request->id)->update($updval);

           return redirect('/admin/all/blog')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

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
            return redirect('/admin/all/subcategory')->with('success', $msg );
        } else {

            $updval = array('category_name' => $request->title,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['category_icon'] = $imageName;
            }

            DB::table('Category')->where('id',$request->id)->update($updval);

            return redirect('/admin/all/subcategory')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

        }

    }

    public function getSubcategories(Request $request) {

        $subcategories =   DB::table('Sub_categories_title')->where('sub_category_id','=',$request->category)->get();
        return response()->json([
            'status' => 'success',
            'subcategories' => $subcategories,
        ]);

    }



}

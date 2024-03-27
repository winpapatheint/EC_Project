<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
use App\Http\Controllers\Auth\RegisteredUserController;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

class AdminController extends Controller
{


    public function welcome()
    {
        return view('front-end.index');

    }
    public function validatesubadmin($request, $editpassword = true , $editmode = false, $emailuniquecheck = true, $needimg = true)
    {


        $check = [
            'name' => 'required|string|max:255',
            // 'agerange' => 'required|not_in:0',
            'phone' => ['required', 'regex:/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/'],
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|string|max:255',

        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
            'address.required' => 'The address field is required.',
            'image.mimes' => '画像ファイルをアップロードしてください。',
            'image.required' => '画像ファイルをアップロードしてください。',
            // Add more custom error messages as needed
        ];


        if (!$editpassword) {
            unset($check['password']);
        }

        if ($editmode) {
            unset($check['check']);
        }

        if ($emailuniquecheck) {
            $check['email'] .= '|unique:users' ;
        }

        if (!$needimg) {
            unset($check['image']);
        }

        $validator = Validator::make($request->all(), $check, $messages);


        return $validator;

    }
    public function updateuser(Request $request)
    {
        if (!empty($request->id)) {
           $userprofile = User::find($request->id);

            $userid = DB::table('users')
                    ->select('users.id','users.email')
                    ->where('id', $request->id)->get()->pluck('email');

            $sellerid = DB::table('sellers')
                    ->select('sellers.id')
                    ->where('email', $userid[0])->pluck('id');

            $sellerprofile = Seller::find($sellerid[0]);

        } else {
           $userprofile = Auth::user();
        }

        if ($userprofile->role == 'admin') {

            $checkpassword = true;
            if ( empty($request->password) AND empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            }else {
                $emailuniquecheck = true;
            }

            $validator = $this->validatesubadmin($request,$checkpassword,true,$emailuniquecheck);
        //return response()->json(['error'=>'123']);
        }

        if ($userprofile->role == 'buyer' OR $userprofile->role == 'seller') {
        //return response()->json(['error'=>'456']);

            $checkpassword = true;
            if ( empty($request->password) AND empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            }else {
                $emailuniquecheck = true;
            }
            // return response()->json(['success'=>$checkpassword]);
            $validator = (new RegisteredUserController)->validateuser($request,$checkpassword,true,$emailuniquecheck);

        }

        if($request->ajax()){

            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }
            return response()->json(['error'=>$validator->errors()]);

        }

        $newval = array('name' => $request->name,
                        'email' => $request->email,
                    );


        if (!empty($request->shopname)) {
            $newval['shop_name'] = $request->shopname;
        }

        if (!empty($request->shopyear)) {
            $newval['shop_establish'] = $request->shopyear;
        }

        if (!empty($request->phone)) {
            $newval['phone'] = $request->phone;
        }

        if (!empty($request->zipcode)) {
            $newval['zip_code'] = $request->zipcode;
        }

        if (!empty($request->shoplink)) {
            $newval['url'] = $request->shoplink;
        }

        if (!empty($request->address)) {
            $newval['address'] = $request->address;
        }


        // Bank

        if (!empty($request->bankname)) {
            $newval['bank_name'] = $request->bankname;
        }

        if (!empty($request->accounttype)) {
            $newval['bank_acc_type'] = $request->accounttype;
        }

        if (!empty($request->branchname)) {
            $newval['bank_branch'] = $request->branchname;
        }

        if (!empty($request->bankaccountname)) {
            $newval['bank_acc_name'] = $request->bankaccountname;
        }

        if (!empty($request->bankaccountnumber)) {
            $newval['bank_acc_no'] = $request->bankaccountnumber;
        }
        //END Bank

        if (!empty($request->password)) {
            $newval['password'] = Hash::make($request->password);
        }

        if (!empty($request->shoplogo)) {
            $time = new DateTime();
            $imageNames = time().'.'.$request->shoplogo->extension();

            $request->shoplogo->move(public_path('upload/shop'), $imageName);
            $newval['shop_logo'] = $imageName;
        }
        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('images'), $imageName);
            $newval['user_photo'] = $imageName;
        }

        // print_r($upd);die;
        if ($userprofile->role == 'admin' OR $userprofile->role == 'seller' OR $userprofile->role == 'buyer') {
        $upd = $userprofile->update($newval);
        }
        if ($userprofile->role == 'seller') {

        $sellerupd = $sellerprofile->update($newval);
        }
        // print_r($userprofile->role);die;
        $msg = __('auth.donechange');

        return back()->with('success',$msg);

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

    public function indexproduct()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

        $lists = DB::table('Products')
                    ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.product.product_all',compact('lists','ttlpage','ttl'));
    }



    public function indexsubcategory()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

     $lists = DB::table('Categorys')
        ->select('Sb.id', 'Categorys.category_name as category',  'Sb.sub_category_name','S.sub_category_titlename')
        ->leftJoin('Sub_category_titles as S', function ($join) {
            $join->on('Categorys.id', '=', 'S.category_id');
        })
        ->leftJoin('Sub_categories as Sb', function ($join) {
            $join->on('Sb.sub_category_title_id', '=', 'S.id');
            $join->on('Sb.category_id', '=', 'Categorys.id');
        })

        ->orderBy('Sb.created_at', 'desc')
        ->paginate($limit);

        $listss = DB::table('Sub_categories')
        ->select('Sub_categories.*','Categorys.category_name as category','S.*')


        ->rightJoin('Categorys', function ($join) {
            $join->on('Categorys.id', '=', 'Sub_categories.category_id');

        })

        ->rightJoin('Sub_category_titles as S', function ($join) {
            $join->on('Sub_categories.sub_category_title_id', '=', 'S.id');
        })

        ->orderBy('Sub_categories.created_at', 'desc')
        ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.allsubcategory',compact('lists','ttlpage','ttl'));
    }

    public function blogdetail($id)
    {
        $blog = DB::table('blog')
                    ->select( 'blog.*')
                    ->where('blog.id',$id)->get();

        // print_r($blog[0]->created_at);die;
        $blog = $blog[0];

        return view('admin.blog.blog_detail',compact('blog'));
    }

    public function editdata(Request $request, $role, $id)
    {
        if (empty($role)) {
            $role = Auth::user()->role;
        }
        //
        $edituser = Auth::user();

        if (strlen($id) > 5) {

            // print_r(substr($id, 5));die;
            $id = substr($id, 5);

        if ($role == 'buyer' OR $role == 'admin')  {
            $edituser = User::find($id);
        }
        if ($role == 'seller')  {
            $editseller = DB::table('users')
                        ->select('sellers.*','users.*','users.id')
                        ->join('sellers', function ($join) {
                        $join->on('users.email', '=', 'sellers.email');
                    })
                    ->where('users.id',$id)
                    ->orderBy('users.created_at', 'desc')->first();
        }

            $editother = true;

        } else {
            $editother = false;
        }
        $editmode = true;

        if ($role == 'admin') {
            return view('admin.edituser',compact('editmode','editother','edituser'));
        } else if ($role == 'buyer') {
            return view('admin.editbuyerprofile',compact('editmode','editother','edituser'));
        } else if ($role == 'seller') {
            return view('admin.editsellerprofile',compact('editmode','editother','editseller'));
        } else {
            return view('admin.edituser',compact('editmode','editother','edituser'));
        }
    }

    public function userdetail($id)
    {
        $userlist = DB::table('users')
                    ->select( 'users.*')
                    ->where('users.id',$id)->get();

        // print_r($blog[0]->created_at);die;
        $user = $userlist[0];

        return view('admin.usersdetail',compact('user'));
    }

    public function subadmindetail($id)
    {
        $subadminlist = DB::table('users')
                    ->select( 'users.*')
                    ->where('users.id',$id)->get();

        // print_r($blog[0]->created_at);die;
        $subadmin = $subadminlist[0];

        return view('admin.subadmindetail',compact('subadmin'));
    }

    public function takeremote(Request $request, $id)
    {

        $adminid = Auth::user()->id;

        $adminrole = Auth::user()->role;
        if (strlen($id) > 5) {

            // print_r(substr($id, 5));die;
            $id = substr($id, 5);
            $edituser = User::find($id);
            $editother = true;

        }
       Auth::loginUsingId($id);
        // $user = User::find($id);
        // die(url()->previous());

        session(['isadmincontrol' => $adminid , 'rolecontrol' => $adminrole , 'returnurl' => url()->previous()]);
        print_r(session()->all());
        // print_r(Auth::user()->role);die;
        // print_r(Auth::user()->role);die();
        if (Auth::user()->role == 'admin' OR Auth::user()->role == 'subadmin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else if (Auth::user()->role == 'buyer') {
            return redirect()->intended(RouteServiceProvider::USER);
        } else if (Auth::user()->role == 'seller' OR Auth::user()->role == 'idlehost') {
            return redirect()->intended(RouteServiceProvider::SELLER);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // die($id);

    }

    public function indexuser()
    {

        $limit = 10;
        // print_r($type);die;

        $users = DB::table('users')->whereIn('role',['seller','buyer'])
                    ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $users->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.users',compact('users','ttlpage','ttl'));
    }

    public function indexsubadmin()
    {

        if (Auth::user()->id != '1') {
            abort(403, 'Unauthorized action.');
        }

        $limit = 10;

        $subadmins = User::where('role','admin')
                    ->where('id', '!=' , 1)

                    ->orderBy('created_at', 'desc')->paginate($limit);
        $ttl = $subadmins->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.subadmin',compact('subadmins','ttlpage','ttl'));
    }


    public function registersubadmin(Request $request)
    {


        $validator = $this->validatesubadmin($request);

        if($request->ajax()){

            if ($validator->passes()) {

                return response()->json(['success'=>'allpasses']);
            }
            return response()->json(['error'=>$validator->errors()]);

        }

        //*******************************************************

        if (empty($request->role)) {
            $role = 'admin';
        } else {
            $role = $request->role;
        }


        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

 // print_r($request->all());die;

        $user = User::create([
            'role' => $role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'user_photo' => $imageName,
        ]);

        $user->markEmailAsVerified();

        event(new Registered($user));

        return redirect('admin/subadmin')->with('success','「'.$request->name.'」登録されました。');

    }

    public function indexsubtitle()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

        $lists = DB::table('Sub_category_titles')
                    ->select('C.category_name as category','Sub_category_titles.*')
                    ->join('Categorys as C', function ($join) {
                    $join->on('Sub_category_titles.category_id', '=', 'C.id');
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

        $catlist =  DB::table('Categorys')
                        ->whereIn('id', function ($query) use ($request) {
                        $query->select('category_id')
                        ->from('Sub_category_titles')
                        ->where('id',$request->id);
                        })

                        ->delete();

        $subtitlelist = DB::table('Sub_category_titles')
        ->delete($request->id);

        return redirect('/admin/all/subcategory')->with('success','削除されました。');

    }

    public function deleteblog(Request $request)
    {

        $data = DB::table('Blog')
                    ->delete($request->id);
        return redirect('/admin/all/blog')->with('success','削除されました。');

    }

    public function deleteproduct(Request $request)
    {

        $data = DB::table('Products')
                    ->delete($request->id);
        return redirect('/admin/all/product')->with('success','削除されました。');

    }


    public function deleteuser(Request $request)
    {

        $data = DB::table('users')
                    ->delete($request->id);
        return redirect('/admin/all/users')->with('success','削除されました。');

    }

    public function deletesubadmin(Request $request)
    {

        $data = DB::table('users')
                    ->delete($request->id);
        return redirect('/admin/subadmin')->with('success','削除されました。');

    }
    public function addsubtitle()
    {
        $categories = DB::table('Categorys')
                    ->select('Categorys.*')
                    ->orderBy('Categorys.created_at', 'asc')->get();
        return view('admin.addsubtitle',compact('categories'));
    }

    public function addsubcategory()
    {
        $categories = DB::table('Categorys')
                    ->select('Categorys.*')
                    ->orderBy('Categorys.created_at', 'asc')->get();
        return view('admin.addsubcategory',compact('categories'));
    }



    public function editcategory($id)
    {
        $data = DB::table('Categorys')
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
        $subtitle = DB::table('Sub_category_titles')
                    ->find($id);

        $categories = DB::table('Categorys')
                    ->select('Categorys.*')
                    ->orderBy('Categorys.created_at', 'asc')->get();

        $category = DB::table('Categorys')
                    ->select('Categorys.*')
                    ->where('id', $subtitle->sub_category_id)
                    ->pluck('id')->toArray();

        $editmode = true;
        return view('admin.addsubtitle',compact('subtitle','categories','category','editmode'));

    }

    public function editsubcategory($id)
    {

        $subtitle = DB::table('Sub_categories')
                    ->find($id);

        $subcat_id = DB::table('Sub_categories')
                    ->select('Sub_categories.sub_category_title_id')
                    ->where('id',$id)->first();

        $subcategory_titlename = DB::table('Sub_category_titles')->where('id',$subcat_id->sub_category_title_id)->first();

        $categories = DB::table('Categorys')
                    ->select('Categorys.*')
                    ->orderBy('Categorys.created_at', 'asc')->get();


        $category = DB::table('Sub_category_titles')
                    ->select('S.sub_category_name as subcategory_name')
                    ->join('Sub_categories as S', function ($join) {
                    $join->on('Sub_category_titles.sub_category_id', '=', 'S.sub_category_title_id');
                })
                ->orderBy('Sub_category_titles.created_at', 'desc')->get();

        $subcategory_name = DB::table('Sub_categories')
                            ->select('Sub_categories.sub_category_name')
                            ->where('id', $id)
                            ->first();

        $editmode = true;

        return view('admin.editcategory',compact('subcat_id','subtitle','categories','subcategory_titlename','subcategory_name','editmode'));

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
                DB::table('Sub_category_titles')->insertOrIgnore([
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

            DB::table('Sub_category_titles')->where('id',$request->id)->update($updval);

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
                             'sub_category_name' => $request->subname ?? '',
                             'sub_category_title_id' => $request->subcategory ?? '',
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('Sub_categories')->where('id',$request->id)->update($updval);

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
                           'content' => $request->content,
                           'updated_at' => $time->format('Y-m-d H:i:s')
                           );

           if (!empty($request->image)) {
               $updval['image'] = $imageName;
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

            DB::table('Categorys')->insert([
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

            DB::table('Categorys')->where('id',$request->id)->update($updval);

            return redirect('/admin/all/subcategory')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

        }

    }

    public function getSubcategories(Request $request) {

        $subcategories =   DB::table('Sub_category_titles')->where('sub_category_id','=',$request->category)->get();
        return response()->json([
            'status' => 'success',
            'subcategories' => $subcategories,
        ]);

    }



}

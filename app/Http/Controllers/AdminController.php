<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\MultiImg;
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
        $categories = DB::table('Categories')
            ->select(
                'Categories.id',
                'Categories.category_name as category_name',
            )
            ->groupby( 'Categories.id')
            ->get();

        $blogs = DB::table('Blog')
        ->select( 'U.name as authorby', 'Blog.*')
        ->join('users as U', function ($join) {
            $join->on('Blog.created_by', '=', 'U.id');
        })
        ->orderBy('created_at', 'desc')->paginate(2);

        $mostDiscountItems = Product::orderBy('discount_percent', 'desc')->get();

        return view('front-end.welcome',compact('blogs','categories', 'mostDiscountItems'));
    }

    public function news()
    {
        $limit = 10;

        $blogs = DB::table('Blog')
                    ->select( 'U.name as authorby', 'Blog.*')
                    ->join('users as U', function ($join) {
                        $join->on('Blog.created_by', '=', 'U.id');
                    })
                    ->orderBy('created_at', 'desc')->paginate($limit);

        $limit = 4;
        $latestblog = DB::table('Blog')
                        ->orderBy('created_at', 'desc')
                        ->paginate($limit);

        $ttl = $blogs->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.blog-list',compact('blogs','ttlpage','ttl','latestblog'));

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
        }

         else {
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

            $request->shoplogo->move(public_path('upload/shop'), $imageNames);
            $newval['shop_logo'] = $imageNames;
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



    public function updatehost(Request $request)
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

        }
        else {
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

            $request->shoplogo->move(public_path('upload/shop'), $imageNames);
            $newval['shop_logo'] = $imageNames;
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

    public function indexreview()
    {
        $limit = 10;

        $lists = DB::table('Reviews')
                    ->select( 'U.name as authorby', 'Reviews.*','U.*','Reviews.id','Reviews.status')
                    ->join('users as U', function ($join) {
                        $join->on('Reviews.user_id', '=', 'U.id');
                    })

                    ->whereIn('role',['seller','buyer'])
                    ->paginate($limit);
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

    // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.product.product_review',compact('lists','ttlpage','ttl'));
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

    public function indexshopproduct($id)
    {
        $limit = 10;

        $shoplist = DB::table('products as P')
                    ->select( 'P.*','C.*')
                    ->Join('Categories as C', function ($join) {
                        $join->on('C.id', '=', 'P.category_id');
                    })
                    ->where('P.seller_id',$id)->orderBy('P.created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.shop-left-sidebar',compact('shoplist','ttlpage','ttl'));
    }

    public function indexsubcategory()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

     $lists = DB::table('Categories')
        ->select('Sb.id', 'Categories.category_name as category',  'Sb.sub_category_name','S.sub_category_titlename')
        ->leftJoin('Sub_category_titles as S', function ($join) {
            $join->on('Categories.id', '=', 'S.category_id');
        })
        ->leftJoin('Sub_categories as Sb', function ($join) {
            $join->on('Sb.sub_category_title_id', '=', 'S.id');
            $join->on('Sb.category_id', '=', 'Categories.id');
        })

        ->orderBy('Sb.created_at', 'desc')
        ->paginate($limit);

        $listss = DB::table('Sub_categories')
        ->select('Sub_categories.*','Categories.category_name as category','S.*')


        ->rightJoin('Categories', function ($join) {
            $join->on('Categories.id', '=', 'Sub_categories.category_id');

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

        $blog = $blog[0];

        return view('admin.blog.blog_detail',compact('blog'));
    }

    public function indexshop($id)
    {
        $limit =14;
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select('product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
            ->join('Products', 'Products.id', '=', 'Reviews.product_id')
            ->where('Products.category_id', $id)
            ->groupBy('product_id')
            ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            if (!empty($matchedProductIds)) {
                $query->whereIn('id', $matchedProductIds);
            }
            else {
                $query->where('id', null);
            }
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) BETWEEN 5 AND 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) BETWEEN 10 AND 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) BETWEEN 15 AND 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        $shoplist = $query->where('category_id',$id)
                          ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $ratingWithProductCount = Review::select(
                                        DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
                                    )
                                    ->join('Products', 'Products.id', '=', 'Reviews.product_id')
                                    ->where('Products.category_id', $id)
                                    ->groupBy('product_id')
                                    ->get()
                                    ->groupBy('average_rating')
                                    ->map(function ($grouped) {
                                        return $grouped->count();
                                    });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) < 5 THEN 1 END) as group_1_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) BETWEEN 5 AND 10 THEN 1 END) as group_2_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) BETWEEN 10 AND 15 THEN 1 END) as group_3_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) BETWEEN 15 AND 25 THEN 1 END) as group_4_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                                    ->where('category_id', $id)
                                    ->where('status', '=', '1')
                                    ->first();

        return view('front-end.shop-left-sidebar',compact('id','shoplist','ttlpage','ttl', 'price', 'search', 'rating', 'ratingWithProductCount', 'discount',
        'discount','discountWithProductCount', 'sort', 'reviews'));
    }

    public function bloglistdetail($id)
    {
        $blog = DB::table('blog')
                    ->select( 'U.name as authorby', 'blog.*')
                    ->join('users as U', function ($join) {
                        $join->on('blog.created_by', '=', 'U.id');
                    })
                    ->where('blog.id',$id)->get();

        $blog = $blog[0];

        $limit = 4;
        $latestblog = DB::table('Blog')
                    ->where('id','<>',$id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($limit);

        return view('front-end.blog-detail',compact('blog','latestblog'));
    }

    public function productdetail($id)
    {
        $products = DB::table('Products')
                    ->select( 'Products.*','Brands.*')
                    ->join('Brands', function ($join) {
                        $join->on('Brands.id', '=', 'Products.brand_id');
                    })
                    ->where('Products.id',$id)->get();

        // print_r($blog[0]->created_at);die;
        $product = $products[0];

        return view('admin.product.product_detail',compact('product'));
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

        if ($role == 'admin')  {
            $edituser = User::find($id);
        }
        if ($role == 'buyer')  {
            $edituser = DB::table('users')
                        ->select('buyers.*','users.*','users.id')
                        ->join('buyers', function ($join) {
                        $join->on('users.id', '=', 'buyers.user_id');
                    })
                    ->where('users.id',$id)
                    ->orderBy('users.created_at', 'desc')->first();
        }
        if ($role == 'seller')  {
            $editseller = DB::table('users')
                        ->select('sellers.*','users.*','users.id')
                        ->join('sellers', function ($join) {
                        $join->on('users.id', '=', 'sellers.user_id');
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

    public function indexstatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return redirect()->back();
    }

    public function  indexsubadminstatus(Request $request)
    {
        $user = User::find($request->userid);
        $user->status = $request->status;
        $user->save();
        return redirect('/admin/profile')->back();
    }



    public function indexuserstatus(Request $request)
    {
        $user = User::find($request->userid);
        $user->status = $request->status;
        // if(empty($user->status))
        // {
        //     User::where('id', $request->userid)->update(['role' => 'idleuser']);

        // }
        $user->save();

        return redirect('/admin/profile')->back();
    }

    public function indexreviewstatus(Request $request)
    {
        $user = Review::find($request->review_id);
        $user->status = $request->status;
        $user->save();
        return redirect('/admin/profile')->back();
    }


    public function indexshoplist(Request $request)
    {
        $limit=10;

        $lists = DB::table('sellers as S')
        ->select('S.*', 'U.*', 'S.phone', DB::raw('(SELECT COUNT(*) FROM products WHERE seller_id = S.user_id) as product_count'))
        ->join('users as U', 'U.id', '=', 'S.user_id')
        ->orderBy('S.created_at', 'desc')
        ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.seller-grid',compact('lists','ttlpage','ttl'));
    }



    public function indexuser()
    {

        $limit = 10;

        // print_r($type);die;

      //  $updval = array('status' => '1');
        $users = DB::table('users')
                    ->select('users.id','users.*')
                    ->whereIn('role',['seller','buyer'])
                    ->where('email_verified_at','<>','')
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                    ->orWhereNull('email_verified_at');
                    })
                    ->orderBy('created_at', 'desc')->paginate($limit);

     //foreach ($users as $user) {
            //DB::table('users')->where('id', $user->id)->update($updval);
       // }

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
                    ->join('Categories as C', function ($join) {
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

        $catlist =  DB::table('Categories')
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
        $categories = DB::table('Categories')
                    ->select('Categories.*')
                    ->orderBy('Categories.created_at', 'asc')->get();
        return view('admin.addsubtitle',compact('categories'));
    }

    public function addsubcategory()
    {
        $categories = DB::table('Categories')
                    ->select('Categories.*')
                    ->orderBy('Categories.created_at', 'asc')->get();
        return view('admin.addsubcategory',compact('categories'));
    }



    public function editcategory($id)
    {
        $data = DB::table('Categories')
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

    public function editproduct($id)
    {
        $brands = DB::table('Brands')->orderBy('created_at', 'desc')->get();
        $countries = DB::table('Countries')->orderBy('created_at', 'desc')->get();
        $categorylist = DB::table('Categories')->orderBy('created_at', 'desc')->get();
        $subtitlelist = DB::table('Sub_category_titles')->orderBy('created_at', 'desc')->get();
        $subcategorylist = DB::table('Sub_categories')->orderBy('created_at', 'desc')->get();
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $data = DB::table('Products as P')
                ->where('P.id',$id)
                ->orderBy('P.created_at', 'desc')->first();

        $editmode = true;

        return view('admin.editproduct',compact('data','editmode','brands','countries','categorylist','subtitlelist','subcategorylist','multiImgs'));

    }

    public function editsubtitle($id)
    {
        $subtitle = DB::table('Sub_category_titles')
                    ->find($id);

        $categories = DB::table('Categories')
                    ->select('Categories.*')
                    ->orderBy('Categories.created_at', 'asc')->get();

        $category = DB::table('Categories')
                    ->select('Categories.*')
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

        $categories = DB::table('Categories')
                    ->select('Categories.*')
                    ->orderBy('Categories.created_at', 'asc')->get();


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
        if (empty($request->id))
        {
        $request->validate($valarr);
    }
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
               'created_by' => Auth::user()->id,
               'author' => Auth::user()->name,
               'created_at' => $time->format('Y-m-d H:i:s'),
               'updated_at' => $time->format('Y-m-d H:i:s')
           ]);

           $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
           return redirect('/admin/all/blog')->with('success', $msg );
       } else {

           $updval = array('title' => $request->title,
                           'content' => $request->content,
                           'created_by' => Auth::user()->id,
                           'author' => Auth::user()->name,
                           'updated_at' => $time->format('Y-m-d H:i:s')
                           );

           if (!empty($request->image)) {
               $updval['image'] = $imageName;
           }

           DB::table('Blog')->where('id',$request->id)->update($updval);

           return redirect('/admin/all/blog')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

       }

   }

   public function storeproduct(Request $request)
     {
        $time = new DateTime();

        //commision calculate
        $originalPrice = $request->selling_price;
        $discountPercentage = $request->discount_percent;
        $discountAmount = ($originalPrice * $discountPercentage) / 100;
        $discountedPrice = $originalPrice - $discountAmount;

        $commisonPrice = $request->commision;
        $commisonAmount = ($discountedPrice * $commisonPrice) / 100;
        $sellerAmount = $discountedPrice - $commisonAmount;

        $adminAmount = $discountedPrice -  $sellerAmount;

        $updval = array('product_code' => $request->productcode,
                        'product_name' => $request->productname,
                        'country_id' => $request->country,
                        'brand_id' => $request->brand,
                        'category_id' => $request->category,
                        'sub_category_title_id' => $request->subcattitle,
                        'sub_category_id' => $request->subcategory,
                        'product_tags' => $request->product_tags,
                        'product_size' => $request->product_size,
                        'product_color' => $request->product_color,
                        'short_desc' => $request->short_desc,
                        'long_desc' => $request->long_desc,

                        'selling_price' => $request->selling_price,
                        'discount_percent' => $request->discount_percent,
                        'product_qty' => $request->product_qty,
                        'estimate_date' => $request->estimate_date,
                        'commission' => $request->commision,
                        'com_price' => $adminAmount,
                        'seller_amount' => $sellerAmount,
                        'updated_at' => $time->format('Y-m-d H:i:s')
                        );

                        if (!empty($request->product_thambnail)) {
                            $imageName = time().'.'.$request->product_thambnail->extension();
                            $request->product_thambnail->move(public_path('upload/product_thambnail/'), $imageName);
                        } else {
                            $imageName = '';
                        }

            if (!empty($request->product_thambnail)) {
                $updval['product_thambnail'] = $imageName;
            }

            DB::table('Products')->where('id',$request->id)->update($updval);

            return redirect('/admin/all/product')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
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

            DB::table('Categories')->insert([
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

            DB::table('Categories')->where('id',$request->id)->update($updval);

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

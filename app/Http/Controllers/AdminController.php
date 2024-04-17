<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Process;
use App\Models\Category;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Help;
use App\Models\MultiImg;
use App\Models\Coupon;
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
use DateTime;
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

        $categories = Category::all();

        $blogs = DB::table('blogs')
                    ->select( 'U.name as authorby', 'blogs.*')
                    ->join('users as U', function ($join) {
                    $join->on('blogs.created_by', '=', 'U.id');
                })
                ->orderBy('created_at', 'desc')->paginate(2);

        $maxStarsRatedRow = DB::table('reviews')
                ->select('users.id', 'users.name','reviews.comment', DB::raw('MAX(stars_rated) as max_stars_rated'))
                ->join('users', 'users.id', '=', 'reviews.user_id')
                ->groupBy('users.id', 'users.name','reviews.comment')
                ->orderByDesc('max_stars_rated')
                ->first();
        $mostDiscountPercentages = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];

        $productsGroupedByDiscount = [];

        foreach ($mostDiscountPercentages as $discountPercent) {
            $productsGroupedByDiscount[$discountPercent] = Product::where('discount_percent', $discountPercent)->pluck('id')
            ->toArray();
        }

        $topSaveTodayProducts = Product::where('coupon_status', 1)->get();

        $reviews = Review::all();

        $bestSellerProducts = DB::table('products')
            ->select('products.*', DB::raw('COUNT(order_details.id) as total_orders'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereMonth('order_details.created_at', '=', Carbon::now()->month)
            ->groupBy('products.id')
            ->orderByDesc('total_orders')
            ->get();

        $trendingProducts = DB::table('products')
            ->select('products.*', DB::raw('COUNT(order_details.id) as total_orders'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereDate('order_details.created_at', '=', Carbon::today())
            ->groupBy('products.id')
            ->orderByDesc('total_orders')
            ->take(4)
            ->get();

        $coupon = Coupon::where('status', 1)->first();

        $seafood = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.category_name', 'Seafood')->pluck('products.id')
            ->toArray();

        $vegetable = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.category_name', 'Vegetable')->pluck('products.id')
            ->toArray();

        $meatHalfDiscount = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('discount_percent', 50)
            ->where('categories.category_name', 'Meat')
            ->pluck('products.id')->toArray();

        $vegetableHalfDiscount = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('discount_percent', 50)
            ->where('categories.category_name', 'Vegetable')
            ->pluck('products.id')->toArray();

        return view('front-end.welcome',compact('blogs','categories','maxStarsRatedRow', 'productsGroupedByDiscount', 'topSaveTodayProducts', 'reviews',
         'bestSellerProducts', 'trendingProducts', 'coupon', 'seafood', 'vegetable', 'meatHalfDiscount', 'vegetableHalfDiscount'));
    }

    public function news()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $limit = 10;

        if ($search) {
            $blogs = DB::table('blogs')
                        ->select( 'U.name as authorby', 'blogs.*')
                        ->join('users as U', function ($join) {
                            $join->on('blogs.created_by', '=', 'U.id');
                        })
                        ->where('blogs.title', 'like', '%' . $search . '%')
                        ->orderBy('created_at', 'desc')->paginate($limit);
        }
        else {
            $blogs = DB::table('blogs')
                        ->select( 'U.name as authorby', 'blogs.*')
                        ->join('users as U', function ($join) {
                            $join->on('blogs.created_by', '=', 'U.id');
                        })
                        ->orderBy('created_at', 'desc')->paginate($limit);
        }

        $limit = 4;
        $latestblog = DB::table('blogs')
                        ->orderBy('created_at', 'desc')
                        ->paginate($limit);

        $ttl = $blogs->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.blog-list',compact('blogs','ttlpage','ttl','latestblog', 'search'));

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

        $lists = DB::table('categories')
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

        $lists = DB::table('blogs')
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

        $lists = DB::table('reviews')
                    ->select( 'U.name as authorby', 'reviews.*','U.*','reviews.id','reviews.status')
                    ->join('users as U', function ($join) {
                        $join->on('reviews.user_id', '=', 'U.id');
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

        $lists = DB::table('products')
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

        // $shoplist = DB::table('products as P')
        //             ->select( 'P.*','C.*')
        //             ->Join('Categories as C', function ($join) {
        //                 $join->on('C.id', '=', 'P.category_id');
        //             })
        //             ->where('P.seller_id',$id)->orderBy('P.created_at', 'desc')->paginate($limit);

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
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $id)
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
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
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

        $shoplist = $query->where('seller_id',$id)
                          ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $ratingWithProductCount = Review::select(
                                        DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
                                    )
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.seller_id', $id)
                                    ->groupBy('product_id')
                                    ->get()
                                    ->groupBy('average_rating')
                                    ->map(function ($grouped) {
                                        return $grouped->count();
                                    });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                                    ->where('seller_id', $id)
                                    ->where('status', '=', '1')
                                    ->first();

        return view('front-end.shop-left-sidebar',compact('id','shoplist','ttlpage','ttl', 'price', 'search', 'rating', 'ratingWithProductCount', 'discount',
        'discount','discountWithProductCount', 'sort', 'reviews'));
    }

    public function indexsubcategory()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }


        $lists = DB::table('categories')
                    ->select('categories.id as categoryId', 'categories.category_name as category', 'Sb.id as subCatId', 'Sb.sub_category_name','S.id as subCatTitleId','S.sub_category_titlename')
                    ->leftJoin('sub_category_titles as S', function ($join) {
                        $join->on('categories.id', '=', 'S.category_id');
                    })
                    ->leftJoin('sub_categories as Sb', function ($join) {
                        $join->on('Sb.sub_category_title_id', '=', 'S.id');
                        $join->on('Sb.category_id', '=', 'categories.id');
                    })

                    ->orderBy('Sb.created_at', 'desc')
                    ->paginate($limit);

        $listss = DB::table('sub_categories')
        ->select('sub_categories.*','categories.category_name as category','S.*')


        ->rightJoin('categories', function ($join) {
            $join->on('categories.id', '=', 'sub_categories.category_id');

        })

        ->rightJoin('sub_category_titles as S', function ($join) {
            $join->on('sub_categories.sub_category_title_id', '=', 'S.id');
        })

        ->orderBy('sub_categories.created_at', 'desc')
        ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.allsubcategory',compact('lists','ttlpage','ttl'));
    }

    public function blogdetail($id)
    {
        $blog = DB::table('blogs')
                ->select( 'blogs.*')
                ->where('blogs.id',$id)->get();
        $blog = $blog[0];

        return view('admin.blog.blog_detail',compact('blog'));
    }

    public function orderdetail($id)
    {
        $order = Order::find($id);
        return view('admin.order.orderdetail',compact('order'));
    }

    public function orderTracking($id)
    {
        $order = Order::find($id);
        $process = Process::where('order_id',$id)->latest()->get();
        return view('admin.order.ordertracking',compact('order','process'));
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
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.category_id', $id)
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
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
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
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.category_id', $id)
                                    ->groupBy('product_id')
                                    ->get()
                                    ->groupBy('average_rating')
                                    ->map(function ($grouped) {
                                        return $grouped->count();
                                    });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                                    ->where('category_id', $id)
                                    ->where('status', '=', '1')
                                    ->first();

        return view('front-end.shop-left-sidebar',compact('id','shoplist','ttlpage','ttl', 'price', 'search', 'rating', 'ratingWithProductCount', 'discount',
        'discount','discountWithProductCount', 'sort', 'reviews'));
    }

    public function indexcategoryproduct($id)
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
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.category_id', $id)
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
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
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
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.category_id', $id)
                                    ->groupBy('product_id')
                                    ->get()
                                    ->groupBy('average_rating')
                                    ->map(function ($grouped) {
                                        return $grouped->count();
                                    });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                                    ->where('category_id', $id)
                                    ->where('status', '=', '1')
                                    ->first();

        return view('front-end.category-left-sidebar',compact('id','shoplist','ttlpage','ttl', 'price', 'search', 'rating', 'ratingWithProductCount', 'discount',
        'discount','discountWithProductCount', 'sort', 'reviews'));
    }

    public function indexsubcategoryproduct($id)
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
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.sub_category_id', $id)
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
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
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

        $shoplist = $query->where('sub_category_id',$id)
                          ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $ratingWithProductCount = Review::select(
                                        DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
                                    )
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.sub_category_id', $id)
                                    ->groupBy('product_id')
                                    ->get()
                                    ->groupBy('average_rating')
                                    ->map(function ($grouped) {
                                        return $grouped->count();
                                    });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
                                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                                    ->where('sub_category_id', $id)
                                    ->where('status', '=', '1')
                                    ->first();

        return view('front-end.sub-category-left-sidebar',compact('id','shoplist','ttlpage','ttl', 'price', 'search', 'rating', 'ratingWithProductCount', 'discount',
        'discount','discountWithProductCount', 'sort', 'reviews'));
    }

    public function bloglistdetail($id)
    {
        $blog = DB::table('blogs')
                    ->select( 'U.name as authorby', 'blogs.*')
                    ->join('users as U', function ($join) {
                        $join->on('blogs.created_by', '=', 'U.id');
                    })
                    ->where('blogs.id',$id)->get();

        $blog = $blog[0];

        $limit = 4;
        $latestblog = DB::table('blogs')
                    ->where('id','<>',$id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($limit);

        return view('front-end.blog-detail',compact('blog','latestblog'));
    }

    public function productdetail($id)
    {
        $products = DB::table('products')
                    ->select( 'products.*','brands.*')
                    ->join('brands', function ($join) {
                        $join->on('brands.id', '=', 'products.brand_id');
                    })
                    ->where('products.id',$id)->get();

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
    public function indexcouponstatus(Request $request)
    {
        $coupon = Coupon::find($request->coupon_id);
        $coupon->status = $request->status;
        $coupon->save();
        return redirect('/admin/profile')->back();
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

    public function storefaq(Request $request)
    {

// print_r($request->all());die;


        $request->validate(['title' => 'required|string|max:255',
                            'que' => 'required|string|max:255',
                            'ans' => 'required|string|max:600',
                            ],
            [
                'que.required' => '質問を入力してください',
                'ans.required' => '答えを入力してください',
                'phone.regex' => '有効な電話番号を入力してください',
            ]);

        $time = new DateTime();

        if (empty($request->id)) {

            DB::table('faqs')->insert([
                'title' => $request->title,
                'ans' => $request->ans,
                'que' => $request->que,
                'created_by' => Auth::user()->id,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            // print_r(json_decode($faqord, true));die;

            return redirect('/admin/faq')->with('success','「'.$request->title.'」登録されました。');
        } else {

            $updval = array('title' => $request->title,
                            'ans' => $request->ans,
                            'que' => $request->que,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('faqs')->where('id',$request->id)->update($updval);

            return redirect('/admin/faq')->with('success','「'.$request->title.'」更新されました。');

        }

    }

    public function indexfaq()
    {
        $limit = 10;
        $lists = DB::table('faqs')
                    ->select('faqs.*')
                    ->orderBy('created_at', 'desc')->paginate($limit);
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r(Auth::user()->role);die;
        if (Auth::check()){
            if (Auth::user()->role == 'admin') {
                return view('admin.indexfaq',compact('lists','ttlpage','ttl'));
            }
        }

        return view('front-end.faq',compact('lists'));

    }

    public function indexcoupon()
    {
        $limit = 10;
        $lists = DB::table('coupons')
                    ->select('coupons.*')
                    ->orderBy('created_at', 'desc')->paginate($limit);
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexcoupon',compact('lists','ttlpage','ttl'));

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

        $lists = DB::table('sub_category_titles')
                    ->select('C.category_name as category','sub_category_titles.*')
                    ->join('categories as C', function ($join) {
                    $join->on('sub_category_titles.category_id', '=', 'C.id');
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
        DB::table('sub_category_titles')->where('id', $request->id)->delete();
        DB::table('categories')->where('id', $request->id)->delete();
        return redirect('/admin/category')->with('success','削除されました。');
    }

    public function deleteblog(Request $request)
    {

        $data = DB::table('blogs')
                    ->delete($request->id);
        return redirect('/admin/all/blog')->with('success','削除されました。');

    }

    public function deleteorderlist(Request $request)
    {

        $data = DB::table('orders')
                    ->delete($request->id);
        return redirect('/admin/orderlist')->with('success','削除されました。');

    }

    public function deletecoupon(Request $request)
    {

        $data = DB::table('coupons')
                    ->delete($request->id);
        return redirect('admin/coupon')->with('success','削除されました。');

    }

    public function deletefaq(Request $request)
    {

        $data = DB::table('faqs')
                    ->delete($request->id);
        return redirect('/admin/faq')->with('success','削除されました。');

    }

    public function deleteproduct(Request $request)
    {

        $data = DB::table('products')
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
        $categories = DB::table('categories')
                    ->select('categories.*')
                    ->orderBy('categories.created_at', 'asc')->get();
        return view('admin.addsubtitle',compact('categories'));
    }

    public function addsubcategory()
    {
        $categories = DB::table('categories')
                    ->select('categories.*')
                    ->orderBy('categories.created_at', 'asc')->get();
        return view('admin.addsubcategory',compact('categories'));
    }

    public function editcategory($id)
    {

        $data = DB::table('categories')
                    ->find($id);
        $editmode = true;

        return view('admin.addcategory',compact('data','editmode'));

    }

    public function editblog($id)
    {
        $data = DB::table('blogs')
                    ->find($id);
        $editmode = true;

        return view('admin.blog.addblog',compact('data','editmode'));

    }


    public function editcoupon($id)
    {
        $data = DB::table('coupons')
                    ->find($id);
        $editmode = true;

        return view('admin.addcoupon',compact('data','editmode'));

    }

    public function editfaq($id)
    {
        $faq = DB::table('faqs')
                    ->find($id);
        // print_r($faq);die;
        $editmode = true;
        // $hcompanies = array();
        return view('admin.registerfaq',compact('faq','editmode'));
    }

    public function editproduct($id)
    {
        $brands = DB::table('brands')->orderBy('created_at', 'desc')->get();
        $countries = DB::table('countries')->orderBy('created_at', 'desc')->get();
        $categorylist = DB::table('categories')->orderBy('created_at', 'desc')->get();
        $subtitlelist = DB::table('sub_category_titles')->orderBy('created_at', 'desc')->get();
        $subcategorylist = DB::table('sub_categories')->orderBy('created_at', 'desc')->get();
        $coupons = DB::table('coupons')->orderBy('created_at', 'desc')->get();

        $product_coupon = DB::table('products as P')
                    ->select('P.coupon_id','P.coupon_status')
                    ->where('P.id',$id)
                    ->orderBy('P.created_at', 'desc')->first();

        $couponlist = DB::table('coupons')
                        ->select('coupons.id')
                        ->where('id',$product_coupon->coupon_id)
                        ->orderBy('created_at', 'desc')->first();


        $multiImgs = MultiImg::where('product_id',$id)->get();
        $data = DB::table('products as P')
                ->where('P.id',$id)
                ->orderBy('P.created_at', 'desc')->first();

        $editmode = true;

        return view('admin.editproduct',compact('data','editmode','brands','countries','categorylist','subtitlelist','subcategorylist','multiImgs','coupons','couponlist','product_coupon'));

    }

    public function editsubtitle($id)
    {
        $subtitle = DB::table('sub_category_titles')
                    ->find($id);

        $categories = DB::table('categories')
                    ->select('categories.*')
                    ->orderBy('categories.created_at', 'asc')->get();

        $category = DB::table('categories')
                    ->select('categories.*')
                    ->where('id', $subtitle->sub_category_id)
                    ->pluck('id')->toArray();

        $editmode = true;
        return view('admin.addsubtitle',compact('subtitle','categories','category','editmode'));

    }

    public function editsubcategory($type,$id)
    {
        if($type==3)
        {
            $subtitle = DB::table('sub_categories')
                        ->find($id);

            $subcat_id = DB::table('sub_categories')
                        ->select('sub_categories.sub_category_title_id')
                        ->where('id',$id)->first();

            $subcategory_titlename = DB::table('sub_category_titles')->where('id',$subcat_id->sub_category_title_id)->first();

            $categories = DB::table('categories')
                        ->select('categories.*')
                        ->orderBy('categories.created_at', 'asc')->get();


            $category = DB::table('sub_category_titles')
                        ->select('S.sub_category_name as subcategory_name')
                        ->join('sub_categories as S', function ($join) {
                        $join->on('sub_category_titles.sub_category_id', '=', 'S.sub_category_title_id');
                    })
                    ->orderBy('sub_category_titles.created_at', 'desc')->get();

            $subcategory_name = DB::table('sub_categories')
                                ->select('sub_categories.sub_category_name')
                                ->where('id', $id)
                                ->first();


            $editmode = true;

            return view('admin.editcategory',compact('subcat_id','subtitle','categories','subcategory_titlename','subcategory_name','editmode'));
        }
        else if($type == 1)
        {
            $data = DB::table('categories')
                        ->find($id);
            $editmode = true;

            return view('admin.addcategory',compact('data','editmode'));
        }
        else
        {
            $subtitle = DB::table('sub_category_titles')
                            ->find($id);

            $categories = DB::table('categories')
                        ->select('categories.*')
                        ->orderBy('categories.created_at', 'asc')->get();

            $category = DB::table('categories')
                        ->select('categories.*')
                        ->where('id', $subtitle->sub_category_id)
                        ->pluck('id')->toArray();

            $editmode = true;

            return view('admin.editsubcattitle',compact('subtitle','categories','category','editmode'));
        }


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
                DB::table('sub_category_titles')->insertOrIgnore([
                    'category_id' => $request->category,
                    'sub_category_id' => $request->category,
                    'sub_category_titlename' => $subtitle,

                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                    ]);
            }

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/category')->with('success', $msg );
        } else {


            $updval = array( 'category_id' => $request->category,
                            'sub_category_id' => $request->category,
                            'sub_category_titlename' => $request->subtitle[0],
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('sub_category_titles')->where('id',$request->id)->update($updval);

            return redirect('/admin/category')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
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

                DB::table('sub_categories')->insert([
                    'category_id' => $request->category,
                    'sub_category_name' => $request->subname,
                    'sub_category_title_id' => $request->subcategory,
                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                    ]);

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/category')->with('success', $msg );
        } else {

            $updval = array( 'category_id' => $request->category,
                             'sub_category_name' => $request->subname ?? '',
                             'sub_category_title_id' => $request->subcategory ?? '',
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('sub_categories')->where('id',$request->id)->update($updval);

            return redirect('/admin/category')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
        }

    }

    public function contact(Request $request)
    {
        if ($request->from == 'faq') {
            $inquiry_email = 'info-test@asia-hd.com';

            $valarr = array(
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
                'message' => 'required',

            );
            $request->validate($valarr);

            $data = array('name'=>$request->name);

            if (!empty($request->email)) {
                $mail = Mail::send([], $data, function($message) use ($request, $inquiry_email) {
                    $message->to($inquiry_email, 'Ecommerce ')->subject($request->name.'からの質問');
                    $message->from($request->email,$request->name);
                    $message->setBody("E commerce 公式サイトから、以下の問い合わせがありました。
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                    \r\n名前：　".$request->name."
                    \r\n"."メールアドレス：　".$request->email."
                    \r\n
                    \r\n"."お問い合わせ内容：　
                    \r\n".$request->message."
                    \r\n
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                });
            }

            return redirect('/faq#ts-form')->with('success','お問い合わせ内容が正常に送信されました。');


        }

        else if( $request->from == 'contact')
        {
            $inquiry_email = 'info-test@asia-hd.com';

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
                'message' => 'required',
            ]);

            $data = array('name'=>$request->name);
            if (!empty($request->email)) {
                $mail = Mail::send([], $data, function($message) use ($request, $inquiry_email) {

                    $message->to($inquiry_email, 'Ecommerce ')->subject($request->name.'からの質問');
                    $message->from($request->email,$request->name);
                    $message->setBody("E commerce 公式サイトから、以下の問い合わせがありました。
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                    \r\n名前：　".$request->name."
                    \r\n"."メールアドレス：　".$request->email."
                    \r\n
                    \r\n"."お問い合わせ内容：　
                    \r\n".$request->message."
                    \r\n
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");

                });
            }

            return redirect('/contact#contact-form')->with('success','お問い合わせ内容が正常に送信されました。');

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

           DB::table('blogs')->insert([
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

           DB::table('blogs')->where('id',$request->id)->update($updval);

           return redirect('/admin/all/blog')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

       }

   }

   public function storecoupon(Request $request)
    {
        if (empty($request->id)) {
        $request->validate(['title' => 'required|string|max:255',
        'code' => 'required|string|max:255',
        'disamount' => 'required|numeric|max:9999999999.999999',
        'miniamount' => 'required|numeric|max:9999999999.999999',
        'validamount' => 'required|numeric|max:9999999999.999999',
        'validdate' => 'required|date',
        ],
            [
                'code.required' => 'コードを入力してください',
                'disamount.required' => 'disamount is required',
                'miniamount.required' => 'miniamount is required',
                'validamount.required' => 'validamount is required',
                'validdate.required' => 'validdate is required',
                ]);
            }

       $time = new DateTime();

       if (empty($request->id)) {

           DB::table('coupons')->insert([
               'name' => $request->title,
               'coupon_code' => $request->code,
               'discount_amount' => $request->disamount,
               'mini_amount' => $request->miniamount,
               'valid_amount' => $request->validamount,
               'valid_date' => $request->validdate,
               'created_at' => $time->format('Y-m-d H:i:s'),
               'updated_at' => $time->format('Y-m-d H:i:s')
           ]);

           $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
           return redirect('/admin/coupon')->with('success', $msg );
       } else {

           $updval = array('name' => $request->title,
                            'coupon_code' => $request->code,
                            'discount_amount' => $request->disamount,
                            'mini_amount' => $request->miniamount,
                            'valid_amount' => $request->validamount,
                            'valid_date' => $request->validdate,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                           );

           DB::table('coupons')->where('id',$request->id)->update($updval);

           return redirect('/admin/coupon')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

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
                        'coupon_id' => $request->coupon,
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
            if (!empty($request->status)) {
                if($request->status === 'yes')
                {
                    $updval['coupon_status'] = 1;
                }
                else{
                    $updval['coupon_status'] = 0;
                }
            }

            DB::table('products')->where('id',$request->id)->update($updval);

            return redirect('/admin/product')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
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

        $time = new DateTime();

        if (empty($request->id)) {

            DB::table('categories')->insert([
                'category_name' => $request->title,
                'category_icon' => $imageName,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            $msg = trans('auth.doneregister', [ 'name' => $request->title ]);
            return redirect('/admin/category')->with('success', $msg );
        } else {

            $updval = array('category_name' => $request->title,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['category_icon'] = $imageName;
            }

            DB::table('categories')->where('id',$request->id)->update($updval);

            return redirect('/admin/category')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

        }
    }

    public function getSubcategories(Request $request) {

        $subcategories =   DB::table('sub_category_titles')->where('sub_category_id','=',$request->category)->get();
        return response()->json([
            'status' => 'success',
            'subcategories' => $subcategories,
        ]);

    }

    public function indexorderlist()
    {
        $order = Order::latest()->paginate(10);
        return view('admin.order.indexorderlist',compact('order'));

    }

    public function admindashboard()
    {
        $limit=5;
        $transfer = Order::latest()->paginate($limit);
        $orders = Order::selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name")
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("MONTH(created_at)"), 'created_at')
                        ->pluck('count', 'month_name');
        $ttl = $transfer->total();
        $ttlpage = (ceil($ttl / $limit));
        $labels = $orders->keys();
        $data = $orders->values();
        return view('admin.index',compact('labels', 'data','transfer','ttl','ttlpage'));
    }

    public function indexhelp()
    {
        $helps = Help::latest()->paginate(4);
        return view('admin.indexhelp',compact('helps'));
    }

    public function addHelp()
    {
        return view('admin.addhelp');
    }

}

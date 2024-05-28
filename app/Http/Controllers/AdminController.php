<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Process;
use App\Models\Category;
use App\Models\SubCategoryTitle;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Help;
use App\Models\SellerNotification;
use App\Models\Notification;
use App\Models\MultiImg;
use App\Models\Coupon;
use App\Models\Transfer;
use App\Models\Top;
use App\Models\NewsLetter;
use App\Models\Customer;
use App\Models\Brand;
use App\Models\Country;
use App\Models\SubCategory;
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
use App\Models\Blog;
use App\Models\Faq;
use Illuminate\Support\Facades\File;
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
        // coupon to be inactive for the end date
        $couponAll = Coupon::where('enddate', '<=', Carbon::now()->endOfDay())->get();
        foreach ($couponAll as $couponInactive)
        {
            $couponInactive->status = 0;
            $couponInactive->save();

            $sellers = Seller::where('coupon_id', $couponInactive->id)->get();
            foreach($sellers as $seller)
            {
                $seller->coupon_id = NULL;
                $seller->coupon_status = 0;
                $seller->save();
            }

            $products = Product::where('coupon_id', $couponInactive->id)->get();
            foreach($products as $product)
            {
                $product->coupon_id = NULL;
                $product->coupon_status = 0;
                $product->save();
            }
        }
        // end coupon to be inactive for the end date

        $categories = Category::all();

        $blogs = DB::table('blogs')
                    ->select( 'U.name as authorby', 'blogs.*')
                    ->join('users as U', function ($join) {
                    $join->on('blogs.created_by', '=', 'U.id');
                })
                ->orderBy('created_at', 'desc')->paginate(2);

        $maxStarsRatedRow = DB::table('reviews')
                ->select('users.id', 'users.name', 'users.user_photo', 'reviews.comment', DB::raw('MAX(stars_rated) as max_stars_rated'))
                ->join('users', 'users.id', '=', 'reviews.user_id')
                ->groupBy('users.id', 'users.name','reviews.comment')
                ->orderByDesc('max_stars_rated')
                ->first();

        $customers =  Customer::all();

        $mostDiscountPercentages = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];

        $productsGroupedByDiscount = [];

        foreach ($mostDiscountPercentages as $discountPercent) {
            $productsGroupedByDiscount[$discountPercent] = Product::where('discount_percent', $discountPercent)
            ->where('status', 1)
            ->pluck('id')
            ->toArray();
        }

        $topSaveTodayProducts = Product::where(function($query) {
            $query->whereHas('Seller', function ($query) {
                    $query->where('coupon_status', 1);
                })
                ->orWhere('products.coupon_status', '=', '1');
        })->where('status', 1)->get();

        $reviews = Review::all();

        $bestSellerProducts = DB::table('products')
            ->select('products.*', DB::raw('COUNT(order_details.id) as total_orders'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereMonth('order_details.created_at', '=', Carbon::now()->month)
            ->where('products.status', 1)
            ->groupBy('products.id')
            ->orderByDesc('total_orders')
            ->get();

        $endDate = Carbon::now()->endOfDay();
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $trendingProducts = DB::table('products')
            ->select('products.*', DB::raw('COUNT(order_details.id) as total_orders'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereBetween('order_details.created_at', [$startDate, $endDate])
            ->where('products.status', 1)
            ->groupBy('products.id')
            ->orderByDesc('total_orders')
            ->take(4)
            ->get();

        $coupons = Coupon::with('seller')->with('product')->where('status', 1)->orderBy('enddate', 'asc')->get();

        $seafood = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.category_name', 'Seafood')
            ->where('products.status', 1)->pluck('products.id')
            ->toArray();

        $vegetable = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.category_name', 'Vegetable')
            ->where('products.status', 1)->pluck('products.id')
            ->toArray();

        $meatHalfDiscount = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('discount_percent', 50)
            ->where('categories.category_name', 'Meat')
            ->where('products.status', 1)
            ->pluck('products.id')->toArray();

        $vegetableHalfDiscount = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('discount_percent', 50)
            ->where('categories.category_name', 'Vegetable')
            ->where('products.status', 1)
            ->pluck('products.id')->toArray();

        return view('front-end.welcome',compact('blogs','categories','maxStarsRatedRow', 'productsGroupedByDiscount', 'topSaveTodayProducts', 'reviews',
         'bestSellerProducts', 'trendingProducts', 'coupons', 'seafood', 'vegetable', 'meatHalfDiscount', 'vegetableHalfDiscount','customers'));
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
        $msg = __('Profile Updated Successfully');

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
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Category::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('category_name', 'like', '%' . $mainSearch . '%');
            })
            ->orWhereHas('subCategoryTitle', function ($query) use ($mainSearch) {
                $query->where('sub_category_titlename', 'like', '%' . $mainSearch . '%');
            })
            ->orWhereHas('subCategory', function ($query) use ($mainSearch) {
                $query->where('sub_category_name', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.category',compact('lists','ttlpage','ttl'));
    }

    public function indexblog()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Blog::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('title', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.blog.blog',compact('lists','ttlpage','ttl'));
    }


    public function indextop()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Top::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('discount', 'like', '%' . $mainSearch . '%')
                        ->orWhere('phaseone', 'like', '%' . $mainSearch . '%')
                      ->orWhere('phasetwo', 'like', '%' . $mainSearch . '%')
                      ->orWhere('phasethree', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.top',compact('lists','ttlpage','ttl'));
    }

    public function indexnewsletter()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = NewsLetter::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('email', 'like', '%' . $mainSearch . '%');

            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.newsletter',compact('lists','ttlpage','ttl'));
    }

    public function indexcustomer()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Customer::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('title', 'like', '%' . $mainSearch . '%')
                      ->orWhere('subtitle', 'like', '%' . $mainSearch . '%')
                      ->orWhere('content', 'like', '%' . $mainSearch . '%')
                      ->orWhere('name', 'like', '%' . $mainSearch . '%')
                      ->orWhere('position', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexcustomer',compact('lists','ttlpage','ttl'));
    }



    public function indexreview()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Review::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('comment', 'like', '%' . $mainSearch . '%')
                ->where('created_at', 'like', '%' . $mainSearch . '%');
            })
            ->orWhereHas('user', function ($query) use ($mainSearch) {
                $query->where('name', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->leftjoin('users', 'users.id', '=', 'reviews.user_id')
                        ->leftjoin('products','products.id', '=', 'reviews.product_id')
                        ->select('reviews.*','reviews.created_at as reviewdate','products.*','users.*','reviews.id','reviews.status')
                        ->orderBy('reviews.created_at', 'desc') // Assuming created_at belongs to reviews table
                        ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.product.product_review',compact('lists','ttlpage','ttl'));
    }

    public function indexproduct()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Product::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('product_name', 'like', '%' . $mainSearch . '%')
                        ->orWhere('product_qty', 'like', '%' . $mainSearch . '%')
                      ->orWhere('selling_price', 'like', '%' . $mainSearch . '%')
                      ->orWhere('discount_percent', 'like', '%' . $mainSearch . '%')
                      ->orWhere('commission', 'like', '%' . $mainSearch . '%');
            });
        }
        $query->leftjoin('coupons', 'products.coupon_id', '=', 'coupons.id')
                ->select('products.*', 'coupons.enddate', 'coupon_code as coupon_code') // Adjust the select statement as necessary
                ->orderBy('products.created_at', 'desc');

        $lists = $query->with('Seller')->orderBy('products.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $subCatTitle = SubCategoryTitle::whereHas('category', function($query) {
            $query->where('category_name', 'Special Corner');
        })->get();

        $coupons = DB::table('coupons')->where('status',1)->orderBY('created_at', 'desc')->get();

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.product.product_all',compact('lists','ttlpage','ttl', 'subCatTitle','coupons'));
    }

    public function shoplist()
    {
        $limit = 10;

        //Identify expired coupons
        $expiredCoupons = DB::table('coupons')
                            ->where('enddate', '<', now())
                            ->pluck('id');
        // Update status of corresponding sellers
        $inactivestatus = DB::table('sellers')
                            ->whereIn('coupon_id', $expiredCoupons)
                            ->update(['coupon_id' => null]);

        $lists = Seller::with('user')
                    ->with('user.products')
                    ->with('user.products.reviews')
                    ->leftJoin('coupons', 'sellers.coupon_id', '=', 'coupons.id')
                    ->leftJoin('users', 'sellers.user_id', '=', 'users.id') // Join users table with condition
                    ->select('sellers.*', 'coupons.*','sellers.status', 'sellers.id', 'sellers.coupon_id', 'sellers.created_at', 'sellers.shop_establish','users.role','sellers.user_id','sellers.commission') // Select all columns from the sellers table
                    ->latest('sellers.created_at') // Specify the table for ordering
                    ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));
        $coupons = DB::table('coupons')->where('status',1)->orderBY('created_at', 'desc')->get();

        return view('admin.allshop',compact('lists','ttlpage','ttl','coupons'));
    }


    public function indexshopproduct($id)
    {
        $limit = 12;

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
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
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
                    ->orderBy('review_count', 'DESC');
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

        $shoplist = $query->where('products.seller_id',$id)
                          ->where('products.status', 1)
                          ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                                    ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                                    ->where('products.status', '=', '1')
                                    ->where('products.seller_id', $id)
                                    ->groupBy('categories.id')
                                    ->get();

        $ratingWithProductCount = Review::select(
                                        DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
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

        $shopInfo = Seller::with('user')->with('user.products')->with('user.products.reviews')->where('user_id', $id)->first();
        $ratingWith = 0;
        $reviewCount = 0;
        $productStarReview = 0;
        $productCount = 0;
        $ratingForShop = [];
        foreach($shopInfo->user->products as $product)
        {
            if ($product->reviews->isNotEmpty())
            {
                foreach($product->reviews as $review)
                {
                    $ratingWith += $review->stars_rated;
                    $reviewCount++;
                }
                $productStarReview += $ratingWith / $product->reviews->count();
                $ratingWith = 0;
            }
            $productCount++;
        }
        if ($productStarReview > 0)
        {
            $ratingForShop[0] = floor($productStarReview / $productCount);
            $ratingForShop[1] = $reviewCount;
        }
        else
        {
            $ratingForShop[0] = 0;
            $ratingForShop[1] = 0;
        }

        return view('front-end.shop-left-sidebar',compact('id','shoplist','ttlpage','ttl', 'price', 'search', 'rating', 'ratingWithProductCount', 'discount',
        'discount','discountWithProductCount', 'sort', 'reviews', 'shopInfo', 'categoryWithProductCount', 'categories', 'ratingForShop'));
    }

    public function indexsubcategory()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;

        $query = SubCategoryTitle::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('sub_category_titlename', 'like', '%' . $mainSearch . '%');
            });
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
        $limit = 12;
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
                                        DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
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
        $limit = 12;
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
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
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

        $shoplist = $query->where('category_id',$id)->where('products.status', 1)
                          ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                                            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                                            ->where('products.status', '=', '1')
                                            ->where('products.category_id', $id)
                                            ->groupBy('categories.id')
                                            ->get();

        $ratingWithProductCount = Review::select(
                                        DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
                                    )
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.category_id', $id)
                                    ->where('products.status', '=', '1')
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
        'discount','discountWithProductCount', 'sort', 'reviews', 'categories', 'categoryWithProductCount'));
    }

    public function indexsubcategoryproduct($id)
    {
        $limit = 12;
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
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
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
                        ->where('products.status', '=', '1')
                          ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                                    ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                                    ->where('products.status', '=', '1')
                                    ->where('products.sub_category_id', $id)
                                    ->groupBy('categories.id')
                                    ->get();

        $ratingWithProductCount = Review::select(
                                        DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
                                    )
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.sub_category_id', $id)
                                    ->where('products.status', '=', '1')
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
        'discount','discountWithProductCount', 'sort', 'reviews', 'categories', 'categoryWithProductCount'));
    }

    public function bloglistdetail($id)
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
                        ->where('blogs.id',$id)
                        ->orderBy('created_at', 'desc')->get();
                        $blog = $blogs[0];
        }

        $limit = 4;
        $latestblog = DB::table('blogs')
                    ->where('id','<>',$id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($limit);

        return view('front-end.blog-detail',compact('blog','latestblog','search'));
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

    public function shopdetail($id)
    {
        $shops = DB::table('sellers')
                    ->select( 'sellers.*')
                    ->where('sellers.id',$id)->get();
        $coupon_id = DB::table('sellers')
                        ->where('id', $id)
                        ->pluck('coupon_id')
                        ->first();
        $coupon_code = DB::table('coupons')
                        ->where('id', $coupon_id)
                        ->pluck('coupon_code')
                        ->first();
        $shop = $shops[0];

        return view('admin.shopdetail',compact('shop','coupon_code'));
    }

    public function coupondetail($id)
    {
        $coupon = DB::table('coupons')
                        ->select('coupons.*')
                        ->where('id', $id)
                        ->first();

        return view('admin.coupondetail',compact('coupon'));
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

    public function shoptakeremote(Request $request, $id)
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

    }

    public function indexstatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return redirect()->back();
    }
    public function indexshopstatus(Request $request)
    {
        $shop = Seller::find($request->shop_id);
        $shop->status = $request->status;
        $shop->save();
        Product::where('seller_id', $shop->user_id)->update(['status' => $request->status]);
        return redirect()->back();
    }

    public function indextransferstatus(Request $request)
    {
        $transfer = Transfer::find($request->transfer_id);
        $transfer->status = $request->status;
        $transfer->save();
        return redirect()->back();
    }

    // Active and InActive Coupon Status
    public function indexcouponstatus(Request $request)
    {
        $coupon = Coupon::find($request->coupon_id);
        $coupon->status = $request->status;
        $coupon->save();

        if ($request->status == 0)
        {
            $shop = Seller::where('coupon_id',$request->coupon_id)->get();
            if ($shop)
            {
                foreach ($shop as $sh)
                {
                    $sh->coupon_status = 0;
                    $sh->save();
                }
            }
            $product = Product::where('coupon_id', $request->coupon_id)->get();
            if ($product)
            {
                foreach ($product as $pr)
                {
                    if ($pr->coupon_status == 0)
                    {
                        $pr->coupon_id = null;
                        $pr->save();
                    }
                    else
                    {
                        $pr->coupon_status = 0;
                        $pr->save();
                    }
                }
            }
        }
        else
        {
            $product = Product::where('coupon_id', $request->coupon_id)->get();
            if ($product)
            {
                foreach ($product as $pr)
                {
                    {
                        $pr->coupon_status = 1;
                        $pr->save();
                    }
                }
            }
            $shop = Seller::where('coupon_id',$request->coupon_id)->get();
            if ($shop)
            {
                foreach ($shop as $sh)
                {
                    $sh->coupon_status = 1;
                    $sh->save();
                    $shopProducts = Product::where('seller_id', $sh->user_id)->where('coupon_status', 0)->whereNull('coupon_id')->get();
                    foreach($shopProducts as $shProd)
                    {
                        $shProd->coupon_id = $sh->coupon_id;
                        $shProd->save();
                    }
                }
            }
        }

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
        $limit = 12;

        $lists = Seller::with('user')->with('user.products')->with('user.products.reviews')
                    ->where('status', 1)->paginate($limit);

        $ratingWithProductCount = [];
        foreach ($lists as $shop =>$seller) {
            $ratingWith = 0;
            $reviewCount = 0;
            $productStarReview = 0;
            $productCount = 0;
            if ($seller->user->products->isNotEmpty())
            {
                foreach($seller->user->products as $product)
                {
                    if ($product->reviews->isNotEmpty())
                    {
                        foreach($product->reviews as $review)
                        {
                            $ratingWith += $review->stars_rated;
                            $reviewCount++;
                        }
                        $productStarReview += $ratingWith / $product->reviews->count();
                        $ratingWith = 0;
                    }
                    $productCount++;
                }
            }
            if ($productStarReview > 0)
            {
                $ratingWithProductCount[$shop][0] = floor($productStarReview / $productCount);
                $ratingWithProductCount[$shop][1] = $reviewCount;
            }
            else
            {
                $ratingWithProductCount[$shop][0] = 0;
                $ratingWithProductCount[$shop][1] = 0;
            }
        }

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.seller-grid',compact('lists','ttlpage','ttl', 'ratingWithProductCount'));
    }


    public function storeReply(Request $request)
    {

        $validatedData = $request->validate([
            'body' => 'present|string|max:255',
        ]);

        $help = new Help();
        if($request->hasFile('image'))
        {
            $img = $request->file('image');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('upload/shop'), $filename);
            $help->img = $filename;
        }
        $shopName = Seller::where('user_id', $request->help_id)->value('shop_name');
        $check = Help::find($request->id);
        $help->help_id = $check ? $check->help_id ?? $request->id : $request->id;
        $help->name = 'admin';
        $help->shop_name =   $shopName;
        $help->to =  $check->from;
        $help->from = 'info-test@asia-hd.com';
        $help->subject = $request->subject;
        $help->body = $validatedData['body'];
        $help->updated_at = Carbon::now();
        $help->save();

        $inquiry_email = 'info-test@asia-hd.com';
        $sellerEmails =  $check->from;
        $data = ['subject' => $request->subject];

            Mail::send([], $data, function ($message) use ($request, $sellerEmails, $inquiry_email) {
                $message->to($sellerEmails)->subject($request->subject . 'からの質問');
                $message->from($inquiry_email, $request->subject);
                $message->setBody("We received the following notice message from the official e-commerce website.
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                    \r\nName：　" . $request->subject . "
                    \r\nEmail：　" .  $inquiry_email . "
                    \r\n
                    \r\nMessage：　
                    \r\n" . $request->subject . "
                    \r\n
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
            });

        $msg = ('Data sent successfully');
        return redirect('/admin/indexhelp')->with('success', $msg);
    }

    public function helpDetail($id)
    {
        $getId = Help::find($id);
        $helpId = $getId->help_id;
        if ($helpId) {
            $start = DB::table('helps')->where('id',$id)->first();
            $reply = Help::where('help_id', $helpId)->get();
        } else {
            $start = $getId;
            $reply = null;
        }

        return view('admin.helpdetail', compact('start', 'reply'));

    }

    public function storenewsletter(Request $request)
    {
       $time = new DateTime();

       $existingEmail = DB::table('newsletters')
       ->where('email', $request->newsletter)
       ->exists();

       if ($existingEmail) {

        $msg = trans('Email is duplicated.', [ 'name' => $request->title ]);
        return redirect('/')->with('error', $msg );
       }


       if (empty($request->id)) {

           DB::table('newsletters')->insert([
               'email' => $request->newsletter,
               'created_at' => $time->format('Y-m-d H:i:s'),
               'updated_at' => $time->format('Y-m-d H:i:s')
           ]);

           $msg = trans('Sending newsletter mail successfully', [ 'name' => $request->title ]);
           return redirect('/')->with('success', $msg );
       }

       return redirect('/')->with('success', $msg );

       }

    public function storeblog(Request $request)
    {
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
               'content' => $request->content_desc,
               'image' => $imageName,
               'created_by' => Auth::user()->id,
               'author' => Auth::user()->name,
               'created_at' => $time->format('Y-m-d H:i:s'),
               'updated_at' => $time->format('Y-m-d H:i:s')
           ]);


           $msg = trans('Register Successfully', [ 'name' => $request->title ]);
           return redirect('/admin/all/blog')->with('success', $msg );
       } else {
           $updval = array('title' => $request->title,
                           'content' => $request->content_desc,
                           'created_by' => Auth::user()->id,
                           'author' => Auth::user()->name,
                           'updated_at' => $time->format('Y-m-d H:i:s')
                           );

           if (!empty($request->image)) {
               $updval['image'] = $imageName;
           }

           DB::table('blogs')->where('id',$request->id)->update($updval);

           return redirect('/admin/all/blog')->with('success','「'.$request->title.'」'.__('Updated Successfully.'));

       }

   }

    public function storefaq(Request $request)
    {
        $time = new DateTime();

        if (empty($request->id)) {

            DB::table('faqs')->insert([
                'title' => $request->title,
                'ans' => $request->content_desc,
                'que' => $request->content_ansdesc,
                'created_by' => Auth::user()->id,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            $msg = trans('Register Successfully', [ 'name' => $request->title ]);
            return redirect('/admin/faq')->with('success', $msg );

        } else {

            $updval = array('title' => $request->title,
                            'ans' => $request->content_desc,
                            'que' => $request->content_ansdesc,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('faqs')->where('id',$request->id)->update($updval);
            return redirect('admin/faq')->with('success','「'.$request->title.'」'.__('Updated Successfully.'));

        }

    }

    public function indexfaq()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Faq::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('title', 'like', '%' . $mainSearch . '%')
                ->orWhere('ans', 'like', '%' . $mainSearch . '%')
                ->orWhere('que', 'like', '%' . $mainSearch . '%')
                ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }
        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);
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
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Coupon::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('name', 'like', '%' . $mainSearch . '%')
                ->orWhere('coupon_code', 'like', '%' . $mainSearch . '%')
                ->orWhere('discount_amount', 'like', '%' . $mainSearch . '%')
                ->orWhere('mini_amount', 'like', '%' . $mainSearch . '%')
                ->orWhere('valid_count', 'like', '%' . $mainSearch . '%')
                ->orWhere('startdate', 'like', '%' . $mainSearch . '%')
                ->orWhere('enddate', 'like', '%' . $mainSearch . '%')
                ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }
        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);
        foreach ($lists as $list) {
            // Check if the enddate has passed
            if (Carbon::parse($list->enddate)->isPast()) {
                // Update the status to 0
                $list->status = 0;
                $list->save();
            }
        }
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexcoupon',compact('lists','ttlpage','ttl'));

    }

    public function indexuser()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = User::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('name', 'like', '%' . $mainSearch . '%')
                ->orWhere('email', 'like', '%' . $mainSearch . '%')
                ->orWhere('role', 'like', '%' . $mainSearch . '%')
                ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }
        // print_r($type);die;

        $users = $query->whereIn('role',['seller','buyer'])
                    ->where('email_verified_at','<>','')
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                    ->orWhereNull('email_verified_at');
                    })
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
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = User::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('name', 'like', '%' . $mainSearch . '%')
                ->orWhere('email', 'like', '%' . $mainSearch . '%')
                ->orWhere('role', 'like', '%' . $mainSearch . '%')
                ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }

        $subadmins = $query->where('role','admin')
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

    public function deleteNotice(Request $request)
    {
        $id = $request->id;
        $help = Help::findOrFail($id);
        $imagePath = public_path('upload/shop/' . $help->img);
        $help->delete();
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $msg = ('Data deleted successfully');
      return redirect()->back()->with('success', $msg);
    }

    public function deletecategory(Request $request)
    {
        if($request->type=='1')
        {
                Category::where('id', $request->id)->delete();
        }
        else{
            $cat = SubCategoryTitle::find($request->id);
            $categoryId = $cat->category_id;
            DB::table('sub_category_titles')->where('id', $request->id)->delete();
            $categoryIdExist = SubCategoryTitle::where('category_id', $categoryId)->exists();
            if (!$categoryIdExist){
                Category::where('id', $categoryId)->delete();
            }
        }
        return redirect('/admin/category')->with('success','deleted.');
    }

    public function deleteblog(Request $request)
    {

        $data = DB::table('blogs')
                    ->delete($request->id);
        return redirect('/admin/all/blog')->with('success','Deleted Successfully.');

    }

    // reset product commission
    public function deletecommission(Request $request)
    {
        $item = Product::find($request->id);
        $shop = Seller::where('user_id', $item->seller_id)->first();
        $item->commission_status = 0;
        $item->commission = $shop->commission;
        $item->save();
        return redirect('/admin/product')->with('success','Deleted Successfully.');

    }


    public function deletenewsletter(Request $request)
    {

        $data = DB::table('newsletters')
                    ->delete($request->id);
        return redirect('/admin/newsletter')->with('success','Deleted Successfully.');

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

    // update coupon for shop
    public function  updatecoupon(Request $request)
    {
        $time = new DateTime();

        $seller = Seller::find($request->id);
        $seller->update([
            'coupon_status' => 1,
            'coupon_id' => $request->couponid,
            'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);

        $products = Product::where('seller_id', $seller->user_id)->where('coupon_status', 0)->get();
        foreach ($products as $product)
        {
            $product->update(['coupon_id' => $request->couponid]);
        }

        return redirect('/admin/shoplist')->with('success','coupon added');

    }

    public function  updatecommission(Request $request)
    {
        // $request->validate([
        //     'commission' => 'required|numeric',
        //     'commissionid' => 'required|integer',
        // ]);

        // Retrieve the input values
        $commission = $request->input('commission');

        $commissionId = $request->input('commissionid');

        // Process the data (e.g., update the database)
        $item = Seller::find($commissionId);

        if ($item) {
            $item->commission = $commission;
            $item->save();
        }
        $products = Product::where('seller_id', $item->user_id)
                    ->where(function($query) {
                        $query->where('commission_status', '!=', 1)
                              ->orWhereNull('commission_status');
                    })
                    ->get();

        foreach($products as $item)
        {
            $item->commission =   $commission ;
            $item->commission_status =   0 ;
            $item->save();
        }
        // $time = new DateTime();
        // $updval = array( 'commission' => $request->commission,
        //                 'updated_at' => $time->format('Y-m-d H:i:s')
        //                 );

        // DB::table('sellers')->where('id',$request->id)->update($updval);

        return redirect('/admin/shoplist')->with('success','commission added');

    }

    public function  updateadjust(Request $request)
    {
        $adjust = $request->input('adjust');
        $adjustId = $request->input('adjustId');
        $item = Transfer::find( $adjustId);

        if ($item) {
            $item->adjust_amount = $adjust;
            $item->save();
        }
        return redirect('/admin')->with('success','adjust added');

    }

    public function  updateproductcommission(Request $request)
    {
        // Retrieve the input values
        $commission = $request->input('commission');

        $commissionId = $request->input('commissionid');

        // Process the data (e.g., update the database)
        $item = Product::find($commissionId);

        if ($item) {
            $item->commission = $commission;
            $item->commission_status = 1;
            $item->save();
        }

        return redirect('/admin/product')->with('success','commission added');

    }

    // update coupon for product
    public function  updateproductcoupon(Request $request)
    {
        $time = new DateTime();
        $updval = array( 'coupon_id' => $request->couponid,
                        'coupon_status' => 1,
                        'updated_at' => $time->format('Y-m-d H:i:s')
                        );

        DB::table('products')->where('id',$request->id)->update($updval);

        return redirect('/admin/product')->with('success','coupon added');

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

    public function edittop($id)
    {

        $data = DB::table('tops')
                    ->find($id);
        $editmode = true;

        return view('admin.registertop',compact('data','editmode'));

    }

    public function editcustomer($id)
    {

        $data = DB::table('customers')
                    ->find($id);
        $editmode = true;

        return view('admin.customer',compact('data','editmode'));

    }

    public function editblog($id)
    {
        $data = DB::table('blogs')
                    ->find($id);
        $editmode = true;

        return view('admin.blog.addblog',compact('data','editmode'));

    }

    public function edithelp($id)
    {
        $data = DB::table('helps')
                    ->find($id);
        $editmode = true;

        return view('admin.addhelp',compact('data','editmode'));

    }

    public function addhelp()
    {
        $data = DB::table('users')
                ->select('users.*')
                ->where('role', 'seller')
                ->get();

    return view('admin.addhelp', compact('data'));

    }

    public function addnotice()
    {

    return view('admin.addnotice');

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

    public function updateMultiImg(Request $request)
    {
        $request->validate([
            'multi_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imgs = $request->multi_img;
        foreach($imgs as $id => $img)
        {
            $imgDel = MultiImg::findOrFail($id);
            File::delete($imgDel->photo_name);
        }
        $filename = time() . '_' . rand(100, 999) . '.' . $img->getClientOriginalExtension();
        $img->move('upload/multiImg', $filename);
        MultiImg::where('id',$id)->update([
            'photo_name' => $filename,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('flash_message', 'Image updated successfully');
    }

    public function deleteMultiImg($id)
    {
        $old_img = MultiImg::findOrFail($id);
        File::delete($old_img->photo_name);
        MultiImg::findOrFail($id)->delete();
        return back()->with('flash_message', 'Image deleted successfully');
    }

    public function editproduct($id)
    {
        $brands = Brand::latest()->get();
        $countries = Country::latest()->get();
        $categories = Category::latest()->where('category_name', '!=', 'Special Corner')->get();
        $subcategories = SubCategory::latest()->get();
        $subcatitle = SubCategoryTitle::latest()->get();
        $products = Product::findOrFail($id);
        $multiImgs = MultiImg::where('product_id',$id)->get();

        return view('admin.editproduct',compact('brands','countries','products','categories','subcategories','subcatitle','multiImgs'));

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
            'subtitle' => 'required|array|max:255',
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

            $msg = trans('Register Successfully', [ 'name' => 'Subtitle' ]);
            return redirect('/admin/category')->with('success', $msg );
        } else {


            $updval = array( 'category_id' => $request->category,
                            'sub_category_id' => $request->category,
                            'sub_category_titlename' => $request->subtitle[0],
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            DB::table('sub_category_titles')->where('id',$request->id)->update($updval);

            return redirect('/admin/category')->with('success',__('Subtitle Updated Successfully'));
        }

    }


    public function storesubcategory(Request $request)
    {

        $time = new DateTime();
        $subname_arr = $request->subname;
        if (empty($request->id)) {
            foreach ($subname_arr as $subname) {
                DB::table('sub_categories')->insert([
                    'category_id' => $request->category,
                    'sub_category_name' => $subname,
                    'sub_category_title_id' => $request->subcategory,
                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                    ]);
            }
            $msg = trans('Register Successfully', [ 'name' => $request->title ]);
            return redirect('/admin/category')->with('success', $msg );
        }
        else{
            if (!empty($request->image)) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
            } else {
                $imageName = '';
            }

            if (!empty($request->image)) {
                $updvals['category_icon'] = $imageName;
            }

            $updval = array( 'category_id' => $request->category,
                             'sub_category_name' => $request->subname ?? '',
                             'sub_category_title_id' => $request->subcategory ?? '',
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );
            if (!empty($request->image)) {
                DB::table('categories')->where('id',$request->category)->update($updvals);
            }
                DB::table('sub_categories')->where('id',$request->id)->update($updval);
                return redirect('/admin/category')->with('success',__('SubCategory Updated Successfully'));
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
                    $message->to($inquiry_email, 'Ecommerce ')->subject($request->name.'Question form');
                    $message->from($request->email,$request->name);
                    $message->setBody("We received the following inquiry from the official e-commerce website.
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                    \r\nName：　".$request->name."
                    \r\n"."Email：　".$request->email."
                    \r\n
                    \r\n"."Message：　
                    \r\n".$request->message."
                    \r\n
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                });
            }

            $adminMails = DB::table('users')->where('role', 'admin')->pluck('email')->toArray();;

            $inquiry_email = 'info-test@asia-hd.com';
            $data = array('title' => $request->title);

            if (!empty(  $adminMails)) {
                foreach ($adminMails as $email) {
                    Mail::send([], $data, function ($message) use ($request, $adminMails) {
                        $message->to($email, 'Ecommerce ')->subject($request->name.'Question form');
                        $message->from($request->email,$request->name);
                        $message->setBody("We received the following inquiry from the official e-commerce website.
                            \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                            \r\nName：　" . $request->title . "
                            \r\nEmail：　" .  $inquiry_email . "
                            \r\n
                            \r\nMessage：　
                            \r\n" . $request->message . "
                            \r\n
                            \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                    });
                }
            }

            $notification = Notification::find(6);
            $newval = array('time' => Carbon::now(),
                            'created_at' => Carbon::now(),
                            );
            $notification->update( $newval);

            return redirect('/faq#ts-form')->with('success','Your inquiry has been successfully sent');


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

                    $message->to($inquiry_email, 'Ecommerce ')->subject($request->name.'Question form');
                    $message->from($request->email,$request->name);
                    $message->setBody("We received the following inquiry from the official e-commerce website
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                    \r\nName：　".$request->name."
                    \r\n"."Email：　".$request->email."
                    \r\n
                    \r\n"."Message：　
                    \r\n".$request->message."
                    \r\n
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");

                });
            }

            $adminMails = DB::table('users')->where('role', 'admin')->pluck('email')->toArray();

            $inquiry_email = 'info-test@asia-hd.com';
            $data = array('title' => $request->title);

            if (!empty(  $adminMails)) {
                foreach ($adminMails as $email) {
                    Mail::send([], $data, function ($message) use ($request, $adminMails) {
                        $message->to($email, 'Ecommerce ')->subject($request->name.'Question form');
                        $message->from($request->email,$request->name);
                        $message->setBody("We received the following inquiry from the official e-commerce website.
                            \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                            \r\nName：　" . $request->title . "
                            \r\nEmail：　" .  $inquiry_email . "
                            \r\n
                            \r\nMessage：　
                            \r\n" . $request->message . "
                            \r\n
                            \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                    });
                }
            }

            $notification = Notification::find(8);
            $newval = array('time' => Carbon::now(),
                            'created_at' => Carbon::now(),
                            );
            $notification->update( $newval);
            return redirect('/contact#contact-form')->with('success','Your inquiry has been successfully sent');

        }
        else if( $request->from == 'privacy')
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

                    $message->to($inquiry_email, 'Ecommerce ')->subject($request->name.'Question form');
                    $message->from($request->email,$request->name);
                    $message->setBody("We received the following inquiry from the official e-commerce website
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                    \r\nName：　".$request->name."
                    \r\n"."Email：　：　".$request->email."
                    \r\n
                    \r\n"."Message：　
                    \r\n".$request->message."
                    \r\n
                    \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");

                });
            }

            $adminMails = DB::table('users')->where('role', 'admin')->pluck('email')->toArray();

            $inquiry_email = 'info-test@asia-hd.com';
            $data = array('title' => $request->title);

            if (!empty(  $adminMails)) {
                foreach ($adminMails as $email) {
                    Mail::send([], $data, function ($message) use ($request, $adminMails) {
                        $message->to($email, 'Ecommerce ')->subject($request->name.'Question form');
                        $message->from($request->email,$request->name);
                        $message->setBody("We received the following inquiry from the official e-commerce website.
                            \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                            \r\nName：　" . $request->title . "
                            \r\nEmail：　" .  $inquiry_email . "
                            \r\n
                            \r\nMessage：　
                            \r\n" . $request->message . "
                            \r\n
                            \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                    });
                }
            }

            $notification = Notification::find(7);
            $newval = array('time' => Carbon::now(),
                            'created_at' => Carbon::now(),
                            );
            $notification->update( $newval);

            return redirect('/privacy-policy#privacy-form')->with('success','Your inquiry has been successfully sent');

        }
    }

    public function notice(Request $request)
    {
        $sellername = DB::table('users')->select('name')->where('id',$request->selleremail)->first();
        $inquiry_email = DB::table('users')->select('email')->where('id',$request->selleremail)->first();
        $shopName = Seller::where('user_id', $request->selleremail)->value('shop_name');

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $inquiry_emails =  $inquiry_email ->email;
        $help = new Help();
        $help->name =$sellername->name;
        $help->shop_name =  $shopName;
        $help->help_id = $request->selleremail;
        $help->to = $inquiry_email->email;
        $help->from = 'info-test@asia-hd.com';
        $help->subject = $request->title;
        $help->body =  $request->message;
        $help->img = $imageName;
        $help->created_at = Carbon::now();
        $help->save();
        $data = array('title' => $request->title);
        if (!empty($request->selleremail)) {
            $mail = Mail::send([], $data, function($message) use ($request,$inquiry_emails ) {
                $message->to($inquiry_emails, 'Ecommerce ')->subject($request->name.'からの質問');
                $message->from('info-test@asia-hd.com','admin');
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
        $notification = SellerNotification::find(2);
        $newval = array('time' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        );
        $notification->update( $newval);

        return redirect('/admin/indexhelp')->with('success','Sending Email successfully');
    }

    // if (!empty($sellerEmails)) {
    //     $user = Auth::user();

    //     // Validate the incoming request data
    //     $validator = Validator::make($request->all(), [
    //         'subject' => 'required|string|max:255',
    //         'body' => 'required|string',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     foreach ($sellerEmails as $email) {
    //         $help = new Help();
    //         $help->name = $user->name;
    //         $help->to = $email;
    //         $help->from = 'info-test@asia-hd.com';
    //         $help->subject = $request->title;
    //         $help->body =  $request->message;
    //         $help->created_at = Carbon::now();


    //         $help->save();
    //     }

        // $inquiry_email = 'info-test@asia-hd.com';
        // $email = Auth::user()->email;
        // $name = Auth::user()->name;
        // $mail = Mail::send('seller.help.helpEmail', ['name' => $name, 'email' => $email, 'title' => $request->title, 'reason' => $request->reason], function($message) use ($name, $inquiry_email) {
        //     $message->to($inquiry_email, 'Ecommerce')->subject($name.'からの質問');
        //     $message->from(Auth::user()->email, Auth::user()->name);
        // });

        // $msg = ('Data sent successfully');
        // return redirect('/help')->with('success', $msg);
        // if ($request->from == 'notice') {

        //     $sellerEmails = DB::table('users')->where('role', 'seller')->pluck('email')->Array();

        //     $inquiry_email = 'info-test@asia-hd.com';
        //     $data = array('title' => $request->title);

        //     if (!empty(  $sellerEmails)) {
        //         foreach ($sellerEmails as $email) {
        //             Mail::send([], $data, function ($message) use ($request, $email, $inquiry_email) {
        //                 $message->to($email)->subject($request->title . 'からの質問');
        //                 $message->from($inquiry_email, $request->title);
        //                 $message->setBody("We received the following notice message from the official e-commerce website.
        //                     \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
        //                     \r\nName：　" . $request->title . "
        //                     \r\nEmail：　" .  $inquiry_email . "
        //                     \r\n
        //                     \r\nMessage：　
        //                     \r\n" . $request->message . "
        //                     \r\n
        //                     \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
        //             });
        //         }
        //     }

        //     return redirect('/admin/addhelp#notice')->with('success', 'お問い合わせ内容が正常に送信されました。');

        // }
    //       $msg = ('Data sent successfully');
    //     return redirect('/admin/indexhelp')->with('success', $msg);
    // }


    public function noticeall(Request $request)
    {

        $sellers = DB::table('users')
        ->where('role', 'seller')
        ->select('name', 'email','id')
        ->get();

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        // Create Help records for each seller
        foreach ($sellers as $seller) {
        $help = new Help();
        $help->name = $seller->name;
        $help->to = $seller->email;
        $help->noshow = 1;
        $help->help_id =  $seller->id;
        $help->from = 'info-test@asia-hd.com';
        $help->subject = $request->title;
        $help->body = $request->message;
        $help->img =  $imageName;
        $help->created_at = Carbon::now();
        $help->save();
        }
        $help = new Help();
        $help->name = 'all';
        $help->to = 'all';
        $help->noshow = 1;
        $help->from = 'info-test@asia-hd.com';
        $help->subject = $request->title;
        $help->body = $request->message;
        $help->img =  $imageName;
        $help->created_at = Carbon::now();
        $help->save();

        return redirect('/admin/indexhelp')->with('success', 'Sending Email successfully');

    }

   public function storetop(Request $request)
   {
      if (!empty($request->image)) {
          $imageName = time().'.'.$request->image->extension();
          $request->image->move(public_path('images'), $imageName);
      } else {
          $imageName = '';
      }

      $time = new DateTime();

          $updval = array('phaseone' => $request->phaseone,
                            'phasetwo' => $request->phasetwo,
                            'phasethree' => $request->phasethree,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                          );

          if (!empty($request->image)) {
              $updval['image'] = $imageName;
          }

          DB::table('tops')->where('id',$request->id)->update($updval);

          return redirect('/admin/top')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

      }

      public function storecustomer(Request $request)
      {
         if (!empty($request->image)) {
             $imageName = time().'.'.$request->image->extension();
             $request->image->move(public_path('images'), $imageName);
         } else {
             $imageName = '';
         }

         $time = new DateTime();

             $updval = array('title' => $request->title,
                               'subtitle' => $request->subtitle,
                               'content' => $request->content,
                               'name' => $request->name,
                               'position' => $request->position,
                               'updated_at' => $time->format('Y-m-d H:i:s')
                             );

             if (!empty($request->image)) {
                 $updval['image'] = $imageName;
             }

             DB::table('customers')->where('id',$request->id)->update($updval);

             return redirect('/admin/indexcustomer')->with('success','「'.$request->title.'」'.__('auth.doneedit'));

         }



    public function storecoupon(Request $request)
    {

        $existingCoupon = DB::table('coupons')
        ->where('coupon_code', $request->code)
        ->exists();

        if ($existingCoupon && empty($request->id)) {

            $request->validate([
                'code' => 'required|string|max:255|unique:coupons,coupon_code',
                ], [
                'code.required' => 'Code is required.',
                'code.unique' => 'Coupon code "'.$request->code.'" already exists. Please choose a different one.',
                ]);
        }

        if (empty($request->id)) {
        $request->validate(['title' => 'required|string|max:255',
        'code' => 'required|string|max:255',
        'disamount' => 'required|numeric|max:9999999999.999999',
        'miniamount' => 'required|numeric|max:9999999999.999999',
        'validcount' => 'required|numeric|max:9999999999.999999',
        'startdate' => 'required|date',
        'enddate' => 'required|date',
        ],
            [
                'code.required' => 'code is required',
                'disamount.required' => 'disamount is required',
                'miniamount.required' => 'miniamount is required',
                'validcount.required' => 'validcount is required',
                'validdate.required' => 'validdate is required',
                ]);
            }

        $time = new DateTime();

        if ($existingCoupon == false && empty($request->id)) {

                DB::table('coupons')->insert([
                    'name' => $request->title,
                    'coupon_code' => $request->code,
                    'discount_amount' => $request->disamount,
                    'mini_amount' => $request->miniamount,
                    'valid_count' => $request->validcount,
                    'startdate' => $request->startdate,
                    'enddate' => $request->enddate,
                    'status' => '1',
                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')

                ]);

                $msg = trans('Coupon Register Successfully', [ 'name' => $request->title ]);
                return redirect('/admin/coupon')->with('success', $msg );
            } else {

                $updval = array('name' => $request->title,
                                'coupon_code' => $request->code,
                                'discount_amount' => $request->disamount,
                                'mini_amount' => $request->miniamount,
                                'valid_count' => $request->validcount,
                                'startdate' => $request->startdate,
                                'enddate' => $request->enddate,
                                'updated_at' => $time->format('Y-m-d H:i:s')
                                );

                DB::table('coupons')->where('id',$request->id)->update($updval);

                return redirect('/admin/coupon')->with('success','「'.$request->title.'」'.__('Updated Successfully'));

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

            // $commisonPrice = $request->commision;
            // $commisonAmount = ($discountedPrice * $commisonPrice) / 100;
            // $sellerAmount = $discountedPrice - $commisonAmount;
            // $adminAmount = $discountedPrice -  $sellerAmount;

            $product = Product::find($request->id);
            $old_img = $request->old_img;
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'sub_category_title_id' => 'present|exists:sub_category_titles,id',
                'sub_category_id' => 'present|exists:sub_categories,id',
                'product_name' => 'required|string|max:255',
                'product_qty' => 'required|numeric',
                'product_tags' => 'required|string|max:255',
                'product_size' => 'required|string|max:255',
                'product_color' => 'required|string|max:255',
                'original_price' => 'required|numeric',
                'short_desc' => 'required|string|max:255',
                'long_desc' => 'required|string|max:255',
                'estimate_date' => 'required|string|max:255',
            ]);

            if($request->hasFile('product_thambnail')) {
                if(File::exists($old_img)) {
                    File::delete($old_img);
                }
                $img = $request->file('product_thambnail');
                $filename = time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('upload/product_thambnail'), $filename);
            } else {
                $filename = $old_img;
            }
            $product->brand_id = $request->brand_id;
            $product->country_id = $request->country_id;
            $product->category_id= $request->category_id;
            $product->sub_category_id= $request->sub_category_id;
            $product->sub_category_title_id= $request->sub_category_title_id;
            $product->product_name= $request->product_name;
            $product->product_qty= $request->product_qty;
            $product->in_stock= $request->product_qty;
            $product->product_tags= $request->product_tags;
            $product->product_size= $request->product_size;
            $product->product_color= $request->product_color;
            $product->original_price= $request->original_price;
            $product->discount_percent= $request->discount_percent ?? 0;
            $product->selling_price = $request->calculated_selling_price;
            $product->short_desc= $request->short_desc;
            $product->long_desc= $request->long_desc;
            $product->care_instructions= $request->care_instructions;
            $product->product_thambnail= $filename;
            $product->estimate_date= $request->estimate_date;
            $product->status= 1;
            $product->delivery_price= $request->delivery_price;
            // $product->commission = $request->commision;
            // $product->commission_status = 1;
            $product->updated_by = Auth::user()->id;
            $product->updated_at= Carbon::now();
            $product->update();
            return redirect('/admin/product')->with('success','「'.$request->title.'」'.__('auth.doneedit'));
    }


    public function storecategory(Request $request)
     {

        $valarr = array('title' => 'required|string|max:255',);

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

            $msg = trans('Register Successfully', [ 'name' => $request->title ]);
            return redirect('/admin/category')->with('success', $msg );
        } else {

            $updval = array('category_name' => $request->title,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['category_icon'] = $imageName;
            }

            DB::table('categories')->where('id',$request->id)->update($updval);

            return redirect('/admin/category')->with('success','「'.$request->title.'」'.__('Updated Successfully.'));

        }
    }

    public function getSubcategories(Request $request) {

        $subcategories =   DB::table('sub_category_titles')->where('category_id','=',$request->category)->get();
        return response()->json([
            'status' => 'success',
            'subcategories' => $subcategories,
        ]);

    }

    public function indexorderlist()
    {
        // $validated = request()->validate([
        //     'mainSearch' => 'string|nullable',
        // ]);
        // $mainSearch = $validated['mainSearch'] ?? null;
        // $query = Order::query();
        // if ($mainSearch != null) {
        //     $query->where(function ($query) use ($mainSearch) {
        //         $query->where('order_id', 'like', '%' . $mainSearch . '%')
        //               ->where('total_amount', 'like', '%' . $mainSearch . '%')
        //               ->where('confirmed_date', 'like', '%' . $mainSearch . '%');
        //     });
        // }
        $limit = 10;

        $order = OrderDetail::latest()->paginate($limit);
        $ttl = $order->total();
        $ttlpage = ceil($ttl / $limit);

        return view('admin.order.indexorderlist', compact('order', 'ttl', 'ttlpage'));

    }

    public function admindashboard()
    {
        $currentDate = Carbon::now();
        $limit=10;
        $id = Auth::user()->created_by ?? Auth::id();
        $revenue = OrderDetail::where('status', 'Delivered')
                        ->whereMonth('created_at', $currentDate->month)
                        ->whereYear('created_at', $currentDate->year)
                        ->sum('amount');

        $orderCount = OrderDetail::count();
        $pending = OrderDetail::where('status', 'Pending')->count();
        $currentDate = Carbon::now()->format('Y-m-d');
        $product = Product::whereDate('created_at','<=',$currentDate)->count();
        $transfers = OrderDetail::latest()->paginate($limit);
        $orders = OrderDetail::selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name, MONTH(created_at) as month_number")
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("DATE_FORMAT(created_at, '%M')"))
                        ->orderBy(DB::raw("MONTH(created_at)"))
                        ->get();


        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data = array_fill(0, 12, 0);

        foreach ($orders as $order) {
            $monthIndex = $order->month_number - 1;
            $data[$monthIndex] = $order->count;
        }


       // $currentMonthEnd =  Carbon::now()->endOfMonth()->format('y/m/d');

        $transfer = Seller::leftjoin('order_details', 'order_details.seller_id', '=', 'sellers.user_id') // Join on sellers.id instead of sellers.user_id
                            ->select(
                                'sellers.id',
                                'sellers.shop_name',
                                'sellers.commission',
                                DB::raw('FLOOR((SUM(order_details.amount) + SUM(CASE WHEN order_details.used_delivery_price = 1 THEN order_details.delivery_price ELSE 0 END)) * (1 - sellers.commission/100)) as seller_amount'))
                            ->where('sellers.commission', '!=', 0)
                            ->orderBy('sellers.created_at', 'desc')
                            ->groupBy( 'sellers.id', 'sellers.shop_name', 'sellers.commission')
                            ->paginate($limit);

        foreach ($transfer as $record) {
            $datePrefix = date('ym');
            $sequentialNumber = 1;
            // Generate the new product code
            $newProductCode = $datePrefix . str_pad($sequentialNumber, 5, '0', STR_PAD_LEFT) . $record->id;

            // Check if a record with the same transfer code already exists
            $existingTransfer = Transfer::where('transfer_code', $newProductCode)->first();
            $currentMonthStart = Carbon::now()->startOfMonth()->format('y/m/d');
            $currentMonthEnd = Carbon::now()->startOfMonth()->addDays(15)->subDay()->format('y/m/d');

            // If no matching record is found, create a new one
            if (!$existingTransfer) {
                Transfer::create([
                    'seller_id' => $record->id,
                    'shop_name' => $record->shop_name,
                    'commission' => $record->commission,
                    'seller_amount' => $record->seller_amount,
                    'transfer_code' => $newProductCode,
                    'start_date' => $currentMonthStart,
                    'end_date' => $currentMonthEnd,
                    'status' => 0,
                ]);
            }

            // Increment the sequential number for the next iteration
            $sequentialNumber++;
        }
        $transfer_history = Transfer::latest()->where('status', 0)->paginate($limit);
        $ttl = $transfer_history->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.index',compact('labels', 'data','transfer_history','revenue','orderCount','pending','product','ttl','ttlpage'));
    }

    public function indexhelp()
    {
        $limit = 10;

        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Help::query();


        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('title', 'like', '%' . $mainSearch . '%');
            });
        }

        $email = 'info-test@asia-hd.com';
        $received = Help::where('to',$email)->latest()->paginate(10);

        $sent = Help::where('from', $email)->where('name', 'all')->latest()->paginate(10);

        $notice = Help::where('from', $email)->where('to', 'all')->latest()->paginate(10);
        $ttl = $received->total();
        $ttlpage = (ceil($ttl / $limit));

        $sent_ttl = $sent->total();
        $sent_ttlpage = (ceil($sent_ttl / $limit));

        $notice_ttl = $sent->total();
        $notice_ttlpage = (ceil($notice_ttl / $limit));

        return view('admin.indexhelp',compact('received','sent','notice','ttl','ttlpage','sent_ttl','sent_ttlpage','notice_ttl','notice_ttlpage'));

    }

    public function addToSpecial(Request $request)
    {
        $validated = request()->validate([
            'productId' => 'integer|min:1',
            'sub_category_title_id' => 'integer|required|min:1',
            'sub_category_id' => 'integer|required|min:1',
        ]);
        $limit = 10;
        $product = Product::find($request->productId);
        if($product)
        {
            $product->special_sub_category_id = $request->sub_category_id;
            $product->save();
        }

        $lists = Product::orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $subCatTitle = SubCategoryTitle::whereHas('category', function($query) {
            $query->where('category_name', 'Special Corner');
        })->get();

        // $hcompanies = array();
        // print_r($lists);die;

        // return view('admin.product.product_all',compact('lists','ttlpage','ttl', 'subCatTitle'));
        return redirect()->route('admin.all.product',compact('lists','ttlpage','ttl', 'subCatTitle'));
    }

    public function removeFromSpecial($id)
    {
        $limit = 10;
        $product = Product::find($id);
        if($product)
        {
            $product->special_sub_category_id = NULL;
            $product->save();
        }

        $lists = Product::orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $subCatTitle = SubCategoryTitle::whereHas('category', function($query) {
            $query->where('category_name', 'Special Corner');
        })->get();

        // $hcompanies = array();
        // print_r($lists);die;

        // return view('admin.product.product_all',compact('lists','ttlpage','ttl', 'subCatTitle'));
        return redirect()->route('admin.all.product',compact('lists','ttlpage','ttl', 'subCatTitle'));
    }

    // remove coupon from product
    public function removeCoupon(Request $request)
    {
        $product = Product::find($request->id);
        $seller = Seller::where('user_id', $product->seller_id)->first();
        if ($seller->coupon_status == 1)
        {
            $product->update([
                'coupon_id' => $seller->coupon_id,
                'coupon_status' => 0,
            ]);
        }
        else
        {
            $product->update([
                'coupon_id' => null,
                'coupon_status' => 0,
            ]);
        }

        return redirect('/admin/product');
    }

    // remove coupon from shop
    public function removeFromShop($id)
    {
        $seller = Seller::find($id);

        if ($seller) {
            // Update the seller's coupon information
            $seller->coupon_id = null;
            $seller->coupon_status = 0;
            $seller->save();

            // Fetch all products of the seller
            $products = Product::where('seller_id', $seller->user_id)->where('coupon_status', 0)->get();

            // Update coupon information for each product
            foreach ($products as $product) {
                $product->update(['coupon_id' => null]);
            }
        }

        return redirect('/admin/shoplist');
    }


    public function indexspecialsubcategoryproduct($id)
    {
        $limit = 12;
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
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
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

        $shoplist = $query->where('special_sub_category_id',$id)
                          ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                                    ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                                    ->where('products.status', '=', '1')
                                    ->where('products.special_sub_category_id', $id)
                                    ->groupBy('categories.id')
                                    ->get();

        $ratingWithProductCount = Review::select(
                                        DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
                                    )
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.special_sub_category_id', $id)
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
                                    ->where('special_sub_category_id', $id)
                                    ->where('status', '=', '1')
                                    ->first();

        return view('front-end.sub-category-left-sidebar',compact('id','shoplist','ttlpage','ttl', 'price', 'search', 'rating', 'ratingWithProductCount', 'discount',
        'discount','discountWithProductCount', 'sort', 'reviews', 'categories', 'categoryWithProductCount'));
    }

    public function shopTransferDetail($id)
    {
        return view('admin.shoptransfer');
    }

    public function indextransferorderdetail($id)
    {
        $limit = 10;
        $transfer = Transfer::find($id);
        $lists = OrderDetail::with('order')->with('buyer')->with('product')
                ->where('seller_id', $transfer->seller_id)
                ->whereBetween('created_at', [$transfer->start_date, $transfer->end_date])
                ->paginate($limit);
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.transfer_order_detail',compact('lists','ttlpage','ttl'));
}
}

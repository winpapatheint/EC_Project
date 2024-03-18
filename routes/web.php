<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('front-end.welcome');
});

Route::get('/user/registration', function () {return view('front-end.user-register');})->name('front-end.user-register');
Route::get('/user', function () {return view('front-end.user-dashboard');})->name('front-end.user-dashboard');
Route::get('/user/orders', function () {return view('front-end.user-order');})->name('front-end.user-order');
Route::get('/user/delivery', function () {return view('front-end.user-delivery-status');})->name('front-end.user-delivery');
Route::get('/user/address', function () {return view('front-end.user-address');})->name('front-end.user-address');
Route::get('/user/payment', function () {return view('front-end.user-payment-method');})->name('front-end.user-payment');
Route::get('/user/profile', function () {return view('front-end.user-profile');})->name('front-end.user-profile');
Route::get('/user/order/details', function () {return view('front-end.user-order-details');})->name('front-end.user-order-details');
Route::get('/user/order/tracking', function () {return view('front-end.user-order-tracking');})->name('front-end.user-order-tracking');

route::post('/adduser',[UserController::class,"adduser"]);

Route::get('/register', function () {return view('front-end.register');});
Route::get('/login', function () {return view('front-end.login');})->name('front-end.login');

Route::get('/products', function () {return view('front-end.products');});
Route::get('/product-left-thumbnail', function () {return view('front-end.product-left-thumbnail');});

Route::get('/wishlist', function () {return view('front-end.wishlist');});

Route::get('/compare', function () {return view('front-end.compare');});

Route::get('/product-circle', function () {return view('front-end.product-circle');});

Route::get('/seller-grid', function () {return view('front-end.seller-grid');});

Route::get('/shop-left-sidebar', function () {return view('front-end.shop-left-sidebar');});

Route::get('/blog-detail', function () {return view('front-end.blog-detail');});

Route::get('/blog-list', function () {return view('front-end.blog-list');});

Route::get('/contact-us', function () {return view('front-end.contact-us');});

Route::get('/faq', function () {return view('front-end.faq');});

Route::get('/cart', function () {return view('front-end.cart');});

Route::get('/checkout', function () {return view('front-end.checkout');});

//Admin
Route::get('/admin', function () {return view('admin.admin');})->name('admin.dashboard');
Route::get('/admin/transferdetail', function () {return view('admin.transferdetail');})->name('admin.transferdetail');
Route::get('/admin/category', function () {return view('back-end.category');});
Route::get('/admin/addcategory', function () {return view('back-end.addcategory');});
Route::get('/admin/users', function () {return view('back-end.users');});

Route::get('/subadmin', function () {return view('admin.subadmin');})->name('admin.subadmin');

Route::get('/subcategory', function () {return view('back-end.subcategory');});

Route::get('/admin/profile', function () {return view('admin.profile');})->name('admin.profile');
Route::get('/admin/review/product', function () {return view('admin.product.product_review');})->name('admin.product.review');
//AdminProduct
Route::get('/admin/all/product', function () {return view('admin.product.product_all');})->name('admin.all.product');

//startuser
Route::get('/admin/all/users', function () {return view('admin.users');})->name('admin.all.users');
Route::get('/admin/all/usersdetail', function () {return view('admin.usersdetail');})->name('admin.usersdetail');
Route::get('/admin/all/subuserdetail', function () {return view('admin.subuserdetail');})->name('admin.subuserdetail');
Route::get('/admin/all/addsubadmin', function () {return view('admin.addsubadmin');})->name('admin.addsubadmin');
Route::get('/admin/all/edituser', function () {return view('admin.edituser');})->name('admin.edituser');
Route::get('/admin/all/editsubuser', function () {return view('admin.editsubuser');})->name('admin.editsubuser');

//enduser

//startblog
Route::get('/admin/all/blog', function () {return view('admin.blog.blog');})->name('admin.all.blog');
Route::get('/admin/add/blog', function () {return view('admin.blog.addblog');})->name('admin.add.blog');
Route::get('/admin/detail/blog', function () {return view('admin.blog.blog_detail');})->name('admin.detail.blog');
Route::get('/admin/edit/blog', function () {return view('admin.blog.blog_edit');})->name('admin.edit.blog');
//endblog


//starthelp

Route::get('/admin/indexhelp', function () {return view('admin.indexhelp');})->name('admin.indexhelp');
Route::get('/admin/addhelp', function () {return view('admin.addhelp');})->name('admin.addhelp');

//endhelp

//startbrand
Route::get('/admin/all/brand', function () {return view('admin.brand');})->name('admin.all.brand');
Route::get('/admin/add/brand', function () {return view('admin.addbrand');})->name('admin.add.brand');
Route::get('/admin/edit/brand', function () {return view('admin.brand_edit');})->name('admin.edit.brand');
//endbrand

//startcategory
Route::get('/admin/all/category', function () {return view('admin.category');})->name('admin.all.category');
Route::get('/admin/all/subcategory', function () {return view('admin.allsubcategory');})->name('admin.all.subcategory');
Route::get('/admin/all/subtitle', function () {return view('admin.allsubtitle');})->name('admin.all.subtitle');
Route::get('/admin/all/addsubtitle', function () {return view('admin.addsubtitle');})->name('admin.all.addsubtitle');
Route::get('/admin/all/addcategory', function () {return view('admin.addcategory');})->name('admin.all.addcategory');
Route::get('/admin/all/addsubcategory', function () {return view('admin.addsubcategory');})->name('admin.all.addsubcategory');
Route::get('/admin/edit/editsubtitle', function () {return view('admin.editsubtitle');})->name('admin.edit.editsubtitle');
Route::get('/admin/edit/category', function () {return view('admin.editcategory');})->name('admin.edit.category');
Route::get('/admin/edit/subcategory', function () {return view('admin.editsubcategory');})->name('admin.edit.subcategory');
//endcategory


Route::get('/admin/detail/product', function () {return view('admin.product.product_detail');})->name('admin.detail.product');
Route::get('/admin/edit/product', function () {return view('admin.product.product_edit');})->name('admin.edit.product');

//SellerOrder
Route::get('/admin/all/order', function () {return view('admin.order.order_all');})->name('admin.all.order');
Route::get('/admin/detail/order', function () {return view('admin.order.order_detail');})->name('admin.detail.order');
Route::get('/admin/tracking/order', function () {return view('admin.order.order_tracking');})->name('admin.order-tracking');


//Seller
Route::get('/seller/register', function () {return view('seller.seller_register');})->name('seller.register');
Route::get('/seller', function () {return view('seller.index');})->name('seller.dashboard');
Route::get('/seller/profile', function () {return view('seller.profile');})->name('seller.profile');
Route::get('/seller/review/product', function () {return view('seller.product.product_review');})->name('seller.product.review');
Route::get('/seller/help', function () {return view('seller.help.help');})->name('seller.help');
Route::get('/seller/add/help', function () {return view('seller.help.help_add');})->name('seller.help.add');

//SellerProduct
Route::get('/seller/all/product', function () {return view('seller.product.product_all');})->name('seller.all.product');
Route::get('/seller/add/product', function () {return view('seller.product.product_add');})->name('seller.add.product');
Route::get('/seller/detail/product', function () {return view('seller.product.product_detail');})->name('seller.detail.product');
Route::get('/seller/edit/product', function () {return view('seller.product.product_edit');})->name('seller.edit.product');

//SellerOrder
Route::get('/seller/all/order', function () {return view('seller.order.order_all');})->name('seller.all.order');
Route::get('/seller/detail/order', function () {return view('seller.order.order_detail');})->name('seller.detail.order');
Route::get('/seller/tracking/order', function () {return view('seller.order.order_tracking');})->name('seller.order-tracking');

//SellerSubSeller
Route::get('/seller/all/subseller', function () {return view('seller.subseller.subseller_all');})->name('seller.all.subseller');
Route::get('/seller/add/subseller', function () {return view('seller.subseller.subseller_add');})->name('seller.add.subseller');
Route::get('/seller/edit/subseller', function () {return view('seller.subseller.subseller_edit');})->name('seller.edit.subseller');


//Subseller
Route::get('/subseller', function () {return view('sub_seller.index');})->name('sub_seller.dashboard');
Route::get('/subseller/profile', function () {return view('sub_seller.profile');})->name('sub_seller.profile');
Route::get('/subseller/help', function () {return view('sub_seller.help.help');})->name('sub_seller.help');
Route::get('/subseller/add/help', function () {return view('sub_seller.help.help_add');})->name('sub_seller.help.add');

//SubsellerProduct
Route::get('/subseller/all/product', function () {return view('sub_seller.product.product_all');})->name('sub_seller.all.product');
Route::get('/subseller/add/product', function () {return view('sub_seller.product.product_add');})->name('sub_seller.add.product');
Route::get('/subseller/detail/product', function () {return view('sub_seller.product.product_detail');})->name('sub_seller.detail.product');
Route::get('/subseller/edit/product', function () {return view('sub_seller.product.product_edit');})->name('sub_seller.edit.product');

//SubsellerOrder
Route::get('/subseller/all/order', function () {return view('sub_seller.order.order_all');})->name('sub_seller.all.order');
Route::get('/subseller/detail/order', function () {return view('sub_seller.order.order_detail');})->name('sub_seller.detail.order');
Route::get('/subseller/tracking/order', function () {return view('sub_seller.order.order_tracking');})->name('sub_seller.order-tracking');
Route::get('/subseller/review/product', function () {return view('sub_seller.product.product_review');})->name('sub_seller.product.review');

require __DIR__.'/auth.php';



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
<<<<<<< HEAD
=======

>>>>>>> 0dea4ba53485ce8a382864516d725d65e9f9e0e0

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

<<<<<<< HEAD
Route::get('/user-registration', function () {return view('front-end.user-register');})->name('front-end.user-register');
Route::get('/user', function () {return view('front-end.user-dashboard');})->name('front-end.user-dashboard');
Route::get('/user-orders', function () {return view('front-end.user-order');})->name('front-end.user-order');
Route::get('/user-delivery', function () {return view('front-end.user-delivery-status');})->name('front-end.user-delivery');

Route::get('/user-address', [UserController::class, 'showAddress'])->name('showAddress');
route::post('/adduser',[UserController::class,'store'])->name('adduser');
Route::post('/update-user-info', [UserController::class, 'updateUserInfo'])->name('updateUserInfo');
Route::delete('/remove-address/{id}', [UserController::class, 'removeAddress'])->name('user-removeAddress');
Route::post('/update-address', [UserController::class, 'updateAddress'])->name('updateAddress');

Route::get('/user/payment', function () {return view('front-end.user-payment-method');})->name('front-end.user-payment');
Route::get('/user-profile', function () {return view('front-end.user-profile');})->name('front-end.user-profile');
Route::get('/user-order_details', function () {return view('front-end.user-order-details');})->name('front-end.user-order-details');
Route::get('/user-order_tracking', function () {return view('front-end.user-order-tracking');})->name('front-end.user-order-tracking');

=======
//user
Route::get('/user-registration', function () {return view('front-end.user-register');})->name('front-end.user-register');
Route::get('/user', function () {return view('front-end.user-dashboard');})->name('front-end.user-dashboard');
Route::get('user-orders', function () {return view('front-end.user-order');})->name('front-end.user-order');
Route::get('/user-delivery', function () {return view('front-end.user-delivery-status');})->name('front-end.user-delivery');

Route::get('/user-address', [UserController::class, 'showAddress'])->name('showAddress');
route::post('/adduser',[UserController::class,'store'])->name('adduser');
Route::post('/update-user-info', [UserController::class, 'updateUserInfo'])->name('updateUserInfo');
Route::delete('/remove-address/{id}', [UserController::class, 'removeAddress'])->name('user-removeAddress');
Route::post('/edit-address', [UserController::class, 'updateAddress'])->name('updateAddress');

Route::get('/user/payment', function () {return view('front-end.user-payment-method');})->name('front-end.user-payment');
Route::get('/user-profile', function () {return view('front-end.user-profile');})->name('front-end.user-profile');
Route::get('/user-order_details', function () {return view('front-end.user-order-details');})->name('front-end.user-order-details');
Route::get('/user-order_tracking', function () {return view('front-end.user-order-tracking');})->name('front-end.user-order-tracking');
>>>>>>> 0dea4ba53485ce8a382864516d725d65e9f9e0e0

//Route::get('/register', function () {return view('front-end.register');});

Route::get('/register', function () {return view('front-end.register');});



Route::get('/products', function () {return view('front-end.products');});
Route::get('/product-left-thumbnail', function () {return view('front-end.product-left-thumbnail');});

Route::get('/wishlist', function () {return view('front-end.wishlist');});

Route::get('/compare', function () {return view('front-end.compare');});

Route::get('/product-circle', function () {return view('front-end.product-circle');});

Route::get('/seller-grid', function () {return view('front-end.seller-grid');});

Route::get('/shop-left-sidebar', function () {return view('front-end.shop-left-sidebar');});

Route::get('/blog-detail', function () {return view('front-end.blog-detail');});

Route::get('/news', function () {return view('front-end.blog-list');});

Route::get('/contact-us', function () {return view('front-end.contact-us');});

Route::get('/faq', function () {return view('front-end.faq');});

Route::get('/cart', function () {return view('front-end.cart');});

Route::get('/checkout', function () {return view('front-end.checkout');});

//Admin
Route::get('/admin', function () {return view('admin.admin');})->name('admin.dashboard');
Route::get('/admin/transferdetail', function () {return view('admin.transferdetail');})->name('admin.transferdetail');
Route::get('/admin/category', [AdminController::class, 'indexcategory'])->middleware(['auth', 'verified','role:admin']);

Route::get('/admin/addcategory', function () {return view('back-end.addcategory');});

Route::post('admin/registercategory', [AdminController::class, 'storecategory'])->name('registercategory');
Route::post('admin/registersubtitle', [AdminController::class, 'storesubtitle'])->name('registersubtitle');
Route::post('admin/registersubcategory', [AdminController::class, 'storesubcategory'])->name('registersubcategory');

Route::get('/admin/users', function () {return view('back-end.users');});

Route::get('admin/subadmin', [AdminController::class, 'indexsubadmin'])->middleware(['auth','role:admin']);
Route::get('/admin/registersubadmin', function () {return view('admin.edituser');});
Route::post('admin/registersubadmin', [AdminController::class, 'registersubadmin'])->name('registersubadmin');
Route::get('/subcategory', function () {return view('back-end.subcategory');});

Route::get('/admin/profile', function () {return view('admin.profile');})->name('admin.profile');
Route::get('/admin/review/product', function () {return view('admin.product.product_review');})->name('admin.product.review');
//AdminProduct
Route::get('/admin/all/product', function () {return view('admin.product.product_all');})->name('admin.all.product');

//startuser

Route::get('/admin/all/users', [Admincontroller::class, 'indexuser'])->name('admin.all.users');
Route::get('/takeremote/{id}', [AdminController::class, 'takeremote'])->middleware(['auth','role:admin']);
Route::get('userdetail/{userid}', [AdminController::class, 'userdetail']);
Route::get('/edit/{role}/{id}', [AdminController::class, 'editdata'])->middleware(['auth']);
Route::post('edituser', [AdminController::class, 'updateuser'])->name('edituser');
Route::get('/admin/all/subuserdetail', function () {return view('admin.subuserdetail');})->name('admin.subuserdetail');
Route::get('/admin/all/addsubadmin', function () {return view('admin.addsubadmin');})->name('admin.addsubadmin');
Route::get('/admin/all/edituser', function () {return view('admin.edituser');})->name('admin.edituser');
Route::get('/admin/all/editsubuser', function () {return view('admin.editsubuser');})->name('admin.editsubuser');
route::post('/admin/deleteuser',[AdminController::class,'deleteuser'])->name('deleteuser');

//enduser

//startblog
Route::get('/admin/all/blog', [AdminController::class,'indexblog'])->name('admin.all.blog');
Route::get('/admin/add/blog', function () {return view('admin.blog.addblog');})->name('admin.addblog');
route::post('/admin/all/deleteblog',[AdminController::class,'deleteblog'])->name('deleteblog');
Route::post('admin/registerblog', [AdminController::class, 'storeblog'])->name('registerblog');
Route::get('blog/{blogid}', [AdminController::class, 'blogdetail']);
Route::get('/editblog/{blogid}', [AdminController::class, 'editblog']);

//endblog


//starthelp

Route::get('/admin/indexhelp', function () {return view('admin.indexhelp');})->name('admin.indexhelp');
Route::get('/admin/addhelp', function () {return view('admin.addhelp');})->name('admin.addhelp');

//endhelp

//startcategory
route::get('/admin/all/category',[AdminController::class,'indexcategory'])->name('admin.all.category');
route::post('/admin/all/deletecategory',[AdminController::class,'deletecategory'])->name('deletecategory');
Route::get('/admin/all/subtitle', [AdminController::class,'indexsubtitle'])->name('admin.all.subtitle');
Route::get('/editcategory/{categoryid}', [AdminController::class, 'editcategory']);
Route::get('/editsubtitle/{categoryid}', [AdminController::class, 'editsubtitle']);
Route::get('/editsubcategory/{categoryid}', [AdminController::class, 'editsubcategory']);

Route::get('/admin/all/subcategory', [AdminController::class,'indexsubcategory'])->name('admin.all.subcategory');

Route::get('/admin/all/addsubtitle',[AdminController::class,'addsubtitle'])->name('admin.all.addsubtitle');
Route::get('/admin/all/addcategory', function () {return view('admin.addcategory');})->name('admin.all.addcategory');
Route::get('/admin/all/addsubcategory', [AdminController::class,'addsubcategory'])->name('admin.all.addsubcategory');
Route::post('get-subcategories', [AdminController::class,'getSubcategories'])->name('getSubcategories');

Route::get('/admin/edit/editsubtitle', function () {return view('admin.editsubtitle');})->name('admin.edit.editsubtitle');
Route::get('/admin/edit/category', function () {return view('admin.editcategory');})->name('admin.edit.category');

Route::get('/admin/edit/subcategory', function () {return view('admin.editsubcategory');})->name('admin.edit.subcategory');
//endcategory


Route::get('/admin/detail/product', function () {return view('admin.product.product_detail');})->name('admin.detail.product');
Route::get('/admin/edit/product', function () {return view('admin.product.product_edit');})->name('admin.edit.product');

//AdminOrder
Route::get('/admin/all/order', function () {return view('admin.order.order_all');})->name('admin.all.order');
Route::get('/admin/detail/order', function () {return view('admin.order.order_detail');})->name('admin.detail.order');
Route::get('/admin/tracking/order', function () {return view('admin.order.order_tracking');})->name('admin.order-tracking');


//Seller
Route::controller(RegisterController::class)->group(function(){
    Route::get('/seller/register','SellerRegister')->name('seller.register');
    Route::post('/seller/registered','SellerRegistered')->name('seller.registered');
});
Route::get('/seller', function () {return view('seller.index');})->name('seller.dashboard');
Route::get('/seller/profile', function () {return view('seller.profile');})->name('seller.profile');
Route::get('/seller/review/product', function () {return view('seller.product.product_review');})->name('seller.product.review');
Route::get('/seller/help', function () {return view('seller.help.help');})->name('seller.help');
Route::get('/seller/add/help', function () {return view('seller.help.help_add');})->name('seller.help.add');

//Brand
Route::controller(BrandController::class)->group(function(){
    Route::get('/add/brand','AddBrand')->name('add.brand');
    Route::post('/store/brand','StoreBrand')->name('store.brand');
});

//SellerProduct
Route::controller(ProductController::class)->group(function(){
    Route::get('/seller/all/product','AllProduct')->name('seller.all.product');
    Route::get('/seller/detail/product/{id}','DetailProduct')->name('seller.detail.product');
    Route::get('/seller/add/product','AddProduct')->name('seller.add.product');
    Route::post('/seller/store/product','StoreProduct')->name('seller.store.product');
    Route::get('/seller/edit/product','EditProduct')->name('seller.edit.product');
    Route::post('/seller/update/product','UpdateProduct')->name('seller.update.product');
    Route::get('/seller/delete/product','DeleteProduct')->name('seller.delete.product');
    Route::post('/seller/product/status', 'changeStatus')->name('changeStatus');
});

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




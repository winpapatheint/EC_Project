<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HcompanyController;
use App\Http\Controllers\HostController;
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

Route::get('/', [AdminController::class, 'welcome']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/privacypolicy', function () {
    return view('privacypolicy');
});

Route::get('/applytojoin', function () {
    return view('applytojoin');
});

Route::get('/recruit', function () {
    return view('recruit');
});

Route::get('/benefit', function () {
    return view('benefit');
});

Route::get('/content', function () {
    return view('content');
});

Route::get('/intro', function () {
    return view('intro');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/course', function () {
    return view('course');
});

Route::get('/exam', function () {
    return view('exam');
});

Route::get('/directormessage', function () {
    return view('directormessage');
});

Route::get('/companyprofile', function () {
    return view('companyprofile');
});

Route::get('/philosophy', function () {
    return view('philosophy');
});

Route::get('/faq', [AdminController::class, 'indexfaq']);

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/service', function () {
    return view('service');
});

// Route::get('/scheduletab', function () {
//     return view('scheduletab');
// });
Route::post('admin/delete', [AdminController::class, 'delete'])->name('delete');

Route::post('user/emptycart', [UserController::class, 'emptycart'])->name('emptycart');

Route::get('/payreturn', [AdminController::class, 'payreturnget']);
Route::post('payreturn', [AdminController::class, 'payreturn'])->name('payreturn');

Route::post('contact', [AdminController::class, 'contact'])->name('contact');
// Route::post('blog', [AdminController::class, 'blog'])->name('blog');
Route::get('/blog', [AdminController::class, 'blog']);
Route::get('/news', [AdminController::class, 'blog']);
Route::get('/blog/{blogid}', [AdminController::class, 'blogdetail']);
Route::get('/news/{blogid}', [AdminController::class, 'blogdetail']);
Route::get('/event/{eventid}', [AdminController::class, 'eventdetail']);

Route::get('/gallery', [AdminController::class, 'gallery']);
Route::get('/sponsors', [AdminController::class, 'sponsor']);
Route::get('/scheduletab', [AdminController::class, 'scheduletab']);
Route::get('/hostlisting', [AdminController::class, 'hostlisting']);
Route::get('/aboutus', [AdminController::class, 'aboutus']);




Route::get('/{role}/login', [AdminController::class, 'adminlogin']);
// Route::get('/admin/login', function () {return view('auth.loginadmin');});
// Route::get('/hcompany/login', function () {return view('auth.loginhcompany');});
// Route::get('/host/login', function () {return view('auth.loginhost');});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:user'])->name('dashboard');

Route::get('/edit/{role}/{id}', [AdminController::class, 'editdata'])->middleware(['auth', 'verified']);

Route::post('edituser', [AdminController::class, 'updateuser'])->name('edituser');

Route::post('deleteuser', [AdminController::class, 'deleteuser'])
                ->middleware(['auth', 'verified'])->name('deleteuser');

Route::post('deletematters', [AdminController::class, 'deletematters'])
                ->middleware(['auth', 'verified'])->name('deletematters');

// Route::get('/about-us', ['as' => 'about-us', 'uses' => 'mattersController@aboutus']);
Route::get('/admin', [AdminController::class, 'indexevent'])->middleware(['auth', 'verified','role:admin']);
// Route::get('/admin', [AdminController::class, 'indexuser'])->middleware(['auth', 'verified','role:admin'])->name('admin');
Route::get('admin/hcompany', [AdminController::class, 'indexhcompany'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/registerhcompany', function () {return view('admin.registerhcompany');});
Route::get('/admin/registerblog', function () {return view('admin.registerblog');})->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/registerevent', function () {return view('admin.registerevent');})->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/registerfaq', function () {return view('admin.registerfaq');})->middleware(['auth', 'verified','role:admin']);
Route::get('/registergallery', function () {return view('admin.registergallery');})->middleware(['role:admin,hcompany']);
Route::post('admin/registerhcompany', [AdminController::class, 'storehcompany'])->name('registerhcompany');
Route::get('/editblog/{blogid}', [AdminController::class, 'editblog'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editevent/{eventid}', [AdminController::class, 'editevent'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editfaq/{faqid}', [AdminController::class, 'editfaq'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editgallery/{galleryid}', [AdminController::class, 'editgallery'])->middleware(['auth', 'verified','role:admin,hcompany']);

Route::post('admin/registerblog', [AdminController::class, 'storeblog'])->name('registerblog');
Route::post('admin/registerevent', [AdminController::class, 'storeevent'])->name('registerevent');
Route::post('admin/registerfaq', [AdminController::class, 'storefaq'])->name('registerfaq');
Route::post('admin/savefaqorder', [AdminController::class, 'savefaqorder'])->name('savefaqorder');
Route::post('admin/registergallery', [AdminController::class, 'storegallery'])->name('registergallery');

Route::get('/takeremote/{id}', [AdminController::class, 'takeremote'])->middleware(['auth', 'verified','role:admin']);
Route::get('/takeremotehost/{id}', [AdminController::class, 'takeremote'])->middleware(['auth', 'verified','role:hcompany']);
Route::post('/returnadmin', [AdminController::class, 'returnadmin'])
                ->middleware(['auth', 'verified'])
                ->name('returnadmin');

Route::get('/admin/news', [AdminController::class, 'indexblog'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/events', [AdminController::class, 'indexevent'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/faq', [AdminController::class, 'indexfaq'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/gallery', [AdminController::class, 'indexgallery'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/topsetting', [AdminController::class, 'indextopsetting'])->middleware(['auth', 'verified','role:admin']);
Route::post('admin/registertopsetting', [AdminController::class, 'storetopsetting'])->name('registertopsetting');
Route::post('admin/registershowseminar', [AdminController::class, 'registershowseminar'])->name('registershowseminar');
Route::post('admin/hideseminar', [AdminController::class, 'hideseminar'])->name('hideseminar');

Route::get('admin/seminars', [AdminController::class, 'indexseminars'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/analayticmarketing', [AdminController::class, 'indexanalayticmarketing'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/analayticexam', [AdminController::class, 'indexanalayticexam'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/analayticdifficulty', [AdminController::class, 'indexanalayticdifficulty'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/sales', [AdminController::class, 'indexsales'])->middleware(['auth', 'verified','role:admin']);

Route::get('admin/hosts', [AdminController::class, 'indexhosts'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/types', [AdminController::class, 'indextypes'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/puchases', [AdminController::class, 'indexpuchases'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/registertypes', function () {return view('admin.registertypes');});
Route::post('admin/registertypes', [AdminController::class, 'storetypes'])->name('registertypes');
Route::get('/edittype/{id}', [AdminController::class, 'edittype'])->middleware(['auth', 'verified','role:admin']);

Route::post('admin/gettypechild', [AdminController::class, 'gettypechild'])->name('gettypechild');
Route::post('getnoti', [AdminController::class, 'getnoti'])->name('getnoti');
Route::post('markread', [AdminController::class, 'markread'])->name('markread');
Route::get('admin/payment', [AdminController::class, 'indexpayment'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/indexresult', [AdminController::class, 'indexresult'])->name('indexresult');


Route::get('/hcompany/gallery', [HcompanyController::class, 'indexgallery'])->middleware(['auth', 'verified','role:hcompany']);
Route::get('/hcompany', [HcompanyController::class, 'indexhost'])->middleware(['auth', 'verified','role:hcompany'])->name('hcompany');
Route::get('/hcompany/registerhost', function () {return view('hcompany.registerhost');});
Route::post('hcompany/registerhost', [HcompanyController::class, 'storehost'])->name('registerhost');

Route::get('/hcompany/setzoomapi', function () {return view('hcompany.setzoomapi');});
Route::post('hcompany/setzoomapi', [HcompanyController::class, 'setzoomapi'])->name('setzoomapi');

Route::get('/hcompany/seminars', [HcompanyController::class, 'indexseminars'])->middleware(['auth', 'verified','role:hcompany'])->name('indexseminars');
Route::get('/hcompany/calender', [HcompanyController::class, 'indexcalender'])->middleware(['auth', 'verified','role:hcompany'])->name('indexcalender');
Route::get('/hcompany/sales', [HcompanyController::class, 'indexsales'])->middleware(['auth', 'verified','role:hcompany'])->name('indexsales');
Route::get('hcompany/analayticmarketing', [AdminController::class, 'indexanalayticmarketing'])->middleware(['auth', 'verified','role:hcompany']);
Route::get('hcompany/analayticexam', [AdminController::class, 'indexanalayticexam'])->middleware(['auth', 'verified','role:hcompany']);
Route::get('hcompany/analayticdifficulty', [AdminController::class, 'indexanalayticdifficulty'])->middleware(['auth', 'verified','role:hcompany']);

Route::post('hcompany/registerfee', [HcompanyController::class, 'registerfee'])->name('registerfee');
Route::get('hcompany/payment', [HcompanyController::class, 'indexpayment'])->middleware(['auth', 'verified','role:hcompany']);


Route::get('/hcompany/registernotify/{semid}', [HcompanyController::class, 'registernotify'])->middleware(['auth', 'verified','role:hcompany']);
Route::post('hcompany/postnotify', [HcompanyController::class, 'postnotify'])->name('postnotify');
Route::get('hcompany/indexresult', [HcompanyController::class, 'indexresult'])->name('indexresult');


Route::get('/host', [HostController::class, 'indexschedule'])->middleware(['auth', 'verified','role:host'])->name('host');
Route::get('/host/registerseminar', function () {return view('host.registerseminar');});
Route::post('host/registerseminar', [HostController::class, 'storeseminar'])
                ->middleware(['auth', 'verified'])->name('registerseminar');
Route::get('host/seminars', [HostController::class, 'indexseminars'])->middleware(['auth', 'verified','role:host']);
Route::get('host/analayticmarketing', [AdminController::class, 'indexanalayticmarketing'])->middleware(['auth', 'verified','role:host']);
Route::get('host/analayticexam', [AdminController::class, 'indexanalayticexam'])->middleware(['auth', 'verified','role:host']);
Route::get('host/analayticdifficulty', [AdminController::class, 'indexanalayticdifficulty'])->middleware(['auth', 'verified','role:host']);
Route::get('host/payment', [HostController::class, 'indexpayment'])->middleware(['auth', 'verified','role:host']);
Route::get('/host/registerquestion', function () {return view('host.registerquestion');});
Route::post('host/registerquestion', [HostController::class, 'registerquestion'])
                ->middleware(['auth', 'verified'])->name('registerquestion');
Route::get('host/question', [HostController::class, 'indexquestion'])->middleware(['auth', 'verified','role:host']);
Route::get('/previewquestion/{id}', [HostController::class, 'previewquestion'])->middleware(['auth', 'verified','role:host']);
Route::get('/host/registertest', function () {return view('host.registertest');});
Route::post('host/registertest', [HostController::class, 'registertest'])->middleware(['auth', 'verified'])->name('registertest');
Route::post('host/addquetotest', [HostController::class, 'addquetotest'])->middleware(['auth', 'verified'])->name('addquetotest');
Route::get('host/test', [HostController::class, 'indextest'])->middleware(['auth', 'verified','role:host']);
Route::get('/testedit/{testid}', [HostController::class, 'testedit'])->middleware(['auth', 'verified'])->name('testedit');
Route::get('/questionedit/{questionid}', [HostController::class, 'questionedit'])->middleware(['auth', 'verified'])->name('questionedit');
Route::get('/questiondel/{questionid}', [HostController::class, 'questiondel'])->middleware(['auth', 'verified'])->name('questiondel');
Route::get('/previewtest/{id}', [HostController::class, 'previewtest'])->middleware(['auth', 'verified','role:host']);
Route::post('host/opentest', [HostController::class, 'opentest'])->name('opentest');
Route::post('host/updatelog', [HostController::class, 'updatelog'])->name('updatelog');
Route::post('host/submittest', [HostController::class, 'submittest'])->name('submittest');
Route::get('host/indexresult', [HostController::class, 'indexresult'])->name('indexresult');

Route::post('host/deletetest', [HostController::class, 'deletetest'])->name('deletetest');

Route::get('host/sales', [HostController::class, 'indexsales'])->middleware(['auth', 'verified','role:host']);

Route::get('/examdone', function () {return view('examdone');});


Route::get('/bookseminars', [UserController::class, 'indexbookseminars'])->middleware(['auth', 'verified','role:user'])->name('bookseminars');
Route::get('/user', [UserController::class, 'index'])->middleware(['auth', 'verified','role:user'])->name('usermainpage');
Route::get('/joinedseminars', [UserController::class, 'indexjoinedseminars'])->middleware(['auth', 'verified','role:user'])->name('joinedseminars');
Route::post('applyseminar', [UserController::class, 'applyseminar'])->middleware(['auth', 'verified','role:user'])->name('applyseminar');
Route::get('/cart', [UserController::class, 'indexcart'])->middleware(['auth', 'verified','role:user'])->name('cart');
// Route::get('removefromcart/{semid}', [UserController::class, 'removefromcart'])->middleware(['auth', 'verified','role:user']);
Route::post('user/removefromcart/', [UserController::class, 'removefromcart'])
                ->middleware(['auth', 'verified','role:user'])->name('removefromcart');

Route::get('/examreview/{id}', [HostController::class, 'examreview'])->middleware(['auth', 'verified']);
Route::get('/exam/{id}', [HostController::class, 'exam'])->middleware(['auth', 'verified']);

Route::post('user/makepay', [UserController::class, 'makepay'])
                ->middleware(['auth', 'verified','role:user'])->name('makepay');
Route::get('/indexresult', [UserController::class, 'indexresult'])->middleware(['auth', 'verified','role:user'])->name('indexresult');


Route::get('/seminardetail/{seminarid}', [SeminarController::class, 'seminardetail'])
// ->middleware(['auth', 'verified'])
->name('seminardetail');
Route::get('/seminaredit/{seminarid}', [SeminarController::class, 'seminaredit'])->middleware(['auth', 'verified'])->name('seminaredit');
// http://seminar-test.asia-hd.com/seminaredit/3527819
Route::get('/booktest', [UserController::class, 'indexbooktest'])->middleware(['auth', 'verified','role:user'])->name('booktest');

Route::resource('seminars', SeminarController::class);

require __DIR__.'/auth.php';

    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\HomeController as AdminHome;
    use App\Http\Controllers\Admin\UserController as AdminUser;
    use App\Http\Controllers\Admin\CountryController;
    use App\Http\Controllers\Admin\BlogController as AdminBlog;
    use App\Http\Controllers\Admin\CategoryController;
    use App\Http\Controllers\Admin\BrandController;

    use App\Http\Controllers\Frontend\HomeController as FrontendHome;
    use App\Http\Controllers\Frontend\RegisterController;
    use App\Http\Controllers\Frontend\LoginController;
    use App\Http\Controllers\Frontend\BlogController as FrontendBlog;
    use App\Http\Controllers\Frontend\InteractionController;
    use App\Http\Controllers\Frontend\UserController as MemberUser;
    use App\Http\Controllers\Frontend\ProductController;
    use App\Http\Controllers\Frontend\CartController;
    use App\Http\Controllers\Frontend\SendmailController;
    use App\Http\Controllers\Frontend\SearchController;


    Route::get('/', function () {
        return view('welcome');
    });

    
    Route::get('/mail/check', function() {
        return view('email.index');
    });

    Route::get('/product/search/advanced', [SearchController::class,'shopadvanced']);
    Route::get('/product/search/resultadvanced', [SearchController::class,'searchadvanced']);
    Route::post('/product/search/ajaxSearch', [SearchController::class,'ajaxSearch']);

    Route::get('/product/home', [CartController::class,'home']);
    Route::post('/product/search', [SearchController::class,'searchname']);
    Route::get('/product/detail/{id}', [ProductController::class,'show']);
    Route::get('/product/checkout', [SendmailController::class,'index']);
    Route::get('/product/checkout/send', [SendmailController::class,'mail']);
    
    Route::group(['prefix' => 'checkout'], function () {
        Route::post('/register', [RegisterController::class,'store']);
    });
    
    Route::group(['prefix' => 'account'], function () {

        Route::get('/update', [MemberUser::class,'edit']);
        Route::post('/update', [MemberUser::class,'update']);

        Route::get('/product/add',[ProductController::class,'create']);
        Route::post('/product/add',[ProductController::class,'store']);
        Route::get('/product/list',[ProductController::class,'index']);
        Route::get('/product/delete/{id}',[ProductController::class,'destroy']);
        Route::get('/product/edit/{id}',[ProductController::class,'edit']);
        Route::post('/product/edit/{id}',[ProductController::class,'update']);

        Route::post('/cart/ajax', [CartController::class,'cartAjax']);
        Route::get('/cart/list', [CartController::class,'index']);
        Route::post('/add/ajax', [CartController::class,'addAjax']);
        Route::post('/down/ajax', [CartController::class,'downAjax']);
        Route::post('/delete/ajax', [CartController::class,'downAjax']);


    });


    Route::group(['prefix' => 'member','middleware' => ['web']], function () {
        
        Route::get('/register', [RegisterController::class,'create']);
        Route::post('/register', [RegisterController::class,'store']);
        Route::get('/login', [LoginController::class,'index']);
        Route::post('/login', [LoginController::class,'login']);
        Route::get('/logout', [LoginController::class,'logout']);

    });
 

    Route::group(['prefix' => 'blog'], function () {

        Route::get('/list', [FrontendBlog::class,'index']);
        Route::get('/detail/{id}', [FrontendBlog::class,'show']);
        Route::post('/rate/ajax', [FrontendBlog::class,'rateAjax']);
        Route::post('/comment/ajax', [FrontendBlog::class,'commentAjax']);

    });


    /* ----------------------------------------------------------------------------------------------------- */
    Route::group(['prefix' => 'admin'], function () {
        Auth::routes(); // Các route như /login, /register sẽ trở thành /admin/login, /admin/register
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

        Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

        Route::get('/pages', [AdminUser::class,'edit']);
        Route::post('/pages', [AdminUser::class,'update']);

        Route::get('/country/add', [CountryController::class,'create']);
        Route::post('/country/add', [CountryController::class,'store']);
        Route::get('/country', [CountryController::class,'index']);
        Route::get('/country/delete/{id}',[CountryController::class, 'destroy']);

        Route::get('/bloglist', [AdminBlog::class, 'index']);
        Route::get('/deleteblog/{id}',[AdminBlog::class, 'destroy']);
        Route::get('/editblog/{id}', [AdminBlog::class,'edit']);
        Route::post('/editblog/{id}', [AdminBlog::class,'updateblog']);
        Route::get('/createblog', [AdminBlog::class,'create']);
        Route::post('/createblog', [AdminBlog::class,'store']);

        Route::get('/category/list', [CategoryController::class, 'index']);
        Route::get('/category/add', [CategoryController::class, 'create']);
        Route::post('/category/add', [CategoryController::class, 'store']);
        Route::get('/category/delete/{id}',[CategoryController::class, 'destroy']);


        Route::get('/brand/list', [BrandController::class, 'index']);
        Route::get('/brand/add', [BrandController::class, 'create']);
        Route::post('/brand/add', [BrandController::class, 'store']);
        Route::get('/brand/delete/{id}',[BrandController::class, 'destroy']);

    });





























    Route::get('/index', function () {

        return view('Admin.index');
    });

    Route::get('/form', function () {

        return view('Admin.form-basic');
    });

    Route::get('/icon', function () {

        return view('Admin.icon-material');

    });

    Route::get('/starter', function () {

        return view('Admin.starter-kit');
        
    });

    Route::get('/table', function () {

        return view('Admin.table-basic');
        
    });

    Route::get('/member404', function () {
        return view('Frontend.404');
    });




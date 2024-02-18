<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderPanelController;
use App\Http\Controllers\Admin\OrderProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPanelController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;


Route::controller(LoginController::class)
	->middleware('guest')
	->group(function () {
		Route::get('login333', 'create')->name('admin.login');
		Route::post('login333', 'store')->middleware(ProtectAgainstSpam::class);
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(LoginController::class)
	->middleware('auth')
	->group(function () {
		Route::post('logout123', 'destroy')->middleware(ProtectAgainstSpam::class)->name('admin.logout');
	});

Route::controller(DashboardController::class)
	->middleware('auth')
	->group(function () {
		Route::get('admin/techno12', 'index')->name('admin.dashboard');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(UserController::class) 
->middleware('can:users')
	->prefix('admin/users')
	->name('admin.users.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('delete');
		Route::get('password/{id}', 'password')->name('password');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(LocationController::class) 
->middleware('can:locations')
	->prefix('admin/locations')
	->name('admin.locations.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('delete');
		Route::post('up', 'up')->name('up');
		Route::post('down', 'down')->name('down');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(OrderController::class) 
->middleware('can:orders')
	->prefix('admin/orders')
	->name('admin.orders.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
		Route::post('api', 'api')->name('api');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(SliderController::class)
	->middleware('can:sliders')
	->prefix('admin/sliders')
	->name('admin.sliders.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('delete');
		Route::post('edit/tm/{id}', 'deleteImageTmFromEdit')->name('deleteImageTmFromEdit');
		Route::post('edit/ru/{id}', 'deleteImageRuFromEdit')->name('deleteImageRuFromEdit');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(BannerController::class)
	->middleware('can:banners')
	->prefix('admin/banners')
	->name('admin.banners.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('delete');
		Route::post('edit/tm/{id}', 'deleteImageTmFromEdit')->name('deleteImageTmFromEdit');
		Route::post('edit/ru/{id}', 'deleteImageRuFromEdit')->name('deleteImageRuFromEdit');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(AttributeController::class) 
->middleware('can:attributes')
	->prefix('admin/attributes')
	->name('admin.attributes.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
		Route::post('api', 'api')->name('api');
		Route::post('up', 'up')->name('up');
		Route::post('down', 'down')->name('down');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(AttributeValueController::class) 
->middleware('can:attribute_values')
	->prefix('admin/attribute_values')
	->name('admin.attribute_values.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
		Route::post('api', 'api')->name('api');
		Route::post('up', 'up')->name('up');
		Route::post('down', 'down')->name('down');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(BrandController::class) 
->middleware('can:brands')
	->prefix('admin/brands')
	->name('admin.brands.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('edit/{id}', 'deleteImageFromEdit')->name('deleteImageFromEdit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
		Route::post('api', 'api')->name('api');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(CategoryController::class)
	->middleware('can:categories')
	->prefix('admin/categories')
	->name('admin.categories.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
		Route::post('home', 'home')->name('home');
		Route::post('most-used', 'mostUsed')->name('mostUsed');
		Route::post('up', 'up')->name('up');
		Route::post('down', 'down')->name('down');
		Route::post('api', 'api')->name('api');
		Route::post('active', 'active')->name('active');
		Route::post('edit/small-image/{id}', 'deleteImageSmallImageFromEdit')->name('deleteImageSmallImageFromEdit');
		Route::post('edit/big-image/{id}', 'deleteImageBigImageFromEdit')->name('deleteImageBigImageFromEdit');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------



Route::controller(ProductController::class)
	->middleware('can:products')
	->prefix('admin/products')
	->name('admin.products.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
		Route::post('active', 'active')->name('active');
		Route::post('recommended', 'recommended')->name('recommended');
		Route::post('up', 'up')->name('up');
		Route::post('down', 'down')->name('down');
		Route::post('api', 'api')->name('api');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(NewsCategoryController::class)
	->middleware('can:news_categories')
	->prefix('admin/news_categories')
	->name('admin.news_categories.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(NewsController::class)
	->middleware('can:news')
	->prefix('admin/news')
	->name('admin.news.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('create', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('edit/{id}', 'edit')->name('edit');
		Route::post('update/{id}', 'update')->name('update');
		Route::delete('destroy/{id}', 'destroy')->name('destroy');
		Route::post('api', 'api')->name('api');
		Route::post('active', 'active')->name('active');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(OrderProductController::class)
	->middleware('can:orders')
	->prefix('admin/orderProducts')
	->name('admin.orderProducts.')
	->group(function () {
		Route::get('{id}/edit', 'edit')->name('edit')->where(['id' => '[0-9]+']);
		Route::put('{id}', 'update')->name('update')->where(['id' => '[0-9]+']);
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::controller(ConfigController::class)
	->middleware('can:config')
	->prefix('admin/config')
	->name('admin.config.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::post('update/{id}', 'update')->name('update');
	});


//----------------------------------------------------------------------------------------------------------------------------------------------------


Route::get('admin/products_panel', [ProductPanelController::class, 'index'])->name('admin.productPanel.index');
Route::get('admin/orders_panel', [OrderPanelController::class, 'index'])->name('admin.orderPanel.index');


//----------------------------------------------------------------------------------------------------------------------------------------------------
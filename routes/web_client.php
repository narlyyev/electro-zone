<?php

use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\BrandController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\DiscountProductController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\NewsController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;


Route::controller(HomeController::class)
	->group(function () {
		Route::get('', 'index')->name('home');
		Route::get('/locale/{locale}', 'language')->name('language')->where('locale', '[a-z]+');
		Route::get('quick-search', 'search')->name('quick.search');
		Route::get('show/{slug}', 'show')->name('home.product.show');
	});

Route::controller(BrandController::class)
	->prefix('brands/')
	->name('brand.')
	->group(function () {
		Route::get('show/{slug}', 'show')->name('show');
	});

Route::controller(CategoryController::class)
	->prefix('categories/')
	->name('category.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('show/{slug}', 'show')->name('show');
	});

Route::controller(ProductController::class)
	->prefix('products/')
	->name('product.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('show/{slug}', 'show')->name('show');
	});

Route::controller(CartController::class)
	->group(function () {
		Route::get('cart', 'index')->name('cart');
		Route::post('cart/add', 'add')->name('cart.add');
		Route::post('cart/remove', 'remove')->name('cart.remove');
		Route::get('cart/clear', 'clear')->name('cart.clear');
	});

Route::get('/discount-products', [DiscountProductController::class, 'index'])->name('discount.products');



Route::controller(OrderController::class)
	->group(function () {
		Route::get('order/index', 'index')->name('order.index');
		Route::post('order', 'store')->middleware(ProtectAgainstSpam::class)->name('order');
	});

Route::controller(NewsController::class)
	->prefix('news/')
	->name('news.')
	->group(function () {
		Route::get('index', 'index')->name('index');
		Route::get('show/{slug}', 'show')->name('show');
	});

Route::get('about/index', [AboutController::class, 'index'])->name('about.index');

Route::get('contact/index', [ContactController::class, 'index'])->name('contact.index');


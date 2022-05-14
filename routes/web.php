<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
 

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

//Route::get('/', function () {return view('welcome');});
//::get('/', [FontendController::class,'index']);
Route::get('/', [FontendController::class,'index'])->name('product-search'); 
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin',[LoginController::class,'showLoginForm'])->name('admin.login');
Route::get('admin/home', [AdminController::class,'index'])->name('admin.home');
Route::get('admin/logout', [AdminController::class,'Logout'])->name('admin.logout');
Route::post('admin', [LoginController::class,'Login']);
 


/* Route::get('/', [FontendController::class,'index']); 
//Route::get('/',[FontendController::class,'index']);


Auth::routes();

 

Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('admin/home', [AdminController::class,'index'])->name('admin.home');
Route::get('/admin', [LoginController::class,'showLoginForm'])->name('admin.login');
Route::post('admin', [LoginController::class,'Login']);
//Route::get('admin','Admin\LoginController@logout')->name('admin.logout');

 
Route::get('admin/logout', [AdminController::class,'Logout'])->name('admin.logout');

 */


 
//==================Admin section Category=================


Route::get('admin/category',[CategoryController::class,'index'])->name('Admin.category');
Route::post('admin/categories-store',[CategoryController::class,'StoreCat'])->name('store.category');
//Route::post('admin/categories-store','Admin\CategoryController@StoreCat')->name('store.category');
Route::get('admin/categories/edit/{cat_id}',[CategoryController::class,'Edit']);
Route::post('admin/categories-update',[CategoryController::class,'UpdateCat'])->name('update.category');
Route::get('admin/categories/delete/{cat_id}',[CategoryController::class,'Delete']);
//Route::get('admin/categories/inactive/{cat_id}','Admin\CategoryController@Inactive');
//::get('admin/categories/Inactive/{cat_id}','Admin\CategoryController@Inactive');
//Route::get('admin/categories/active/{cat_id}','Admin\CategoryController@active');
Route::get('admin/categories/inactive/{cat_id}',[CategoryController::class,'Inactive']);
Route::get('admin/categories/active/{cat_id}',[CategoryController::class,'Active']);



//=========================Admin brand==========================
Route::get('admin/brand',[BrandController::class,'index'])->name('admin.brand');
Route::post('admin/brand-store',[BrandController::class,'store'])->name('store.brand');
Route::get('admin/brand/edit/{brand_id}',[BrandController::class,'edit']);
Route::post('admin/brand-update',[BrandController::class,'update'])->name('update.brand');
Route::get('admin/brand/delete/{brand_id}',[BrandController::class,'delete']);
Route::get('admin/brand/inactive/{brand_id}',[BrandController::class,'inActive']);
Route::get('admin/brand/active/{brand_id}',[BrandController::class,'active']);

//=========================Admin Addproduct====================

Route::get('admin/product/add',[ProductController::class,'addProduct'])->name('add.products');
Route::post('admin/product/store',[ProductController::class,'storeProduct'])->name('store.products');
Route::get('admin/product/manage',[ProductController::class,'ManageProduct'])->name('manage.products');
Route::get('admin/product/edit/{product_id}',[ProductController::class,'editProduct']);
Route::post('admin/product/update',[ProductController::class,'updateProduct'])->name('update-products');
Route::post('admin/product/update-image',[ProductController::class,'updateImage'])->name('update-image');
Route::get('admin/product/delete/{product_id}',[ProductController::class,'destroy']);
Route::get('admin/product/inactive/{product_id}',[ProductController::class,'inActive']);
Route::get('admin/product/active/{product_id}',[ProductController::class,'Active']);



//=========================Coupon==============================

Route::get('admin/coupon',[CouponController::class,'index'])->name('admin-coupon');
Route::post('admin/coupon-store',[CouponController::class,'CouponStore'])->name('coupon-store');
Route::get('admin/coupon/edit/{coupon_id}',[CouponController::class,'couponEdit']); 
Route::post('admin/coupon/update',[CouponController::class,'CouponUpdate'])->name('coupon-update');
Route::get('admin/coupon/delete/{coupon_id}',[CouponController::class,'destroy']); 
Route::get('admin/coupon/active/{coupon_id}',[CouponController::class,'active']);
Route::get('admin/coupon/inactive/{coupon_id}',[CouponController::class,'InActive']);


//
//Route::get('admin/orders',[OrderController::class,'index'])->name('admin-order');

Route::get('admin/orders',[AdminOrderController::class,'index'])->name('admin-order');
Route::get('admin/orders/view/{id}',[AdminOrderController::class,'viewOrder']);

//=====================================Fontend route section=============================

   //================================Cart========================================

Route::post('add/to-cart/{product_id}',[CartController::class,'addToCart']);
Route::get('cart',[CartController::class,'cartPageShow']);
Route::get('cart/destroy/{cart_id}',[CartController::class,'destroy']);
Route::post('cart/quantity/update/{cart_id}',[CartController::class,'updateCart']);
Route::post('coupon/apply',[CartController::class,'applyCoupon']);
Route::get('coupon/destroy',[CartController::class,'destroyCoupon']);


//===============================add to wishlist=================================

Route::get('add/to-wishlist/{product_id}',[WishController::class,'addToWish']);
Route::get('wishlist',[WishController::class,'wishShow']);
Route::get('wishlist/destroy/{wishlist_id}',[WishController::class,'destroy']);

//=========================fontend shop detail==========================

Route::get('proudct/details/{product_id}',[FontendController::class,'productDetails'])->name('product-details');



//=================================fontend shop page==================================

Route::get('shop',[FontendController::class,'shopPage'])->name('shop-page');

// category wise product show

Route::get('category/product-show/{id}',[FontendController::class,'catWiseProduct']);


//=====================contact page================================
Route::get('contact/page',[FontendController::class,'contact']);


//===========================Checkout=======================================

Route::get('checkout',[CheckoutController::class,'index']);
Route::post('place/order',[OrderController::class,'storeOrder'])->name('place-order');
Route::get('order/success',[OrderController::class,'orderSuccess']);


//=================================Route User================================

Route::get('user/order',[UserController::class,'order'])->name('user-order');
Route::get('user/order-view/{id}',[UserController::class,'orderView']);


//=======================mail============================


Route::get('/contact-us',[MailController::class,'contact']);
Route::post('/send-email',[MailController::class,'sendMail'])->name('send-mail');
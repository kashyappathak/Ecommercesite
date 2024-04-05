<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CommentController;

use App\Http\Controllers\Admin\WishlistController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\InvoiceController;

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('privacypolicy', function () {
  return view('privacypolicy');
});


Route::get('aboutus', function () {
  return view('aboutus');
});

Route::get('/test', function () {
  orderEmail(59); // Function is now defined in helper.php
});

Route::get('send-email-pdf', [PDFController::class, 'index']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Front', [App\Http\Controllers\Frontend\FrontendController::class , 'index']);
Route::get('CategorySlug/{slug}', [App\Http\Controllers\Frontend\FrontendController::class , 'CategorySlug']);
Route::get('ProductSlug/{slug}/{p_slug}', [App\Http\Controllers\Frontend\FrontendController::class , 'ProductSlug'])->name('view.index');
Route::post("/addcart/{id}",[FrontEndController::class,'addcart']);
Route::get('cartPage',[FrontEndController::class, 'cartPage'])->name('cartPage'); 
Route::post('/update-cart',[FrontEndController::class,'updateCart'])->name('front.updateCart');
Route::delete('/removeCart', [FrontendController::class, 'removeCart'])->name('removeCart');
Route::get('/search',[FrontEndController::class,'search']);
Route::post('/addtowishlist/{id}',[FrontEndController::class , 'addtowishlist']);
Route::get('wishlistpage',[FrontEndController::class, 'wishlistpage'])->name('wishlistpage'); 
Route::delete('/removeWishlist/{id}', [FrontendController::class, 'removeWishlist'])->name('removeWishlist');
Route::get('/checkout',[FrontEndController::class,'checkout']);
Route::post('/process-checkout/{id}',[FrontEndController::class,'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}',[FrontEndController::class,'thankyou'])->name('front.thankyou');
Route::post('coupon/apply' , [FrontEndController::class,'applyCoupon']);
Route::get('coupon/destroy' , [FrontEndController::class,'destroyCoupen']);
Route::post('comments',[FrontendController::class , 'store']);
Route::get('edit/{id}',[FrontendController::class,'edit']);
Route::post('update-comment/{id}',[FrontendController::class,'update']);
Route::post('delete-comment/{id}',[FrontendController::class,'destroy']);
Route::get('profiles/',[FrontEndController::class,'profiles']);
Route::put('profiles/{id}',[FrontEndController::class,'profilesupdate']);
Route::get('myorders/',[FrontEndController::class,'myorders']);
Route::get('/order/cancel/{id}', [FrontEndController::class,'orderCancel'])->name('order.cancel');
Route::get('myorders/view/{id}', [FrontEndController::class,'view']);
Route::get('invoice-pdf/{id}', [InVoiceController::class, 'index']);



Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function() {
    Route::get('/dashboard',[App\Http\Controllers\Admin\DashBoardController::class , 'index']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except('show');
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->except('show');
    Route::resource('brands', App\Http\Controllers\Admin\BrandController::class)->except('show');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->except('show');
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->except('show');
    Route::resource('carts', App\Http\Controllers\Admin\CartController::class)->except('show');
    Route::resource('comments', App\Http\Controllers\Admin\CommentController::class)->except('show');
    Route::resource('wishlists', App\Http\Controllers\Admin\WishlistController::class)->except('show');
    Route::delete('orderItem/destroy/{id}', [OrderController::class, 'delete'])->name('orderItem.delete');
    Route::resource('coupons', App\Http\Controllers\Admin\CouponController::class)->except('show');
    Route::get('profiles/', [App\Http\Controllers\Admin\UserController::class , 'profiles']);
    Route::put('profiles/{id}', [App\Http\Controllers\Admin\UserController::class , 'profileupdate']);
    Route::get('coupons/inactive/{id}', [App\Http\Controllers\Admin\CouponController::class, 'Inactive'])->name('coupons.inactive');
    Route::get('coupons/active/{id}', [App\Http\Controllers\Admin\CouponController::class, 'Active'])->name('coupons.active');
    Route::get('product-image/{product_image_id}/delete', [ProductController::class, 'destroyImage']);
    Route::get('ordercreate', [OrderController::class, 'ordercreate'])->name('orders.ordercreate');
    Route::get('settings',[App\Http\Controllers\Admin\SettingController::class,'index']);
    Route::post('setting',[App\Http\Controllers\Admin\SettingController::class,'savedata']);
    Route::get('/searchcomments',[CommentController::class,'searchcomments']);
    Route::get('/searchwishlist',[WishlistController::class,'searchwishlist']);
    Route::get('/search',[DashboardController::class,'search']);
    
});



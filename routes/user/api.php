<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CallRequestController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\InstagramPostController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\TorobApiController;
use Illuminate\Support\Facades\Route;

Route::controller(ProfileController::class)->prefix('profile')->group(function (){
    Route::get('/profile-data','profileData')->middleware('auth:sanctum');
    Route::post('/update','updateProfileData')->middleware('auth:sanctum');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function (){
    Route::get('product-categories','productCategories');
    Route::get('blog-categories','blogCategories');
    Route::post('single','single');
    Route::get('detail/{slug}','detail');
});

Route::controller(ProductController::class)->prefix('products')->group(function (){
    Route::get('all','allProducts');
    Route::post('list','list');
    Route::get('specials','specialList');
    Route::get('discount-list','discountList');
    Route::post('single','single');
    Route::get('detail/{slug}','detail');
    Route::post('add-comment','addComment')->middleware('auth:sanctum');
});

Route::controller(CartController::class)->prefix('cart')->middleware('auth:sanctum')->group(function (){
    Route::post('add','addToCart');
    Route::get('show','showCart');
    Route::delete('remove-item','removeFromCart');
    Route::put('update','updateCart');
    Route::delete('clear','clearCart');
});

Route::controller(OrderController::class)->prefix('orders')->middleware('auth:sanctum')->group(function (){
    Route::get('/list','getUserOrders');
    Route::post('/create','createOrder');
    Route::get('/pay-callback','callBackPayment')
        ->withoutMiddleware('auth:sanctum')
        ->name('payment.callback');
});

Route::controller(BlogController::class)->prefix('blogs')->group(function (){
    Route::get('all','allBlogs');
    Route::post('list','list');
    Route::post('single','single');
    Route::get('detail/{slug}','detail');
    Route::post('add-comment','addComment')->middleware('auth:sanctum');

});

Route::controller(SliderController::class)->prefix('sliders')->group(function (){
    Route::get('list','list');
});

Route::controller(InstagramPostController::class)->prefix('instagram-posts')->group(function (){
    Route::get('list','list');
});

Route::controller(EmployeeController::class)->prefix('employees')->group(function (){
    Route::get('list','list');
});

Route::controller(CallRequestController::class)->prefix('call-requests')->group(function (){
    Route::post('add-request','storeCallRequest');
});

Route::controller(TorobApiController::class)->prefix('torob_api')->group(function (){
    Route::prefix('v3')->group(function (){
        Route::post('products','list');
    });
});

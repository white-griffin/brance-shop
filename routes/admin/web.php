<?php


use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Admin\BlogController;
use App\Http\Controllers\Web\Admin\CallRequestController;
use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Controllers\Web\Admin\CommentController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\EmployeeController;
use App\Http\Controllers\Web\Admin\InstagramPostController;
use App\Http\Controllers\Web\Admin\OrderController;
use App\Http\Controllers\Web\Admin\PaymentController;
use App\Http\Controllers\Web\Admin\PermissionController;
use App\Http\Controllers\Web\Admin\ProductController;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\SliderController;
use App\Http\Controllers\Web\Admin\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


// users
Route::controller(UsersController::class)->prefix('users')->group( function () {
    Route::get('/',  'list')->name('users.all');
    Route::get('/create',  'create')->name('users.create');
    Route::post('/store',  'store')->name('users.store');
    Route::get('/edit/{user}',  'edit')->name('users.edit');
    Route::post('/update/{user}',  'update')->name('users.update');
    Route::get('/delete/{user}',  'delete')->name('users.delete');
    Route::get('/search/ajax',  'searchWithAjax')->name('users.search.ajax');
    Route::get('/today-logins',  'todayLoginsList')->name('users.today-logins');

});



//Admins
Route::controller(AdminController::class)->prefix('admins')->group( function () {
    Route::get('/',  'index')->name('admins.all');
    Route::get('/create',  'create')->name('admins.create');
    Route::post('/store',  'store')->name('admins.store');
    Route::get('/edit/{admin}',  'edit')->name('admins.edit');
    Route::post('/update/{admin}',  'update')->name('admins.update');
    Route::get('/permissions/{admin}',  'permissions')->name('admins.permissions');
    Route::get('/roles/{admin}',  'roles')->name('admins.roles');
    Route::get('/search/ajax',  'searchWithAjax')->name('admins.search.ajax');
});

//Acl
Route::prefix('acl')->group( function () {
    //permissions
    Route::controller(PermissionController::class)->prefix('permissions')->group( function () {
        Route::get('/', 'all')->name('permissions.all');
        Route::get('/refresh_permissions', 'refresh_permissions')->name('acl.refresh.permissions');
        Route::get('/ajax-search', 'ajaxSearch')->name('permissions.search.ajax');
    });
    //roles
    Route::controller(RoleController::class)->prefix('roles')->group( function () {
        Route::get('/',  'all')->name('roles.all');
        Route::get('/create',  'create')->name('roles.create');
        Route::post('/store',  'store')->name('roles.store');
        Route::get('/{role}/edite',  'edit')->name('roles.edit');
        Route::post('/{role}/update',  'update')->name('roles.update');
        Route::get('/{role}/delete',  'delete')->name('roles.delete');
        Route::get('/{role}/permissions',  'permissions')->name('role.permissions');
        Route::get('/ajax-search',  'ajaxSearch')->name('roles.search.ajax');
    });
});

// Categories
Route::controller(CategoryController::class)->prefix('categories')->group(function (){
    Route::get('/list',  'list')->name('categories.list');
    Route::get('/product-categories',  'productCategories')->name('categories.product-categories');
    Route::get('/blog-categories',  'blogCategories')->name('categories.blog-categories');
    Route::get('/create',  'create')->name('categories.create');
    Route::post('/store',  'store')->name('categories.store');
    Route::get('/edit/{category}',  'edit')->name('categories.edit');
    Route::post('/update/{category}',  'update')->name('categories.update');
    Route::get('/delete/{category}',  'delete')->name('categories.delete');
    Route::get('/search/ajax/categories',  'searchWithAjax')->name('categories.search.ajax');

});

// Products
Route::controller(ProductController::class)->prefix('products')->group(function (){
    Route::get('/list',  'list')->name('products.list');
    Route::get('/create',  'create')->name('products.create');
    Route::post('/store',  'store')->name('products.store');
    Route::get('/edit/{product}',  'edit')->name('products.edit');
    Route::post('/update/{product}',  'update')->name('products.update');
    Route::get('/delete/{product}',  'delete')->name('products.delete');

    Route::get('/gallery/{product}',  'gallery')->name('products.gallery');
    Route::post('/upload-gallery/{product}',  'uploadGallery')->name('products.upload-gallery');
    Route::get('/delete-gallery/{gallery}',  'deleteGallery')->name('products.delete-gallery');
    Route::post('/delete-gallery-by-name','deleteGalleryByName')->name('products.delete-by-name-gallery');

    Route::get('/attributes/{product}',  'attributes')->name('products.attributes');
    Route::post('/store-attribute/{product}',  'storeAttribute')->name('products.store-attribute');
    Route::get('/delete-attribute/{attribute}',  'deleteAttribute')->name('products.delete-attribute');

    Route::get('/search/ajax/product-categories',  'searchProductCategoriesWithAjax')->name('products.categories.search.ajax');

});

// Blogs
Route::controller(BlogController::class)->prefix('blogs')->group(function (){
    Route::get('/list',  'list')->name('blogs.list');
    Route::get('/create',  'create')->name('blogs.create');
    Route::post('/store',  'store')->name('blogs.store');
    Route::get('/edit/{blog}',  'edit')->name('blogs.edit');
    Route::post('/update/{blog}',  'update')->name('blogs.update');
    Route::get('/delete/{blog}',  'delete')->name('blogs.delete');
    Route::get('/search/ajax/blog-categories',  'searchBlogCategoriesWithAjax')->name('blogs.categories.search.ajax');
	Route::post('ckeditor/upload', 'uploadCkImages')->name('blogs.ckeditor.upload');
});

// Slider
Route::controller(SliderController::class)->prefix('sliders')->group(function (){
    Route::get('/list',  'list')->name('sliders.list');
    Route::post('/store',  'store')->name('sliders.store');
    Route::post('/update/{slider}',  'update')->name('sliders.update');
    Route::get('/delete/{slider}',  'delete')->name('sliders.delete');
    Route::post('/delete-slider-by-name','deleteSliderByName')->name('sliders.delete-by-name-slider');

});

// InstagramPosts
Route::controller(InstagramPostController::class)->prefix('instagram-posts')->group(function (){
    Route::get('/list',  'list')->name('instagram-posts.list');
    Route::post('/store',  'store')->name('instagram-posts.store');
    Route::post('/update/{post}',  'update')->name('instagram-posts.update');
    Route::get('/delete/{post}',  'delete')->name('instagram-posts.delete');
    Route::post('/delete-by-name','deletePostByName')->name('instagram-posts.delete-by-name');

});

// Comments
Route::controller(CommentController::class)->prefix('comments')->group(function (){
    Route::get('/list',  'list')->name('comments.list');
    Route::post('/reply',  'adminReply')->name('comments.reply');
    Route::post('/update-status/{comment}',  'updateStatus')->name('comments.update-status');
    Route::get('/delete/{comment}',  'delete')->name('comments.delete');
});

// CallRequests
Route::controller(CallRequestController::class)->prefix('call-requests')->group(function (){
    Route::get('/list',  'list')->name('call-requests.list');
    Route::post('/update-status/{callRequest}',  'updateStatus')->name('call-requests.update-status');
});

// Orders
Route::controller(OrderController::class)->prefix('orders')->group( function () {

    Route::get('/', 'list')->name('orders.list');
    Route::post('/change-status/{order}' ,'changeStatus')->name('orders.change-status');
    Route::post('/admin/orders/update-delivery-status', 'updateDeliveryStatus')->name('orders.update-delivery-status');
});

// Payments
Route::controller(PaymentController::class)->prefix('payments')->group( function () {

    Route::get('/', 'list')->name('payments.list');

});

//Employees
Route::controller(EmployeeController::class)->prefix('employee')->group(function (){
    Route::get('/list',  'list')->name('employees.list');
    Route::get('/create',  'create')->name('employees.create');
    Route::post('/store',  'store')->name('employees.store');
    Route::get('/edit/{employee}',  'edit')->name('employees.edit');
    Route::post('/update/{employee}',  'update')->name('employees.update');
    Route::get('/delete/{employee}',  'delete')->name('employees.delete');
});


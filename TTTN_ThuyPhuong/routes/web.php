<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\BaivietController;
use App\Http\Controllers\frontend\GiohangController;
use App\Http\Controllers\frontend\LienheController;
use App\Http\Controllers\frontend\SanphamController;
use App\Http\Controllers\frontend\TimkiemController;
use Illuminate\Support\Facades\Auth;

//Khai bao trang nguoi dung
Route::get('/', [App\Http\Controllers\frontend\HomeController::class,'index'])->name('home.index');

// Route::get('admin/login', [AuthController::class, 'login'])->name('admin.login');
//  Route::post('/admin/postlogin', [AuthController::class, 'postlogin'])->name('admin.postlogin');
// Route::prefix('admin')->middleware('adminlogin')->group(function(){
//     Route::get('/logout',[AuthController::class,'logout'])->name('admin.logout');
//  });


//Khai bao route trang  quan ly
Route::prefix('admin')->group(function(){
    // admin
    Route::get('/',[App\Http\Controllers\backend\DashboardController::class,'index'])->name('admin.dashboard');
    // admin/banner
    Route::prefix('banner')->group(function(){
        Route::get('status/{banner}',[App\Http\Controllers\backend\BannerController::class,'status'])->name('banner.status');
        Route::get('edit/{banner}',[App\Http\Controllers\backend\BannerController::class,'edit'])->name('banner.edit');
        Route::get('show/{banner}',[App\Http\Controllers\backend\BannerController::class,'show'])->name('banner.show');
        Route::get('trash',[App\Http\Controllers\backend\BannerController::class,'trash'])->name('banner.trash');
        Route::get('delete/{banner}',[App\Http\Controllers\backend\BannerController::class,'delete'])->name('banner.delete');
        Route::get('restore/{banner}',[App\Http\Controllers\backend\BannerController::class,'restore'])->name('banner.restore');
    });
    Route::resource('banner',App\Http\Controllers\backend\BannerController::class);
    // admin/brand
    Route::prefix('brand')->group(function(){
        Route::get('status/{brand}',[App\Http\Controllers\backend\BrandController::class,'status'])->name('brand.status');
        Route::get('edit/{brand}',[App\Http\Controllers\backend\BrandController::class,'edit'])->name('brand.edit');
        Route::get('show/{brand}',[App\Http\Controllers\backend\BrandController::class,'show'])->name('brand.show');
        Route::get('trash',[App\Http\Controllers\backend\BrandController::class,'trash'])->name('brand.trash');
        Route::get('delete/{brand}',[App\Http\Controllers\backend\BrandController::class,'delete'])->name('brand.delete');
        Route::get('restore/{brand}',[App\Http\Controllers\backend\BrandController::class,'restore'])->name('brand.restore');
    });
    Route::resource('brand',App\Http\Controllers\backend\BrandController::class)->except(['create']);
    
    // admin/category
    Route::prefix('category')->group(function(){
        Route::get('status/{category}',[App\Http\Controllers\backend\CategoryController::class,'status'])->name('category.status');
        Route::get('edit/{category}',[App\Http\Controllers\backend\CategoryController::class,'edit'])->name('category.edit');
        Route::get('show/{category}',[App\Http\Controllers\backend\CategoryController::class,'show'])->name('category.show');
        Route::get('trash',[App\Http\Controllers\backend\CategoryController::class,'trash'])->name('category.trash');
        Route::get('delete/{category}',[App\Http\Controllers\backend\CategoryController::class,'delete'])->name('category.delete');
        Route::get('restore/{category}',[App\Http\Controllers\backend\CategoryController::class,'restore'])->name('category.restore');
    });
    Route::resource('category',App\Http\Controllers\backend\CategoryController::class);
    // admin/config
    Route::prefix('config')->group(function(){
        Route::get("/",[App\Http\Controllers\backend\CategoryController::class,'index'])->name('config.index');
        Route::post("createorupdate",[App\Http\Controllers\backend\CategoryController::class,'createorupdate'])->name('config.createorupdate');
    });
    Route::resource('config',App\Http\Controllers\backend\ConfigController::class);
    // admin/contact
    Route::prefix('contact')->group(function(){
        Route::get('status/{contact}',[App\Http\Controllers\backend\ContactController::class,'status'])->name('contact.status');
        Route::get('edit/{contact}',[App\Http\Controllers\backend\ContactController::class,'edit'])->name('contact.edit');
        Route::get('show/{contact}',[App\Http\Controllers\backend\ContactController::class,'show'])->name('contact.show');
        Route::get('trash',[App\Http\Controllers\backend\ContactController::class,'trash'])->name('contact.trash');
        Route::get('delete/{contact}',[App\Http\Controllers\backend\ContactController::class,'delete'])->name('contact.delete');
        Route::get('restore/{contact}',[App\Http\Controllers\backend\ContactController::class,'restore'])->name('contact.restore');
    });
    Route::resource('contact',App\Http\Controllers\backend\ContactController::class);
    // admin/customer
    Route::prefix('customer')->group(function(){
        Route::get('status/{customer}',[App\Http\Controllers\backend\CustomerController::class,'status'])->name('customer.status');
        Route::get('edit/{customer}',[App\Http\Controllers\backend\CustomerController::class,'edit'])->name('customer.edit');
        Route::get('show/{customer}',[App\Http\Controllers\backend\CustomerController::class,'show'])->name('customer.show');
        Route::get('trash',[App\Http\Controllers\backend\CustomerController::class,'trash'])->name('customer.trash');
        Route::get('delete/{customer}',[App\Http\Controllers\backend\CustomerController::class,'delete'])->name('customer.delete');
        Route::get('restore/{customer}',[App\Http\Controllers\backend\CustomerController::class,'restore'])->name('customer.restore');
    });
    Route::resource('customer',App\Http\Controllers\backend\CustomerController::class);
    // admin/menu
    Route::prefix('menu')->group(function(){
        Route::get('status/{menu}',[App\Http\Controllers\backend\MenuController::class,'status'])->name('menu.status');
        Route::get('edit/{menu}',[App\Http\Controllers\backend\MenuController::class,'edit'])->name('menu.edit');
        Route::get('show/{menu}',[App\Http\Controllers\backend\MenuController::class,'show'])->name('menu.show');
        Route::get('trash',[App\Http\Controllers\backend\MenuController::class,'trash'])->name('menu.trash');
        Route::get('delete/{menu}',[App\Http\Controllers\backend\MenuController::class,'delete'])->name('menu.delete');
        Route::get('restore/{menu}',[App\Http\Controllers\backend\MenuController::class,'restore'])->name('menu.restore');
    });
    Route::resource('menu',App\Http\Controllers\backend\MenuController::class);
    // admin/order
    Route::prefix('order')->group(function(){
        Route::get('export',[App\Http\Controllers\backend\OrderController::class,'export'])->name('order.index');
    });
    Route::resource('order',App\Http\Controllers\backend\OrderController::class);
    // admin/page
    Route::resource('page',App\Http\Controllers\backend\PageController::class);
    // admin/post
    Route::prefix('post')->group(function(){
        Route::get('status/{post}',[App\Http\Controllers\backend\PostController::class,'status'])->name('post.status');
        Route::get('edit/{post}',[App\Http\Controllers\backend\PostController::class,'edit'])->name('post.edit');
        Route::get('show/{post}',[App\Http\Controllers\backend\PostController::class,'show'])->name('post.show');
        Route::post('create',[App\Http\Controllers\backend\PostController::class,'create'])->name('post.create');
        Route::get('trash',[App\Http\Controllers\backend\PostController::class,'trash'])->name('post.trash');
        Route::get('delete/{post}',[App\Http\Controllers\backend\PostController::class,'delete'])->name('post.delete');
        Route::get('restore/',[App\Http\Controllers\backend\PostController::class,'restore'])->name('post.restore');
    });
    Route::resource('post',App\Http\Controllers\backend\PostController::class);
    
    // admin/product
    Route::prefix('product')->group(function(){
            Route::get('status/{product}',[App\Http\Controllers\backend\ProductController::class,'status'])->name('product.status');
            Route::get('edit/{product}',[App\Http\Controllers\backend\ProductController::class,'edit'])->name('product.edit');
            Route::get('show/{product}',[App\Http\Controllers\backend\ProductController::class,'show'])->name('product.show');
            Route::post('create',[App\Http\Controllers\backend\ProductController::class,'create'])->name('product.create');
            Route::get('trash',[App\Http\Controllers\backend\ProductController::class,'trash'])->name('product.trash');
            Route::get('delete/{product}',[App\Http\Controllers\backend\ProductController::class,'delete'])->name('product.delete');
            Route::get('restore/{product}',[App\Http\Controllers\backend\ProductController::class,'restore'])->name('product.restore');
            Route::get('import',[App\Http\Controllers\backend\ProductController::class,'import'])->name('product.index');
    });
    Route::resource('product',App\Http\Controllers\backend\ProductController::class);
    // admin/topic
    Route::prefix('topic')->group(function(){
        Route::get('status/{topic}',[App\Http\Controllers\backend\TopicController::class,'status'])->name('topic.status');
        Route::get('edit/{topic}',[App\Http\Controllers\backend\TopicController::class,'edit'])->name('topic.edit');
        Route::get('show/{topic}',[App\Http\Controllers\backend\TopicController::class,'show'])->name('topic.show');
        Route::get('trash',[App\Http\Controllers\backend\TopicController::class,'trash'])->name('topic.trash');
        Route::get('delete/{topic}',[App\Http\Controllers\backend\TopicController::class,'delete'])->name('topic.delete');
        Route::get('restore/{topic}',[App\Http\Controllers\backend\TopicController::class,'restore'])->name('topic.restore');
    });
    Route::resource('topic',App\Http\Controllers\backend\TopicController::class);
    // admin/user
    Route::prefix('user')->group(function(){
        Route::get('status/{user}',[App\Http\Controllers\backend\UserController::class,'status'])->name('user.status');
        Route::get('edit/{user}',[App\Http\Controllers\backend\UserController::class,'edit'])->name('user.edit');
        Route::get('show/{user}',[App\Http\Controllers\backend\UserController::class,'show'])->name('user.show');
        Route::get('trash',[App\Http\Controllers\backend\UserController::class,'trash'])->name('user.trash');
        Route::get('delete/{user}',[App\Http\Controllers\backend\UserController::class,'delete'])->name('user.delete');
        Route::get('restore/{user}',[App\Http\Controllers\backend\UserController::class,'restore'])->name('user.restore');
    });
    Route::resource('user',App\Http\Controllers\backend\UserController::class);
});

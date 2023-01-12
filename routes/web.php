<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Role\RolePermissionController;
use App\Http\Controllers\User\UserController;
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

Route::get('artisan_db', function () {

    // \Artisan::call('migrate:fresh --seed');
    // \Artisan::call('optimize:clear');

    dd("done");
});
Route::get('artisan_clear', function () {
    \Artisan::call('optimize:clear');
    dd("done");
});

define('page_numbering_back', "10");
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login',             [LoginController::class, 'index'])->name('auth.login');
        Route::post('login',            [LoginController::class, 'authenticate'])->name('auth.authenticate');
        Route::get('logout',            [LoginController::class, 'logout'])->name('auth.logout');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/',                                 [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('users',                        UserController::class);
        Route::resource('categories',                   CategoryController::class);
        Route::resource('pages',                        PageController::class);
        Route::get('pages-active',                      [PageController::class, 'updateActive'])->name('pages.active');
        Route::resource('posts',                        PostController::class);
        Route::get('posts-active',                      [PostController::class, 'updateActive'])->name('posts.active');


        Route::resource('roles',                        RoleController::class);
        Route::put('roles/{role}/permissions',          [RolePermissionController::class, 'update'])->name('RolePermission.update');

        Route::resource('contacts',                     ContactController::class);

    });


    Route::get('/',                                 [FrontController::class, 'index'])->name('front.index');
    Route::get('/{slug}',                           [FrontController::class, 'show'])->name('post.show');
    Route::get('/page/{slug}',                      [FrontController::class, 'showPage'])->name('showPage.show');

    // Route::get('/', function () {
    //     return view('front.index');
    // });
});

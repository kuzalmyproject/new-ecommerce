<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;


use App\Http\Controllers\frontend\IndexController;




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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');

 /*****************************Admin Related All Route*************************/

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');


/*****************************user profile and change the password***********************/

Route::prefix('profile')->group(function(){

    Route::get('/home',[AdminProfileController::class, 'Home'])->name('admin.home');

    Route::get('/view',[AdminProfileController::class, 'ProfileView'])->name('admin.profile.view');

    Route::get('/edit',[AdminProfileController::class, 'ProfileEdit'])->name('admin.profile.edit');

    Route::post('/store',[AdminProfileController::class, 'ProfileStore'])->name('admin.profile.store');

    Route::get('/password/view',[AdminProfileController::class, 'PasswordView'])->name('admin.password.view');

    Route::post('/password/update',[AdminProfileController::class, 'PasswordUpdate'])->name('admin.password.update');

});//end of the profile controller group


Route::prefix('brand')->group(function(){

    Route::get('/view',[BrandController::class, 'BrandView'])->name('brand.view');
    Route::post('/store',[BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update',[BrandController::class, 'BrandUpdate'])->name('brand.update');

    Route::get('/delete/{id}',[BrandController::class, 'BrandDelete'])->name('brand.delete');

    

});

Route::prefix('category')->group(function(){
    Route::get('/view',[CategoryController::class, 'CategoryView'])->name('category.view');
    Route::post('/store',[CategoryController::class, 'CategoryStore'])->name('category.store');



});


});//end of the middleware

/*****************************User Related All Route List*************************/

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');


Route::get('/',[IndexController::class,'index']);

Route::prefix('user')->group(function(){

    Route::get('/logout',[IndexController::class,'UserLogout'])->name('user.logout');


    Route::get('/profile',[IndexController::class,'UserProfile'])->name('user.profile');
    
    
    
    Route::post('/profile/update',[IndexController::class,'UserProfileUpdate'])->name('user.profile.update');
    
    Route::get('/change/password',[IndexController::class,'UserPassword'])->name('user.password');
    Route::post('/password/update',[IndexController::class,'UserPasswordChange'])->name('user.password.change');

    

});


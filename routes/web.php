<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\SubSubCategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SliderController;


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
    Route::get('/edit/{id}',[CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update',[CategoryController::class, 'CategoryUpdate'])->name('category.update');

    Route::get('/delete/{id}',[CategoryController::class, 'CategoryDelete'])->name('category.delete');



});

Route::prefix('subcategory')->group(function(){
    Route::get('/view',[SubCategoryController::class, 'SubCategoryView'])->name('subcategory.view');
    Route::post('/store',[SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/edit/{id}',[SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/update',[SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

    Route::get('/delete/{id}',[SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');



});

Route::get('/sub/sub/view',[SubSubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

  Route::get('/category/subcategory/ajax/{category_id}',[SubSubCategoryController::class, 'SubCategoryLoad']);

  Route::get('/category/sub-subcategory/ajax/{subcategory_id}',[SubSubCategoryController::class, 'SubSubCategoryLoad']);

  Route::post('/sub/sub/store',[SubSubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

  Route::get('/sub/sub/edit/{id}',[SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

  Route::post('/sub/sub/update',[SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

  Route::get('/sub/sub/delete/{id}',[SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');


  Route::prefix('product')->group(function(){

    Route::get('/add',[ProductController::class, 'ProductAdd'])->name('product.add');
  
    Route::post('/store',[ProductController::class, 'ProductStore'])->name('product.store');
  
    Route::get('/manage',[ProductController::class, 'ManageProduct'])->name('manage.product');
  
    Route::get('/edit/{id}',[ProductController::class, 'ProductEdit'])->name('product.edit');
  
    Route::post('/update',[ProductController::class, 'ProductUpdate'])->name('product.update');
  
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update.product.image');
  
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update.product.thambnail');
  
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
  
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
  
     Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
  
     Route::get('/display/{id}',[ProductController::class, 'ProductDisplay'])->name('product.display');
  
    Route::get('/delete/{id}',[ProductController::class, 'ProductDelete'])->name('product.delete');
  
  });


  Route::prefix('slider')->group(function(){

    Route::get('/view',[SliderController::class, 'SliderView'])->name('manage.slider');
    Route::post('/store',[SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/inactivate/{id}',[SliderController::class, 'SliderInactivate'])->name('slider.inactivate');
    Route::get('/activate/{id}',[SliderController::class, 'Slideractivate'])->name('slider.activate');

    Route::get('/delete/{id}',[SliderController::class, 'SliderDelete'])->name('slider.delete');

    Route::get('/edit/{id}',[SliderController::class, 'SliderEdit'])->name('slider.edit');
    Route::post('/update',[SliderController::class, 'SliderUpdate'])->name('slider.update');


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
<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    //home login
    Route::match(['get','post'],'/login','AdminAuthController@index');

    Route::group(['middleware' => 'admin'],function(){
        //admin page 
        Route::get('home','AdminHomeController@index');
        //admin setting 
        Route::get('settings','AdminHomeController@setting');
        //check current_password with ajax 
        Route::post('check-current-password','AdminHomeController@checkPassword');
        //update admin password 
        Route::post('update-password','AdminHomeController@updatePassword');
        //update admin details
        Route::match(['get','post'],'/update-admin-details','AdminHomeController@updateAdminDetails');

        //admin section 
        Route::get('sections','AdminSectionController@section');
        //update section status with ajax
        Route::post('update-section-status','AdminSectionController@updateSectionStatus');

        //admin categories 
        Route::get('categories','AdminCategoryController@category');
        //update section status with ajax
        Route::post('update-category-status','AdminCategoryController@updateCategoryStatus');
        //add edit category
        Route::match(['get','post'],'add-edit-category/{id?}','AdminCategoryController@addEditCategory');
        //append-categories-level
        Route::get('append-categories-level','AdminCategoryController@appendCategory');
        //category images delete
        Route::get('delete-category-image/{id}','AdminCategoryController@categoryImageDelete');
        //delete category
        Route::get('delete-category/{id}','AdminCategoryController@deleteCategory');

        //admin categories 
        Route::get('products','AdminProductController@product');
        //update product status with ajax
        Route::post('update-product-status','AdminProductController@updateProductStatus');
        //add edit product
        Route::match(['get','post'],'add-edit-product/{id?}','AdminProductController@addEditProduct');
        //category images delete
        Route::get('delete-product-image/{id}','AdminProductController@productImageDelete');
        //category images delete
        Route::get('delete-product-video/{id}','AdminProductController@productVideoDelete');
        //add edit product attribute
        Route::match(['get','post'],'add-edit-product-attribute/{id?}','AdminProductController@addEditProductAttribute');


        Route::get('logout','AdminAuthController@logout');
    });    
});
Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/',function(){
        return view('front.layouts.master');
    });
});



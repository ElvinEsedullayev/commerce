<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;


Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

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
        //update attribute
        Route::post('attribute-edit/{id}','AdminProductController@updateAttribute');
        //update attribute status with ajax
        Route::post('update-attribute-status','AdminProductController@updateAttributeStatus');
        //attribute delete
        Route::get('delete-attribute/{id}','AdminProductController@attributeDelete');
        //add edit product attribute
        Route::match(['get','post'],'add-edit-product-images/{id?}','AdminProductController@addEditProductImages');
        //update images status with ajax
        Route::post('update-image-status','AdminProductController@updateImageStatus');
        //image delete
        Route::get('delete-image/{id}','AdminProductController@imageDelete');


        //admin brands 
        Route::get('brands','AdminBrandController@brand');
        //update brand status with ajax
        Route::post('update-brand-status','AdminBrandController@updateBrandStatus');
        //add edit brand
        Route::match(['get','post'],'add-edit-brand/{id?}','AdminBrandController@addEditBrand');
        //brand delete
        Route::get('delete-brand/{id}','AdminBrandController@brandDelete');
        
        //banners
        Route::get('banners','AdminBannerController@banner');
        ############# Update banner status ############
        Route::post('update-banner-status','AdminBannerController@updateBannerStatus');
        //delete banner
        Route::get('delete-banner/{id}','AdminBannerController@deleteBanner');
        //add edit banner
        Route::match(['get','post'],'add-edit-banner/{id?}','AdminBannerController@addEditBanner');
        

        Route::get('logout','AdminAuthController@logout');
    });    
});


Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/','FrontHomeController@home');
    //get category url
    $catUrl = Category::select('url')->where('status',1)->get()->pluck('url')->toArray(); 
    //dd($catUrl);
    foreach($catUrl as $url){
        Route::get('/'.$url,'FrontProductController@listing');
    }
    Route::get('/product/{id}','FrontProductController@detail');
    //listing page
    //Route::get('/{url}','FrontProductController@listing');

    //get product price
    Route::post('/get-product-price','FrontProductController@productPrice');

    //add to cart
    Route::post('/add-to-cart','FrontProductController@addToCart');
    //get cart page
    Route::get('/cart','FrontProductController@cart');
    //update cart item qty
    Route::post('update-cart-item-qty','FrontProductController@cartItemUpdateQty');
    //delete cart item qty
    Route::post('delete-cart-item','FrontProductController@cartItemDelete');

    //login-register page
    Route::get('/login-register','FrontUserController@login_register');
    //login 
    Route::post('/login','FrontUserController@userLogin');
    //register
    Route::post('/register','FrontUserController@registerUser');
    //logout
    Route::get('/logout','FrontUserController@userLogout');
    //check email
    Route::match(['get', 'post'], 'check-email', 'FrontUserController@checkEmail');
    //account
    Route::match(['get','post'],'account','FrontUserController@account');
});



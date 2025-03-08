<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiBlogCategoryController;
use App\Http\Controllers\API\ApiBlogCommentController;
use App\Http\Controllers\API\ApiBlogPostController;
use App\Http\Controllers\API\ApiBrandController;
use App\Http\Controllers\API\ApiCategoryController;
use App\Http\Controllers\API\ApiComboProductController;
use App\Http\Controllers\API\ApiContactUsController;
use App\Http\Controllers\API\ApiHomeBannerController;
use App\Http\Controllers\API\ApiOfferBannerController;
use App\Http\Controllers\API\ApiOrderController;
use App\Http\Controllers\API\ApiProductPromotionController;
use App\Http\Controllers\API\ApiSubscribeController;
use App\Http\Controllers\API\ApiTagNameController;
use App\Http\Controllers\API\ApiProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiWishListController;
use App\Http\Controllers\API\ApiUserManageController;
// Open Routes
Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);
// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->noContent();
// });
// Protected Routes
Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get("/profile", [AuthController::class, "profile"]);
    Route::get("/logout", [AuthController::class, "logout"]);

    Route::put("user/details/{id}",[ApiUserManageController::class, 'update']);
});



Route::controller(ApiUserManageController::class)->group(function(){
   Route::post('/user/details/create', 'UserDetailsStore')->name('userDetails.Store');
});
Route::controller(ApiCategoryController::class)->group(function () {
    Route::get('/category', 'view')->name('category.view');
    Route::get('/category/{id}', 'show')->name('category.show');
});
Route::controller(ApiTagNameController::class)->group(function () {
    Route::get('/tagname', 'viewAll')->name('tagname.view');
    Route::get('/tagname/{id}', 'show')->name('tagname.show');
});

Route::controller(ApiProductController::class)->group(function () {
    Route::get('/product', 'viewAll')->name('product.view');
    Route::get('/product/{id}', 'show')->name('product.show');
    Route::post('/product/search', 'search');
    Route::post('/product/filter', 'filter');
});






Route::controller(ApiComboProductController::class)->group(function () {
    Route::get('/comboProduct', 'view')->name('comboProduct.view');
    Route::get('/comboProduct/{id}', 'show')->name('comboProduct.show');
});

Route::controller(ApiBrandController::class)->group(function () {
    Route::get('/brand', 'view')->name('brand.view');
    Route::get('/brand/{id}', 'showIndividual')->name('brand.show');
});

Route::controller(ApiProductPromotionController::class)->group(function () {
    Route::get('/productPromotion', 'view')->name('productPromotion.view');
    Route::get('/productPromotion/{id}', 'show')->name('productPromotion.show');
});

// Route::controller(HomeBannerController::class)->group(function () {
//     Route::get('/homeBanner', 'viewAll')->name('homeBanner.view');
//     Route::get('/homeBanner/{id}', 'show')->name('homeBanner.show');
// });

Route::controller(ApiHomeBannerController::class)->group(function () {
    Route::get('/homeBanner', 'viewAll')->name('homeBanner.view');
    Route::get('/homeBanner/{id}', 'show')->name('homeBanner.show');
});
Route::controller(ApiOfferBannerController::class)->group(function () {
    Route::get('/offerBanner', 'viewAll')->name('offerBanner.view');
    Route::get('/offerBanner/{id}', 'show')->name('offerBanner.show');
});
Route::controller(ApiBlogCategoryController::class)->group(function () {
    Route::get('/blogCategory', 'viewAll')->name('blogCategory.view');
    Route::get('/blogCategory/{id}', 'show')->name('blogCategory.show');
});

Route::controller(ApiBlogPostController::class)->group(function () {
    Route::get('/blogPost', 'viewAll')->name('blogPost.view');
    Route::get('/blogPost/{id}', 'show')->name('blogPost.show');
});

Route::controller(ApiBlogCommentController::class)->group(function () {
    Route::get('/blogPost', 'viewAll')->name('blogPost.view');
    Route::get('/blogPost/{id}', 'show')->name('blogPost.show');
});

Route::controller(ApiOrderController::class)->group(function () {
    Route::post('/order/create', 'store')->name('order.store');
    Route::get('/order/{id}', 'show')->name('order.show');
});


Route::controller(ApiSubscribeController::class)->group(function () {
    Route::post('/subscribe/store', 'store');
});

Route::controller(ApiContactUsController::class)->group(function () {
    Route::post('/contact-us/save', 'contactSave');
});

Route::controller(ApiWishListController::class)->group(function () {
    Route::post('/wishlist/add', 'addWishList');
    Route::get('/wishlist/{user_id}','getWishList');
});

// Route::get('/product', [App\Http\Controllers\Backend\ProductController::class, 'index']);

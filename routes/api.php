<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeBannerController;
use App\Http\Controllers\Backend\OfferBannerController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\BlogCommentController;

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TagNameController;
use App\Http\Controllers\Backend\ProductPromotionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Backend\comboProductController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\SubscribeController;
use App\Http\Controllers\API\ApiProductController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

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
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'view')->name('category.view');
    Route::get('/category/{id}', 'show')->name('category.show');
});
Route::controller(TagNameController::class)->group(function () {
    Route::get('/tagname', 'viewAll')->name('tagname.view');
    Route::get('/tagname/{id}', 'show')->name('tagname.show');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'viewAll')->name('product.view');
    Route::get('/product/{id}', 'show')->name('product.show');
 
});


Route::controller(ApiProductController::class)->group(function () {

    Route::post('/product/search', 'search');
    Route::post('/product/filter', 'filter');
});






Route::controller(comboProductController::class)->group(function () {
    Route::get('/comboProduct', 'view')->name('comboProduct.view');
    Route::get('/comboProduct/{id}', 'show')->name('comboProduct.show');
});

Route::controller(BrandController::class)->group(function () {
    Route::get('/brand', 'view')->name('brand.view');
    Route::get('/brand/{id}', 'showIndividual')->name('brand.show');
});

Route::controller(ProductPromotionController::class)->group(function () {
    Route::get('/productPromotion', 'view')->name('productPromotion.view');
    Route::get('/productPromotion/{id}', 'show')->name('productPromotion.show');
});

Route::controller(HomeBannerController::class)->group(function () {
    Route::get('/homeBanner', 'viewAll')->name('homeBanner.view');
    Route::get('/homeBanner/{id}', 'show')->name('homeBanner.show');
});

Route::controller(HomeBannerController::class)->group(function () {
    Route::get('/homeBanner', 'viewAll')->name('homeBanner.view');
    Route::get('/homeBanner/{id}', 'show')->name('homeBanner.show');
});
Route::controller(OfferBannerController::class)->group(function () {
    Route::get('/offerBanner', 'viewAll')->name('offerBanner.view');
    Route::get('/offerBanner/{id}', 'show')->name('offerBanner.show');
});
Route::controller(BlogCategoryController::class)->group(function () {
    Route::get('/blogCategory', 'viewAll')->name('blogCategory.view');
    Route::get('/blogCategory/{id}', 'show')->name('blogCategory.show');
});

Route::controller(BlogPostController::class)->group(function () {
    Route::get('/blogPost', 'viewAll')->name('blogPost.view');
    Route::get('/blogPost/{id}', 'show')->name('blogPost.show');
});

Route::controller(BlogCommentController::class)->group(function () {
    Route::get('/blogPost', 'viewAll')->name('blogPost.view');
    Route::get('/blogPost/{id}', 'show')->name('blogPost.show');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('/order/create', 'store')->name('order.store');
    Route::get('/order/{id}', 'show')->name('order.show');
});


Route::controller(SubscribeController::class)->group(function () {
    Route::post('/subscribe/store', 'store');
});

Route::controller(ContactUsController::class)->group(function () {
    Route::post('/contact-us/save', 'contactSave');
});

// Route::get('/product', [App\Http\Controllers\Backend\ProductController::class, 'index']);

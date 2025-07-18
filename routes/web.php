<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\SubSubcategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\GlobalCouponController;
use App\Http\Controllers\Backend\PopupMessageController;
use App\Http\Controllers\Backend\TagNameController;
use App\Http\Controllers\Backend\HomeBannerController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OfferBannerController;
use App\Http\Controllers\Backend\OrderManageController;
use App\Http\Controllers\Backend\StockManageController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\CompanyDetailsController;
use App\Http\Controllers\Backend\UserTrackerController;
use App\Http\Controllers\Backend\userController;
use App\Http\Controllers\Backend\comboProductController;
use App\Http\Controllers\AllMail;
use App\Http\Controllers\Backend\PurchaseDetailsController;
use App\Http\Controllers\Backend\historyController;
use App\Http\Controllers\Backend\MarketingController;
use App\Http\Controllers\Backend\ProductAttributeController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ComboController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductPromotionController;
use App\Http\Controllers\Backend\ProductStockManageController;
use App\Http\Controllers\Backend\DeliverOrderAssignController;
use App\Http\Controllers\Backend\FeatureController;
use App\Http\Controllers\Backend\CourierController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ConcernController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\TrashBinController;
use App\Http\Controllers\Backend\userProfileController;
use App\Http\Controllers\Backend\VariantController;

// Route::get('/home', function () {
//     return view('frontend.index');
// })->name('home');

Route::get('/admin/login', [AuthController::class, 'adminLoginPage']);
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('login');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('logout')->middleware('auth');
Route::get('/', [AuthController::class, 'dashboardView'])->middleware('auth')->name('admin.dashboard');

Route::controller(AllMail::class)->group(function () {
    Route::post('/reply/mail', 'replyMail')->name('reply.mail');
});
Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //All Routes for Category Start
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/view', 'view');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::post('/category/update', 'update')->name('category.update');
        Route::post('/category/delete', 'delete')->name('category.delete');
        Route::post('/category/status/change', 'CategoryStatus')->name('category.status');
        Route::get('/get/parent/category', 'GetParentCategory');
        //find Subcategory
        Route::get('/find/subcategory/{id}', 'findSubcat')->name('subcategory.find');
        Route::post('/find/subcategories', 'findSubcategories');
        //find SubSubcategory
        Route::get('/find/sub-subcategory/{id}', 'findSubSubcat')->name('sub.subcategory.find');
    });
    Route::controller(historyController::class)->group(function () {
        Route::get('/current-history/{value}', 'CurrentHistory');
        Route::get('order/chart', 'OrderChart')->name('order.chart.data');
        Route::get('stock/category/chart', 'categoryStockChart')->name('chart.category.stock');
        Route::get('monthly/chart/data', 'monthlyChartData')->name('monthly.chart.data');
    });
    // Marketing for SMS Marketing Routes
    Route::controller(MarketingController::class)->group(function () {
        Route::get('/sms/page', 'index')->name('sms.page');
        Route::post('/sms/send', 'sendSMS')->name('sms.send');
    });
    Route::controller(userController::class)->group(function () {
        Route::get('/all-user', 'allUser')->name('all.users');
        Route::get('/admin/disable-user/{user_id}', 'DisableUser')->name('admin.disable-user');
        Route::get('/admin/enable-user/{user_id}', 'EnableUser')->name('admin.enable-user');
    });






    //All Routes for Category End

    //All Routes for Subcategory Start
    Route::controller(SubcategoryController::class)->group(function () {
        Route::get('/subcategory', 'index')->name('subcategory');
        Route::post('/subcategory/store', 'store')->name('subcategory.store');
        Route::get('/subcategory/view', 'view')->name('subcategory.view');
        Route::get('/subcategory/edit/{id}', 'edit')->name('subcategory.edit');
        Route::post('/subcategory/update/{id}', 'update')->name('subcategory.update');
        Route::get('/subcategory/delete/{id}', 'delete')->name('subcategory.delete');
        // Route::get('/find/subcategory/{id}', 'findSubcat')->name('subcategory.find');
    });
    //All Routes for Subcategory End

    //All Routes for brand Start
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand', 'index')->name('brand');
        Route::post('/brand/store', 'store')->name('brand.store');
        Route::get('/brand/view', 'show')->name('brand.view');
        Route::get('/brand/edit/{id}', 'edit')->name('brand.edit');
        Route::post('/brand/update/{id}', 'update')->name('brand.update');
        Route::get('/brand/delete/{id}', 'destroy')->name('brand.delete');
        Route::post('/brand/status/{id}', 'status')->name('brand.status');
    });
    //All Routes for brand End


    //All Routes for Popup Message Start
    Route::controller(PopupMessageController::class)->group(function () {
        Route::get('/popupMessage', 'index')->name('popupMessage');
        Route::post('/popupMessage/store', 'store')->name('popupMessage.store');
        Route::get('/popupMessage/view', 'view')->name('popupMessage.view');
        Route::get('/popupMessage/edit/{id}', 'edit')->name('popupMessage.edit');
        Route::post('/popupMessage/update/{id}', 'update')->name('popupMessage.update');
        Route::get('/popupMessage/delete/{id}', 'delete')->name('popupMessage.delete');
    });
    //All Routes for Popup Message End


    //All Routes for Tag name Start
    Route::controller(TagNameController::class)->group(function () {
        Route::get('/tagname', 'index')->name('tagname');
        Route::post('/tagname/store', 'store')->name('tagname.store');
        Route::post('/tagname/create', 'create');
        Route::get('/tagname/view', 'view')->name('tagname.view');
        Route::get('/tagname/show', 'show');
        Route::get('/tagname/edit/{id}', 'edit')->name('tagname.edit');
        Route::post('/tagname/update/{id}', 'update')->name('tagname.update');
        Route::get('/tagname/delete/{id}', 'delete')->name('tagname.delete');
        Route::post('/tagname/status/{id}', 'status')->name('tagname.status');
    });
    //All Routes for Tag name End


    //All Routes for Concerns
    Route::controller(ConcernController::class)->group(function () {
        Route::get('/concern', 'index')->name('concern');
        Route::post('/concern/store', 'store')->name('concern.store');
        Route::get('/concern/view', 'view')->name('concern.view');
        Route::get('/concern/edit/{id}', 'edit')->name('concern.edit');
        Route::post('/concern/update/{id}', 'update')->name('concern.update');
        Route::get('/concern/delete/{id}', 'delete')->name('concern.delete');
        Route::post('/concern/status/{id}', 'status')->name('concern.status');
    });
    //All Routes for Tag name End


    //All Routes for Home Banner Start
    Route::controller(HomeBannerController::class)->group(function () {
        Route::get('/banner', 'index')->name('banner');
        Route::post('/banner/store', 'store')->name('banner.store');
        Route::get('/banner/view', 'view')->name('banner.view');
        Route::get('/banner/edit/{id}', 'edit')->name('banner.edit');
        Route::post('/banner/update/{id}', 'update')->name('banner.update');
        Route::get('/banner/delete/{id}', 'delete')->name('banner.delete');
        Route::post('/banner/status/{id}', 'bannerStatus')->name('banner.status');
    });
    //All Routes for Home Banner End
    Route::controller(ProductAttributeController::class)->group(function () {
        Route::post('/store/extra/datatype/field', 'store')->name('product.attribute.store');
        Route::get('/get/extra/info/field/{id}', 'getExtraField')->name('product.attribute.get.extra.info.field');
        Route::get('get-extra-field/info/product/page/show', 'getExtraFieldInfoProductPageShow')->name('get.extra.field.info.product.page.show');
    });
    //All Routes for Offer Banner Start
    Route::controller(OfferBannerController::class)->group(function () {
        Route::get('/offerbanner', 'index')->name('offerbanner');
        Route::post('/offerbanner/store', 'store')->name('offerbanner.store');
        Route::get('/offerbanner/view', 'view')->name('offerbanner.view');
        Route::get('/offerbanner/edit/{id}', 'edit')->name('offerbanner.edit');
        Route::post('/offerbanner/update/{id}', 'update')->name('offerbanner.update');
        Route::get('/offerbanner/delete/{id}', 'delete')->name('offerbanner.delete');
        Route::post('/offerbanner/status/{id}', 'statusUpdate')->name('offerbanner.status');

        Route::post('/offerbanner/delete-image/{id}', 'deleteImage')->name('offerBanerimage.delete');
    });
    //All Routes for Offer Banner End

    //All Routes for Offer Banner Start
    Route::controller(ComboController::class)->group(function () {
        Route::get('/combo', 'index')->name('combo.index');
        Route::post('/combo/store', 'store');
        Route::get('/combo/view', 'view');
        Route::get('/combo/view/{id}', 'viewDeatils');
        Route::post('/combo/update', 'update');
        Route::post('/combo/delete', 'delete');
        Route::post('/combo/status/change', 'StatusChange');
        Route::post(' /combo/delete-image/', 'comboDeleteImage');

        // Route::post('/offerbanner/update/{id}', 'update')->name('offerbanner.update');
        // Route::get('/offerbanner/delete/{id}', 'delete')->name('offerbanner.delete');
        // Route::post('/offerbanner/status/{id}', 'statusUpdate')->name('offerbanner.status');
    });
    //All Routes for Offer Banner End

    //All Routes for Product Start
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product');
        Route::post('/product/store', 'store')->name('product.store');
        Route::post('/product/update', 'update')->name('product.update');
        Route::get('/product/view', 'view')->name('product.view');
        Route::get('/product/view/{id}', 'viewDetails')->name('product.view.details');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::get('/product/delete/{id}', 'delete')->name('product.delete');
        Route::post('/product/status/{id}', 'productStatus')->name('product.status');
        Route::get('/find/variant/{id}', 'findVariant')->name('find.variant');
        Route::get('/product/get_variant_data', 'getVariant_product_id');
        Route::post('/product/variant/store', 'variantProductStore');
        Route::post('/product/variant/update', 'ProductvariantUpdate');
        Route::post('/product/variant/image/delete', 'variantImageDelete');
        Route::post('/product/variant/delete', 'variantDelete');
    });
    //All Routes for Product End


    //product stock manage start

    Route::controller(ProductStockManageController::class)->group(function () {
        Route::get('/product/stock/manage', 'index')->name('product.stock.manage');
        //get variant
        Route::get('get/stock/product/variant/{id}', 'getVariant');
        Route::get(' variant/stock/product/row/{id}', 'getVariantRow');
        Route::post('update/multiple/stock', 'updateMultipleStock');
        Route::get('/stock/view', 'view')->name('stock.view');
    });

    //all routes for combo product

    Route::controller(comboProductController::class)->group(function () {
        Route::get('/combo/product', 'index')->name('combo.product.index');
        Route::post('/combo/product/store', 'store')->name('combo.product.store');
        Route::get('/combo/product/view', 'view')->name('combo.product.view');
        Route::get('/combo/product/edit/{id}', 'edit')->name('combo.product.edit');
        Route::post('/combo/product/update', 'update')->name('combo.product.update');
        Route::post('/combo/product/delete/', 'delete')->name('combo.product.delete');
        Route::post('/combo/product/change/status', 'statusUpdate')->name('combo.product.status');
        Route::get('/get/product/and/combo', 'product_and_combo');
    });

    //coupon controll Route

    Route::controller(CouponController::class)->group(function () {
        Route::get('/coupon', 'index')->name('Coupon.index');
        Route::post('/coupon/store', 'store')->name('coupon.store');
        Route::get('/coupon/view', 'view')->name('coupon.view');
        Route::get('/coupon/edit/{id}', 'edit')->name('coupon.edit');
        Route::post('/coupon/update', 'update')->name('coupon.update');
        Route::post('/coupon/delete', 'delete')->name('coupon.delete');
        Route::post('/coupon/status/{id}', 'statusUpdate')->name('coupon.status');
    });


    //product promotion start

    Route::controller(ProductPromotionController::class)->group(function () {

        Route::get('/product/promotion', 'index')->name('product.promotion.index');
        Route::get('/product/promotion/create', 'create')->name('product.promotion.create');

        Route::post('/promotion/product/store', 'store')->name('promotion.store');
        Route::post('product/promotion/add/variant', 'productPromotionVariantShow')->name('product.promotion.add.variant');
        Route::post('promotion/update', 'update')->name('promotion.update');
        Route::post('/promotion/product/delete/', 'delete')->name('promotion.delete');

        Route::post('product/promotion/add/category', 'productPromotionCategoryShow')->name('product.promotion.add.category');

        Route::post('product/promotion/add/brand', 'productPromotionBrandShow')->name('product.promotion.add.brand');




        Route::get('admin/product/promotion/edit/{id}', 'edit')->name('admin.product.promotion.edit');
        Route::post('/product/promotion/variant/delete/', 'variantDelete')->name('promotion.variant.delete');
        Route::post('promotion/delete', 'Promotiondelete')->name('product.promotion.delete');
        Route::get('product/promotion/view/{promotion_id}', 'PromotionView')->name('product.promotion.view');

        Route::post('/product/promotion/status/{id}', 'statusUpdate')->name('product.promotion.status');
        Route::get('/get/product/and/promotion', 'getProductPromotion');
        Route::post('/get/product/variant', 'getProductPromotionVariant');
    });



    Route::controller(FeatureController::class)->group(function () {
        Route::get('/product/feature', 'index')->name('product.feature.index');
        Route::post('/feature/store', 'store')->name('feature.store');
        Route::get('/feature/view', 'view')->name('feature.view');
        Route::get('/feature/edit/{id}', 'edit')->name('feature.edit');
        Route::post('/feature/update/{id}', 'update')->name('feature.update');
        Route::get('/feature/delete/{id}', 'delete')->name('feature.delete');
        Route::post('/feature/status/{id}', 'statusUpdate')->name('feature.status');
    });



    Route::controller(CourierController::class)->group(function () {
        Route::get('steadFast/courier', 'steadfast')->name('Courier.steadfast');
        Route::post('steadFast/courier/store', 'steadfastSend')->name('steadfast.send');
        Route::get('Courier/Manage/steadfast/order', 'All')->name('Courier.Manage.steadfast.order');
    });

    //All Routes for Global Coupons Start
    Route::controller(GlobalCouponController::class)->group(function () {
        Route::get('/global-coupon', 'index')->name('global.coupon');
        Route::post('/global-coupon/store', 'store')->name('global.store');
    });
    //All Routes for Global Coupons End

    //All Routes for Order  Start
    Route::controller(OrderManageController::class)->group(function () {
        Route::get('/new-order', 'index')->name('new.order');

        Route::get('/admin-approve-order/{id}', 'adminApprove')->name('admin.approve.order');
        Route::get('/admin-denied-order/{invoiceNumber}', 'adminDenied')->name('admin.denied.order');
        Route::get('/order/denied', 'deniedOrders')->name('order.denied');


        Route::get('/order/confirmed', 'approvedOrders')->name('order.confirmed');

        Route::get('/order/admin-process-order/{invoiceNumber}', 'orderProcessing')->name('admin.process.order');
        Route::get('/order/processed', 'processedOrders')->name('order.processed');

        Route::get('/order/admin-delivery-order/{invoiceNumber}', 'orderDelivering')->name('admin.delivery.order');
        Route::get('/order/delivering', 'deliveringOrders')->name('order.delivering');

        Route::get('/order/admin-completed-order/{invoiceNumber}', 'orderCompleted')->name('admin.completed.order');
        Route::get('/order/completed', 'completedOrders')->name('order.completed');

        Route::get('/order/admin-refunded-order/{invoiceNumber}', 'orderRefunded')->name('admin.refunded.order');
        Route::get('/order/refunding-orders', 'refundOrders')->name('order.refunding');

        Route::get('/order/refunded-orders', 'refundedOrders')->name('order.refunded');

        Route::get('/order/canceled-orders', 'canceledOrders')->name('order.canceled');
        Route::post('/order/send-sms', 'SendSMS')->name('send.sms');

        Route::post('admin/order/get-order-details', 'getOrderDetails')->name('get.order.details');

        Route::get('/order/detailed-orders/{order_id}', 'DetailOrders')->name('order.details');
        Route::get('/custom/order/create', 'customOrderCreate')->name('custom.order.create');
        Route::get('get/variant/custom/order_info/{id}', 'getVariantCustomOrderInfo')->name('get.variant.custom.order.info');
        Route::post('get/custom/user/details', 'getCustomUserDetails')->name('get.user.data');
        Route::post('create/custom/user/address', 'createCustomUserAddress')->name('create.custom.order.customer');
        Route::post('create/custom/order', 'createCustomOrder')->name('custom.order.store');
        Route::get('get/combo/custom/order/{id}', 'getComboCustom')->name('get.custom.combo.product.order');
        // Route::post('/order/send-sms', 'SendSMS')->name('send.sms');


        // Route::get('/admin-cancel-order/{invoiceNumber}', 'adminCancel')->name('admin.cancel.order');

    });

    //All Routes for Order End

    //deliver order assign start

    Route::controller(DeliverOrderAssignController::class)->group(function () {
        Route::post('admin/order/assign-deliver', 'assignDeliver')->name('admin.order.assign.deliver');
        Route::get('admin/shipping/order/change/transit/{id}', 'shippingChangeTransit')->name('admin.shipping.order.change.transit');
        Route::get('order/delivered/transit', 'TransitOrder')->name('order.transit');
        Route::get('admin/transit/order/change/completed/{id}', 'TransitChangeCompleted')->name('admin.transit.order.change.completed');
        Route::get('order/delivered', 'Delivered')->name('order.delivered');
    });

    /////////////////////////////Product Size Add///////////////////////////
    Route::controller(SizeController::class)->group(function () {
        Route::get('/size/view', 'SizeView')->name('size.view');
        Route::post('/size/store', 'SizeStore')->name('admin.products.addSize');
        Route::get('/size/edit/{id}', 'SizeEdit')->name('size.edit');
        Route::post('/size/update', 'SizeUpdate')->name('admin.products.updateSize');
        Route::post('/size/delete', 'SizeDelete')->name('admin.products.deleteSize');
        Route::get('admin/products/getSize', 'SizeGet')->name('admin.products.getSize');
    });


    /////////////////////////////Product Color Add///////////////////////////

    Route::controller(ColorController::class)->group(function () {
        Route::get('/color/view', 'ColorView')->name('color.view');
        Route::get('/color/get', 'ColorGet')->name('admin.products.getColor');
        Route::post('/color/store', 'ColorStore')->name('admin.products.addColor');
        Route::get('/color/edit/{id}', 'ColorEdit')->name('color.edit');
        Route::post('/color/update', 'ColorUpdate')->name('admin.products.updateColor');
        Route::post('/color/delete', 'ColorDelete')->name('admin.products.deleteColor');
    });




    //All Routes for Stock Management End

    //All Routes for Contact us
    Route::controller(ContactUsController::class)->group(function () {
        Route::get('/contact-message/show', 'show')->name('contact-message.show');
        Route::get('/contact-message/delete', 'destroy')->name('contact-message.delete');
    });
    //All Routes for Contact us

    //All Route for Blog Category
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('/blog/category/view', 'AddBlogCategory')->name('blog.category.view');
        Route::post('/blog/store/category', 'StoreBlogCategory')->name('blog.category.store');
        Route::get('/blog/all/category/view', 'BlogAllCategoryView')->name('blog.all.category.view');
        Route::get('/blog/category/edit/{id}', 'EditBlogCategory')->name('blog.category.edit');
        Route::post('/blog/category/update/{id}', 'UpdateBlogCategory')->name('blog.category.update');
        Route::get('/blog/category/delete/{id}', 'DeleteBlogCategory')->name('blog.category.delete');
    });
    //Blog Post All Route Start
    Route::controller(BlogPostController::class)->group(function () {
        Route::get('/blog/post/add', 'AddBlogPost')->name('blog.post.add.view');
        Route::post('/blog/post/store', 'StoreBlogPost')->name('blog.store');
        Route::get('/blog/post/all/view', 'allBlogPostView')->name('blog.all.post.view');
        Route::get('/blog/post/edit/{id}', 'BlogPostEdit')->name('blog.post.edit');
        Route::post('/blog/post/update/{id}', 'BlogPostupdate')->name('blog.post.update');
        Route::get('/blog/post/delete/{id}', 'BlogPostDelete')->name('blog.post.delete');
        Route::get('/blog/post/inactive/{id}', 'BlogActiveToInactive')->name('blog.post.inactive');
        Route::get('/blog/post/active/{id}', 'BlogInctiveToActive')->name('blog.post.active');
    });
    //Blog Post All Route End

    //All Routes for Sub Subcategory Start
    Route::controller(SubSubcategoryController::class)->group(function () {
        Route::get('/sub-subcategory', 'index')->name('sub.subcategory');
        Route::post('/sub-subcategory/store', 'store')->name('sub.subcategory.store');
        Route::get('/sub-subcategory/view', 'view')->name('sub.subcategory.view');
        Route::get('/sub-subcategory/edit/{id}', 'edit')->name('sub.subcategory.edit');
        Route::post('/sub-subcategory/update/{id}', 'update')->name('sub.subcategory.update');
        Route::get('/sub-subcategory/delete/{id}', 'delete')->name('sub.subcategory.delete');
        // Route::get('/find/sub-subcategory/{id}', 'findSubSubcat')->name('sub.subcategory.find');
    });
    //All Routes for Sub Subcategory End

    //Blog Comment All Route Start
    Route::controller(BlogCommentController::class)->group(function () {
        Route::get('/blog/all/pending/comment', 'BlogAllPendingComment')->name('blog.all.pending.comment');
        Route::get('/blog/all/approve/comment', 'BlogAllApproveComment')->name('blog.all.approved.comment');
        Route::get('/blog/pending/comment/approve/{id}', 'BlogCommentPendingToApprove')->name('blog.comment.approve');
        Route::get('/blog/approve/comment/pending/{id}', 'BlogCommentApproveToPending')->name('comment.approve.cancel');
        Route::get('/blog/comment/delete/{id}', 'BlogCommentDelete')->name('comment.delete');
        //Reply Comment route

    });
    //Blog Comment All Route End

    //Company Details All Route Start
    Route::controller(CompanyDetailsController::class)->group(function () {
        Route::get('/company-details', 'index')->name('company-details');
        Route::post('/company-details/add', 'store')->name('company-details.store');
        Route::get('/company-details/view', 'view')->name('company-details.view');
        Route::get('/company-details/edit/{id}', 'edit')->name('company-details.edit');
        Route::post('/company-details/update/{id}', 'update')->name('company-details.update');
        Route::get('/company-details/delete/{id}', 'delete')->name('company-details.delete');
        Route::post('/company-details/status/{id}', 'status')->name('company-details.status');
    });
    //Company Details All Route End

    //Purchase Details All Route Start
    Route::controller(PurchaseDetailsController::class)->group(function () {
        Route::get('/purchase', 'index')->name('purchase');
        Route::post('/purchase/add', 'store')->name('purchase.store');
        Route::get('/purchase/view', 'view')->name('purchase.view');
        Route::get('/purchase/view/details/{id}', 'viewDetails')->name('purchase.view.details');
        Route::get('/purchase/edit/{id}', 'edit')->name('purchase.edit');
        Route::post('/purchase/update/{id}', 'update')->name('purchase.update');
        Route::get('/purchase/delete/{id}', 'delete')->name('purchase.delete');
        // Route::post('/purchase/status/{id}', 'status')->name('purchase.status');
    });
    //Purchase Details All Route End

    Route::controller(userProfileController::class)->group(function () {
        Route::get('/user/profile', 'index')->name('user.profile');
        Route::post('/user/profile', 'update')->name('user.password.update');
    });


    //Company Details All Route Start
    Route::controller(CompanyDetailsController::class)->group(function () {
        Route::get('/company-details', 'index')->name('company-details');
        Route::post('/company-details/add', 'store')->name('company-details.store');
        Route::get('/company-details/view', 'view')->name('company-details.view');
        Route::get('/company-details/edit/{id}', 'edit')->name('company-details.edit');
        Route::post('/company-details/update/{id}', 'update')->name('company-details.update');
        Route::get('/company-details/delete/{id}', 'delete')->name('company-details.delete');
        Route::post('/company-details/status/{id}', 'status')->name('company-details.status');
    });
    //Company Details All Route End
});

//All Routes for Global Coupons Start
Route::controller(GlobalCouponController::class)->group(function () {
    Route::get('/apply-coupon/{code}', 'applyCoupon')->name('apply.coupon');
});
//All Routes for Global Coupons End

//User Tracker Details All Route Start
Route::controller(UserTrackerController::class)->group(function () {
    Route::post('/user-tracker/user-count', 'store')->name('user.count');
    Route::get('/user-tracker/show', 'index')->name('user-tracker.show');
    // Route::post('/company-details/add', 'store')->name('company-details.store');
    // Route::get('/company-details/edit/{id}', 'edit')->name('company-details.edit');
    // Route::post('/company-details/update/{id}', 'update')->name('company-details.update');
    // Route::get('/company-details/delete/{id}', 'delete')->name('company-details.delete');
    // Route::post('/company-details/status/{id}', 'status')->name('company-details.status');
});


Route::controller(ReportController::class)->group(function () {
    Route::get('/report', 'index')->name('report');
    Route::get('/report/insert', 'insert')->name('report.insert');
    Route::post('/report/store', 'store')->name('report.store');
    Route::get('/report/edit/{id}', 'edit')->name('report.edit');
    Route::post('/report/update/{id}', 'update')->name('report.update');
    Route::patch('/report/status/{id}', 'status')->name('report.status');
    Route::get('/report/view-details/{id}', 'viewDetails')->name('report.view.details');
    Route::get('/report/delete/{id}', 'delete')->name('report.delete');
});

// Route::controller(VariantController::class)->group(function () {
//     Route::get('/check-mail-template/{id}', 'checkMail');
// });
Route::controller(SettingsController::class)->group(function () {
    Route::get('/settings', 'index')->name('settings');
    Route::post('/settings/store', 'store')->name('settings.store');
});
//User Tracker All Route End

Route::controller(TrashBinController::class)->group(function () {
    Route::get('/trash', 'index')->name('trash.index');
    Route::post('/trash/restore/{model}/{id}', 'restore')->name('trash.restore');
    Route::delete('/trash/force-delete/{model}/{id}', 'forceDelete')->name('trash.force-delete');
});

// require __DIR__ . '/auth.php';
// require __DIR__ . '/frontend.php';
Route::group([], base_path('routes/frontend.php'));
Route::get('/{any}', function () {
    return view('errors.404'); // or return view('welcome') if you are using welcome.blade.php
})->where('any', '.*');

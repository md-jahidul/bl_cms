<?php

//$serve = "mysql-5";
//$user = "root";
//$password = "root";
//$db = "bl_cms";
//try {
//    $con = mysqli_connect($serve, $user, $password, $db);
//
//    $query = ' Select id, referrer from cs_selfcare_referrers where code_type = "retailer" AND is_active = 1';
//    $result = $con->query($query);
//
//    foreach ($result as $value) {
//        $msisdn = substr($value->referrer->msisdn, -9);
//        $newCode = decoct($msisdn);
//        $updateQuery = "update cs_selfcare_referrers set referral_code = '$newCode' where id = value->id";
//        $con->query($updateQuery);
//    }
//}catch (PDOException $e){
//
//    echo $sql . "<br>" . $e->getMessage();
//}

/*
|--------------------------------------------------------------------------
| Web Routes for MY BL
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use App\Services\NewCampaignModality\MyBlCampaignWinnerSelectionService;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['appAdmin', 'authorize', 'auth', 'CheckFistLogin']], function () {

    //------ shortcuts -----------//

    // Route::resource('short_cuts','CMS\ShortCutController');
    // Route::resource('UserShortcut','CMS\UserShortcutController');

    //shortcuts
    Route::put('shortcuts/SerialUpdate/{id}', 'CMS\UserShortcutController@serialUpdate')->name('serial.update');
    Route::get('shortcuts/destroy/{id}', 'CMS\ShortCutController@destroy');

    Route::get('shortcuts', 'CMS\ShortCutController@index')->name('short_cuts.index');
    Route::post('shortcuts', 'CMS\ShortCutController@store')->name('short_cuts.store');
    Route::get('shortcuts/create', 'CMS\ShortCutController@create')->name('short_cuts.create');
    Route::get('shortcuts/{short_cut}/edit', 'CMS\ShortCutController@edit')->name('short_cuts.edit');
    Route::put('shortcuts/{short_cut}', 'CMS\ShortCutController@update')->name('short_cuts.update');
    Route::get('shortcuts-sortable', 'CMS\ShortCutController@shortcutSortable')->name('short_cuts.sort');

    Route::resource('generic-shortcut-master', 'CMS\GenericShortcutMasterController');
    Route::get('generic-shortcut-master/destroy/{id}', 'CMS\GenericShortcutMasterController@destroy');

    Route::get('generic-shortcut/{id}', 'CMS\GenericShortcutController@index')->name('generic-shortcut');
    Route::get('generic-shortcut/{id}/create', 'CMS\GenericShortcutController@create')->name('generic-shortcut.create');
    Route::post('generic-shortcut/store', 'CMS\GenericShortcutController@store')->name('generic-shortcut.store');
    Route::get('generic-shortcut/edit/{id}', 'CMS\GenericShortcutController@edit')->name('generic-shortcut.edit');
    Route::put('generic-shortcut/update/{id}', 'CMS\GenericShortcutController@update')->name('generic-shortcut.update');
    Route::get('generic-shortcut/delete/{id}', 'CMS\GenericShortcutController@delete')->name('generic-shortcut.delete');
    Route::get('generic-shortcut-update-position', 'CMS\GenericShortcutController@updatePosition');

    //------ shortcuts -----------//

    // Banner
    Route::resource('banner', 'CMS\BannerController');
    Route::get('banner/destroy/{id}', 'CMS\BannerController@destroy');

    // welcomeInfo
    Route::get('welcomeInfo', 'CMS\WelcomeInfoController@index')->name('welcomeInfo.index');
    Route::post('welcomeInfo', 'CMS\WelcomeInfoController@store')->name('welcomeInfo.store');
    Route::post('welcomeInfo/update/{id}', 'CMS\WelcomeInfoController@update')->name('welcomeInfo.update');

    //settings
    Route::resource('setting', 'CMS\SettingController');
    Route::get('setting_limit/store', 'CMS\SettingController@Addlimit');
    Route::get('setting/destroy/{id}', 'CMS\SettingController@destroy')->name('setting.destroy');

    // Logde a Complain
    Route::get('mybl/settings/lodge/complaints', 'CMS\SettingController@lodgeComplain')->name('lodge_complaints');
    Route::Post(
        'mybl/settings/lodge/complain/store',
        'CMS\SettingController@sotreLodgeComplain'
    )->name('store_lodge_complaints');


    //App Version
    Route::resource('app-version', 'CMS\AppVersionController');
    Route::get('app-version/destroy/{id}', 'CMS\AppVersionController@destroy');

    //OTP config
    Route::resource('otp-config', 'CMS\OtpController');
    Route::get('otp-config/destroy/{id}', 'CMS\OtpController@destroy');

    //------ Slider -----------//

    // Slider
    Route::resource('myblslider', 'CMS\MyblSliderController');

    Route::get('myblslider/{slider_id}/images', 'CMS\MyblSliderImageController@index')->name('myblslider.images.index');
    Route::get(
        'myblslider/{slider_id}/images/create',
        'CMS\MyblSliderImageController@create'
    )->name('myblslider.images.create');
    Route::post('myblslider/images/store', 'CMS\MyblSliderImageController@store')->name('myblslider.images.store');
    Route::get('myblslider/images/{id}/edit', 'CMS\MyblSliderImageController@edit')->name('myblslider.images.edit');
    Route::put(
        'myblslider/images/{id}/update',
        'CMS\MyblSliderImageController@update'
    )->name('myblslider.images.update');
    Route::put(
        'myblslider/images/{id}/update',
        'CMS\MyblSliderImageController@update'
    )->name('myblslider.images.update');
    Route::delete(
        'myblslider/images/{id}/delete',
        'CMS\MyblSliderImageController@destroy'
    )->name('myblslider.images.destroy');

    Route::get(
        'myblslider/images/get-active-products',
        'CMS\MyblSliderImageController@getMyblProducts'
    )->name('myblslider.active-products'); //getMyblProducts

    Route::get('myblslider/destroy/{id}', 'CMS\MyblSliderController@destroy');
    //Route::get('myblslider/edit/{slider-other-attr}','CMS\MyblSliderController@edit')->name('slider-other-attr.edit');
    // Slider

    // Slider Image
    /*Route::resource('myblsliderImage','CMS\MyblSliderImageController');*/
    Route::get('myblslider/{id}/images', 'CMS\MyblSliderImageController@index');
    Route::match(['GET', 'POST'],'myblsliderImage/addImage/update-position', 'CMS\MyblSliderImageController@updatePosition');
    Route::get('myblslider/addImage/{sliderId}', 'CMS\MyblSliderImageController@index')->name('myblsliderImage.index');
    // Slider Image

    // Base Msisdn
    Route::get('mybl-slider/base-msisdn-list', 'CMS\BaseMsisdnController@index')
        ->name('myblslider.baseMsisdnList.index');

    Route::get('mybl-slider/base-msisdn-list-table/{id}', 'CMS\BaseMsisdnController@getBaseMsisdn')
        ->name('myblslider.baseMsisdnList.table');

    Route::get('mybl-slider/base-msisdn-excel-export/{id}', 'CMS\BaseMsisdnController@msisdnExcelExport')
        ->name('myblslider.baseMsisdn.excel-export');

    Route::get('mybl-slider/base-msisdn-create', 'CMS\BaseMsisdnController@create')
        ->name('myblslider.base.msisdn.create');

    Route::post('mybl-slider/base-msisdn-store', 'CMS\BaseMsisdnController@store')
        ->name('myblslider.base.msisdn.store');

    Route::get('mybl-slider/base-msisdn-edit/{id}', 'CMS\BaseMsisdnController@edit')
        ->name('myblslider.base.msisdn.edit');

    Route::put('mybl-slider/base-msisdn-update/{id}', 'CMS\BaseMsisdnController@update')
        ->name('myblslider.base.msisdn.update');

    // minute
    Route::resource('minuteOffer', 'CMS\MinuteOfferController');
    Route::get('minuteOffer/destroy/{id}', 'CMS\MinuteOfferController@destroy');

    // sms offer
    Route::resource('smsOffer', 'CMS\SmsOfferController');
    Route::get('smsOffer/destroy/{id}', 'CMS\SmsOfferController@destroy');

    // internet
    Route::resource('internetOffer', 'CMS\InternetOfferController');
    Route::get('internetOffer/destroy/{id}', 'CMS\InternetOfferController@destroy');

    // Mixed Bundle
    Route::resource('mixedBundleOffer', 'CMS\MixedBundleOfferController');
    Route::get('mixedBundleOffer/destroy/{id}', 'CMS\MixedBundleOfferController@destroy');

    // Near By Offer
    Route::resource('nearByOffer', 'CMS\NearbyOfferController');
    Route::get('nearByOffer/destroy/{id}', 'CMS\NearbyOfferController@destroy');

    // Near By Offer
    Route::resource('nearByOffer', 'CMS\NearbyOfferController');
    Route::get('nearByOffer/destroy/{id}', 'CMS\NearbyOfferController@destroy');

    // Amar Offer
    Route::resource('amarOffer', 'CMS\AmarOfferController');
    Route::get('amarOffer/destroy/{id}', 'CMS\AmarOfferController@destroy');
    Route::get('amar-offer-incident-status-update', 'CMS\AmarOfferController@statusUpdate')
        ->name('amar-offer-incident.status.update');


    // mybl internet offer category
    Route::get('mybl-internet-offer-category', 'CMS\MyBlInternetOffersCategoryController@index')->name('mybl-internet-offer-category');
    Route::POST('mybl-internet-offer-category', 'CMS\MyBlInternetOffersCategoryController@saveSortFilter')->name('mybl-internet-offer-category.store');
    Route::get('mybl-internet-offer-category/create', 'CMS\MyBlInternetOffersCategoryController@create')->name('mybl.internetOffer.category.create');
    Route::get('mybl-internet-offer-category/edit/{id}', 'CMS\MyBlInternetOffersCategoryController@edit')->name('mybl.internetOffer.category.edit');
    Route::put('mybl-internet-offer-category/update/{id}', 'CMS\MyBlInternetOffersCategoryController@update')->name('mybl.internetOffer.category.update');
    Route::get('mybl-internet-offer-category/delete/{id}', 'CMS\MyBlInternetOffersCategoryController@destroy')->name('mybl.internetOffer.category.delete');

    // ussd code
    Route::resource('ussd', 'CMS\UssdController');
    Route::get('ussd/destroy/{id}', 'CMS\UssdController@destroy');

    // help center
    Route::resource('helpCenter', 'CMS\HelpCenterController');
    Route::get('helpCenter/destroy/{id}', 'CMS\HelpCenterController@destroy');
    Route::get('help_Center/update-position', 'CMS\HelpCenterController@changeSequece');

    // contextual cards
    Route::resource('contextualcard', 'CMS\ContextualCardController');
    Route::get('card/destroy/{id}', 'CMS\ContextualCardController@destroy');
    Route::resource('contextualcardicon', 'CMS\ContextualCardIconController');
    Route::get('contextualcard-icons', 'CMS\ContextualCardIconController@index')->name('contextualcard-icons.index');
    Route::get('contextualcard-icons/create', 'CMS\ContextualCardIconController@create')->name('contextual.card.icons.create');
    Route::POST('contextualcard-icons/store', 'CMS\ContextualCardIconController@store')->name('contextualcard.icons.store');
    Route::get('contextualcard-icons/edit/{id}', 'CMS\ContextualCardIconController@edit')->name('contextualcard.icons.edit');
    Route::PUT('contextualcard-icons/update/{id}', 'CMS\ContextualCardIconController@update')->name('contextualcard.icon.update');

    // Notification categorys
    Route::resource('notificationCategory', 'CMS\NotificationCategoryController');
    Route::get('notificationCategory/destroy/{id}', 'CMS\NotificationCategoryController@destroy');

    // Notification categorys V2
    Route::resource('notificationCategory-v2', 'CMS\NotificationV2\NotificationCategoryV2Controller');
    Route::get('notificationCategory-v2/destroy/{id}', 'CMS\NotificationV2\NotificationCategoryV2Controller@destroy');

    // Notification
    Route::resource('notification', 'CMS\NotificationController');
    Route::get('notification-duplicate/{notificationId}', 'CMS\NotificationController@duplicateNotification')->name('notification.duplicate');
    Route::get('quick-notification', 'CMS\NotificationController@quickNotificationIndex')->name('quick-notification.index');
    Route::get('quick-notification/create', 'CMS\NotificationController@quickNotificationCreate')->name('quick-notification.create');
    Route::post('quick-notification/store', 'CMS\PushNotificationController@quickNotificationStoreAndSend')->name('quick-notification.store');
    Route::get('quick-notification/all/{id}', 'CMS\NotificationController@quickNotificationShowAll')->name('quick-notification.show-all');

    Route::get('notification/productlist/dropdown', 'CMS\NotificationController@getProductList')->name('notification.productlist.dropdown');
    Route::get('notification/destroy/{id}', 'CMS\NotificationController@destroy');
    Route::get('notification/all/{id}', 'CMS\NotificationController@showAll')->name('notification.show-all');
    Route::get('notification-report', 'CMS\NotificationController@getNotificationReport')->name('notification.report');

    Route::get('notification/productlist/dropdown', 'CMS\NotificationController@getProductList')->name('notification.productlist.dropdown');
    // Notification V2
    Route::resource('notification-v2', 'CMS\NotificationV2\NotificationV2Controller');

    Route::get('notification-v2/productlist/dropdown', 'CMS\NotificationV2\NotificationV2Controller@getProductList')->name('notification-v2.productlist.dropdown');
    Route::get('notification-v2/destroy/{id}', 'CMS\NotificationV2\NotificationV2Controller@destroy');
    Route::post('notification-v2/notificationData', 'CMS\NotificationV2\NotificationV2Controller@notificationData')->name('notification-v2.notificationData');
    Route::get('notification-v2/all/{id}', 'CMS\NotificationV2\NotificationV2Controller@showAll')->name('notification-v2.show-all');
    Route::get('notification-report-v2', 'CMS\NotificationV2\NotificationV2Controller@getNotificationReport')->name('notification-v2.report');
    Route::post('target-wise-push-notification-v2',
    'CMS\NotificationV2\NotificationV2Controller@targetWiseNotificationSend')->name('target_wise_notification-v2.send');

    Route::get('target-wise-notification-report-v2',
    'CMS\NotificationV2\NotificationV2Controller@getTargetWiseNotificationReport')->name('target-wise-notification-report-v2.report');

    Route::get('target-wise-notification-report-details-v2/{notificationId}',
    'CMS\NotificationV2\NotificationV2Controller@getTargetWiseNotificationReportDetails')->name('target-wise-notification-report-v2.report-details');

    // Customer Sync
    Route::get('/fresh-sync', 'CMS\NotificationV2\NotificationV2Controller@freshSync')->name('fresh-sync');

    Route::get('/test', 'CMS\NotificationV2\NotificationV2Controller@test')->name('test');

    // Push Notification
    Route::post('push-notification', 'CMS\PushNotificationController@sendNotification')->name('notification.send');
    Route::post('push-notification-schedule', 'CMS\PushNotificationController@sendScheduledNotification')
        ->name('notification-schedule.send');
    Route::get('push-notification-schedule/stop/{id}', 'CMS\PushNotificationController@stopSchedule')
        ->name('notification-schedule.stop');
    Route::get('push-notification-schedule/download/{id}', 'CMS\PushNotificationController@downloadCustomerFile')
        ->name('notification-schedule.download');
    Route::post(
        'target-wise-push-notification',
        'CMS\PushNotificationController@targetWiseNotificationSend'
    )->name('target_wise_notification.send');
    Route::get(
        'target-wise-notification-report',
        'CMS\NotificationController@getTargetWiseNotificationReport'
    )->name('target-wise-notification-report.report');
    Route::get(
        'target-wise-notification-report-details/{titel}',
        'CMS\NotificationController@getTargetWiseNotificationReportDetails'
    )->name('target-wise-notification-report.report-details');

    // Get push notification purchase report
    Route::get(
        'purchase/from-notification/list',
        'CMS\PushNotificationProductPurchaseController@index'
    )->name('purchase.from_notification.list');
    Route::get(
        'purchase/from-notification/details/{id}',
        'CMS\PushNotificationProductPurchaseController@details'
    )->name('push.notification.purchase.report.details');


    Route::post(
        'push-notification-all',
        'CMS\PushNotificationController@sendNotificationToAll'
    )->name('notification.send-all');

    /**
     * Guest User Tracking
     */
    Route::get(
        'guest-user-tracking',
        'CMS\NotificationController@getGuestUserList'
    )->name('guest.user.track');

    // Store category
    Route::resource('storeCategory', 'CMS\StoreCategoryController');
    Route::get('storeCategory/destroy/{id}', 'CMS\StoreCategoryController@destroy');
    Route::get('myblCategory-sortable', 'CMS\StoreCategoryController@myblCategorySortable')->name('myblCategory.sort');


    // Support Messages
    Route::get('support-message', 'CMS\SupportMessageRatingController@index')->name('support-message');
    Route::post('support-message', 'CMS\SupportMessageRatingController@index')->name('support.message.list');


    // Store sub-category
    Route::resource('subStore', 'CMS\StoreSubCategoryController');
    Route::get('subStore/destroy/{id}', 'CMS\StoreSubCategoryController@destroy');
    Route::get('subStore/subcategory-find/{id}', 'CMS\StoreSubCategoryController@getSubCategoryByCatId');

    // Store
    Route::resource('myblStore', 'CMS\StoreController');
    Route::get('myblStore/destroy/{id}', 'CMS\StoreController@destroy');
    Route::get('myblStore-sortable', 'CMS\StoreController@myblStoreSortable')->name('myblStore.sort');

    // App
    Route::resource('appStore', 'CMS\StoreAppController');
    Route::get('appStore/destroy/{id}', 'CMS\StoreAppController@destroy');
    Route::get('appStore-sortable', 'CMS\StoreAppController@appStoreSortable')->name('appStore.sort');

    // Store App Slider Image
    Route::get('appslider/{id}/images', 'CMS\StoreAppSliderImageController@index');
    Route::get('appsliderImage/addImage/update-position', 'CMS\StoreAppSliderImageController@updatePosition');
    Route::get(
        'appslider/addImage/{sliderId}',
        'CMS\StoreAppSliderImageController@index'
    )->name('appsliderImage.index');

    Route::get('appslider/{id}/images', 'CMS\StoreAppSliderImageController@index')->name('appslider.images.index');
    Route::get(
        'appslider/{id}/images/create',
        'CMS\StoreAppSliderImageController@create'
    )->name('appslider.images.create');
    Route::post('appslider/images/store', 'CMS\StoreAppSliderImageController@store')->name('appslider.images.store');
    Route::get('appslider/images/{id}/edit', 'CMS\StoreAppSliderImageController@edit')->name('appslider.images.edit');
    Route::put(
        'appslider/images/{id}/update',
        'CMS\StoreAppSliderImageController@update'
    )->name('appslider.images.update');
    Route::put(
        'appslider/images/{id}/update',
        'CMS\StoreAppSliderImageController@update'
    )->name('appslider.images.update');
    Route::delete(
        'appslider/images/{id}/delete',
        'CMS\StoreAppSliderImageController@destroy'
    )->name('appslider.images.destroy');


    /*
     * terms and conditions
     */
    Route::get('terms-conditions/{featureName}', 'CMS\TermsAndConditionsController@show')->name('terms-conditions.show');
    Route::post('terms-conditions', 'CMS\TermsAndConditionsController@store')->name('terms-conditions.store');

    // privacy and policy
    Route::get('privacy-policy', 'CMS\PrivacyPolicyController@show')->name('privacy-policy.show');
    Route::post('privacy-policy', 'CMS\PrivacyPolicyController@store')->name('privacy-policy.store');

    // faq category
    Route::get('faq/category', 'CMS\FaqCategoryController@index')->name('faq.category.index');

    Route::post('faq/category/update', 'CMS\FaqCategoryController@update')->name('faq.category.update');
    Route::post('faq/category', 'CMS\FaqCategoryController@store')->name('faq.category.store');
    Route::post('faq/category/delete', 'CMS\FaqCategoryController@destroy')->name('faq.category.delete');

    // faq questions
    Route::get('faq/questions', 'CMS\FaqQuestionsController@index')->name('faq.questions.index');
    Route::get('faq/questions/create/{id?}', 'CMS\FaqQuestionsController@create')->name('faq.questions.create');
    Route::post('faq/questions/store', 'CMS\FaqQuestionsController@store')->name('faq.questions.store');
    Route::get('faq/questions/{id}', 'CMS\FaqQuestionsController@show')->name('faq.questions.show');
    Route::patch('faq/questions/{id}/update', 'CMS\FaqQuestionsController@update')->name('faq.questions.update');
    Route::delete('faq/questions/delete', 'CMS\FaqQuestionsController@delete')->name('faq.questions.delete');

    /*
     *  Product Routes
     */

    Route::get('mybl/core-product', 'CMS\MyblProductEntryController@index')->name('mybl.product.index');
    Route::get('mybl/core-product/create', 'CMS\MyblProductEntryController@create')->name('mybl.product.create');
    Route::post('mybl/core-product/store', 'CMS\MyblProductEntryController@store')->name('mybl.product.store');

    /**
     * Redis reset schedule routes
     */
    Route::post('mybl/core-product/redis', 'CMS\MyblProductEntryController@resetRedisProductKey')
        ->name('mybl.product.redis');
    Route::resource('redis-reset-schedules', 'CMS\RedisResetScheduleController');
    Route::get('redis-reset-schedules/toggle-status/{id}', 'CMS\RedisResetScheduleController@toggleStatus')
        ->name('redis-reset-schedules.toggle-status');


    Route::post(
        'mybl/core-product/download',
        'CMS\MyblProductEntryController@downloadMyblProducts'
    )->name('mybl.product.download');
    Route::post('mybl/core-product', 'CMS\MyblProductEntryController@uploadProductByExcel')
        ->name('mybl.core-product.save');
    Route::get('mybl/products', 'CMS\MyblProductEntryController@getMyblProducts')
        ->name('mybl.products.list');
    Route::get('mybl/core-product/details', 'ProductEntryController@getProductDetails')->name('product.details.info');
    Route::get('mybl/products/{product_code}', 'CMS\MyblProductEntryController@getProductDetails')
        ->name('mybl.products.details');
    Route::get('mybl/inactive-products', 'CMS\MyblProductEntryController@inactiveProducts')
        ->name('mybl.products.inactive-products');
    Route::get('mybl/products/activate/{productCode}', 'CMS\MyblProductEntryController@activateProduct')
        ->name('mybl.products.activate');

    Route::put('mybl/products/{product_code}', 'CMS\MyblProductEntryController@updateMyblProducts')
        ->name('mybl.product.update');
    Route::get('store-locations/entry', 'StoreLocatorEntryController@create');
    Route::post('store-locations', 'StoreLocatorEntryController@uploadStoresByExcel')->name('store-locations.save');

    Route::get('core-product/test', 'ProductEntryController@test');

    Route::get('product-image-remove/{id}', 'CMS\MyblProductEntryController@imageRemove')
        ->name('product.img.remove');

    Route::get('pin-to-top-products', 'CMS\MyblProductEntryController@pinToTopProducts')->name('pin-to-top.products');
    Route::get('pin-to-top-products/sort-auto-save', 'CMS\MyblProductEntryController@productSortable');
    /*
     * Product Tags Routes
     */
    Route::get('mybl/product/tags', 'CMS\ProductTagController@index')->name('product-tags.index');
    Route::get('mybl/product/tags/{tag}/edit', 'CMS\ProductTagController@edit')->name('product-tags.edit');
    Route::put('mybl/product/tags/{id}', 'CMS\ProductTagController@update')->name('product-tags.update');
    Route::post('mybl/product/tags', 'CMS\ProductTagController@store')->name('product-tags.store');
    Route::delete('mybl/product/tags/{id}', 'CMS\ProductTagController@destroy')->name('product-tags.destroy');

    //Deep link
    Route::get(
        'mybl-products-deep-link-create/{product_code}',
        'CMS\ProductDeepLinkController@create'
    )->name('mybl-products-deep-link-create');
    Route::get('product-deep-link-report', 'CMS\ProductDeepLinkController@index')->name('products-deep-link-report');
    Route::get('product-deeplink-list', 'CMS\ProductDeepLinkController@data')->name('product-deeplink-list');
    Route::get(
        'deeplink-product-purchase-details',
        'CMS\ProductDeepLinkController@getDetails'
    )->name('deeplink-product-purchase-details');
    Route::get('deeplink-product-purchase-details/{product_purchase_id}', 'CMS\ProductDeepLinkController@getDetails');


    /*
     *  Recharge prefill amounts
     */

    Route::get('recharge/prefill-amounts', 'CMS\PrefillRechargeController@show')
        ->name('recharge.prefill-amounts.index');
    Route::post('recharge/prefill-amounts', 'CMS\PrefillRechargeController@update')
        ->name('recharge.prefill-amounts.update');

    Route::get('recharge/prefill-amounts/order', 'CMS\PrefillRechargeController@updatePosition');

    /*
    *  Balance Transfer
    */

    Route::get('balance-transfer/prefill-amounts', 'BalanceTransferController@createPrefillAmounts')
        ->name('balance-transfer.prefill-amounts.create');
    Route::post('balance-transfer/prefill-amounts', 'BalanceTransferController@storePrefillAmounts')
        ->name('balance-transfer.prefill-amounts.store');

    Route::get('balance-transfer/prefill-amounts/order', 'CMS\PrefillRechargeController@updatePosition');

    // search content
    Route::get('mybl-search/content', 'CMS\Search\InAppSearchContentController@create')
        ->name('mybl-search-content.create');
    Route::get('mybl-search', 'CMS\Search\InAppSearchContentController@index')
        ->name('mybl-search-content.index');
    Route::get('mybl-search/list', 'CMS\Search\InAppSearchContentController@getSearchContents')
        ->name('mybl-search-content.list');
    Route::post('mybl-search/content', 'CMS\Search\InAppSearchContentController@store')
        ->name('mybl-search-content.store');
    Route::get('mybl-search/{search_content}', 'CMS\Search\InAppSearchContentController@edit')
        ->name('mybl-search-content.edit');
    Route::post('mybl-search/{search_content}', 'CMS\Search\InAppSearchContentController@update')
        ->name('mybl-search-content.update');
    Route::delete('mybl-search/{search_content}', 'CMS\Search\InAppSearchContentController@destroy')
        ->name('mybl-search-content.delete');

    Route::get('app-launch/create', 'CMS\AppLaunchPopupController@create')->name('app-launch.new');
    Route::post('app-launch/store', 'CMS\AppLaunchPopupController@store')->name('app-launch.store');
    Route::get('app-launch', 'CMS\AppLaunchPopupController@index')->name('app-launch.index');
    Route::get('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@edit')->name('app-launch.edit');
    Route::post('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@update')->name('app-launch.update');
    Route::delete('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@destroy')->name('app-launch.delete');

    Route::get('app-launch/popup/report', 'CMS\AppLaunchPopupController@report')->name('app-launch.report');
    Route::get('app-launch/popup/report/{popupId}', 'CMS\AppLaunchPopupController@reportDetail')
        ->name('app-launch.report-detail');

    Route::resource('recurring-schedule-hours', 'CMS\RecurringScheduleHourController');

    /*
     *  Filters
     */

    Route::get('mixed-bundle-offer/filter/create', 'CMS\MixedBundleFilterController@create')
        ->name('mixed-bundle-offer.filter.create');
    Route::post('mixed-bundle-offer/filter/price/save', 'CMS\MixedBundleFilterController@savePriceFilter')
        ->name('mixed-bundle-offer.filter.price.save');
    Route::get('mixed-bundle-offer/filter/price', 'CMS\MixedBundleFilterController@getPriceFilter')
        ->name('mixed-bundle-offer.filter.price.list');

    Route::post('mixed-bundle-offer/filter/delete', 'CMS\MixedBundleFilterController@deleteFilter')
        ->name('mixed-bundle-offer.filter.delete');

    Route::post('mixed-bundle-offer/filter/internet/save', 'CMS\MixedBundleFilterController@saveInternetFilter')
        ->name('mixed-bundle-offer.filter.internet.save');
    Route::get('mixed-bundle-offer/filter/internet', 'CMS\MixedBundleFilterController@getInternetFilter')
        ->name('mixed-bundle-offer.filter.internet.list');

    Route::post('mixed-bundle-offer/filter/minutes/save', 'CMS\MixedBundleFilterController@saveMinutesFilter')
        ->name('mixed-bundle-offer.filter.minutes.save');
    Route::get('mixed-bundle-offer/filter/minutes', 'CMS\MixedBundleFilterController@getMinutesFilter')
        ->name('mixed-bundle-offer.filter.minutes.list');

    Route::post('mixed-bundle-offer/filter/sms/save', 'CMS\MixedBundleFilterController@saveSmsFilter')
        ->name('mixed-bundle-offer.filter.sms.save');
    Route::get('mixed-bundle-offer/filter/sms', 'CMS\MixedBundleFilterController@getSmsFilter')
        ->name('mixed-bundle-offer.filter.sms.list');

    Route::post('mixed-bundle-offer/filter/validity/save', 'CMS\MixedBundleFilterController@saveValidityFilter')
        ->name('mixed-bundle-offer.filter.validity.save');
    Route::get('mixed-bundle-offer/filter/validity', 'CMS\MixedBundleFilterController@getValidityFilter')
        ->name('mixed-bundle-offer.filter.validity.list');

    Route::post('mixed-bundle-offer/filter/sort/save', 'CMS\MixedBundleFilterController@saveSortFilter')
        ->name('mixed-bundle-offer.filter.sort.save');

    Route::get('/test/test', 'CMS\MixedBundleFilterController@getPriceFilter');

    Route::get('internet-pack/filter/create', 'CMS\InternetPackFilterController@create')
        ->name('internet-pack.filter.create');
    Route::post('internet-pack/price/save', 'CMS\InternetPackFilterController@savePriceFilter')
        ->name('internet-pack.filter.price.save');
    Route::get('internet-pack/filter/price', 'CMS\InternetPackFilterController@getPriceFilter')
        ->name('internet-pack.filter.price.list');

    Route::post('internet-pack/filter/delete', 'CMS\InternetPackFilterController@deleteFilter')
        ->name('internet-pack.filter.delete');

    Route::post('internet-pack/filter/internet/save', 'CMS\InternetPackFilterController@saveInternetFilter')
        ->name('internet-pack.filter.internet.save');
    Route::get('internet-pack/filter/internet', 'CMS\InternetPackFilterController@getInternetFilter')
        ->name('internet-pack.filter.internet.list');

    Route::post('internet-pack/filter/validity/save', 'CMS\InternetPackFilterController@saveValidityFilter')
        ->name('internet-pack.filter.validity.save');
    Route::get('internet-pack/filter/validity', 'CMS\InternetPackFilterController@getValidityFilter')
        ->name('internet-pack.filter.validity.list');


    //RECHARGE OFFER
    Route::get('recharge-pack/filter/create', 'CMS\RechargePackFilterController@create')
        ->name('recharge-pack.filter.create');

    Route::post('recharge-pack/price/save', 'CMS\RechargePackFilterController@savePriceFilter')
        ->name('recharge-pack.filter.price.save');
    Route::get('recharge-pack/filter/price', 'CMS\RechargePackFilterController@getPriceFilter')
        ->name('recharge-pack.filter.price.list');
    Route::post('recharge-pack/filter/delete', 'CMS\RechargePackFilterController@deleteFilter')
        ->name('recharge-pack.filter.delete');

    Route::post('recharge-internet-pack/filter/internet/save', 'CMS\RechargePackFilterController@saveInternetFilter')
        ->name('recharge-internet-pack.filter.internet.save');
    Route::get('recharge-internet-pack/filter/internet', 'CMS\RechargePackFilterController@getInternetFilter')
        ->name('recharge-internet-pack.filter.internet.list');


    Route::post('recharge-internet-pack/filter/validity/save', 'CMS\RechargePackFilterController@saveValidityFilter')
        ->name('recharge-internet-pack.filter.validity.save');
    Route::get('recharge-internet-pack/filter/validity', 'CMS\RechargePackFilterController@getValidityFilter')
        ->name('recharge-internet-pack.filter.validity.list');


    Route::post('recharge-pack/filter/minutes/save', 'CMS\RechargePackFilterController@saveMinutesFilter')
        ->name('recharge-pack.filter.minutes.save');
    Route::get('recharge-pack/filter/minutes', 'CMS\RechargePackFilterController@getMinutesFilter')
        ->name('recharge-pack.filter.minutes.list');

    Route::post('recharge-pack/filter/sms/save', 'CMS\RechargePackFilterController@saveSmsFilter')
        ->name('recharge-pack.filter.sms.save');
    Route::get('recharge-pack/filter/sms', 'CMS\RechargePackFilterController@getSmsFilter')
        ->name('recharge-pack.filter.sms.list');

    Route::post('recharge-pack/filter/sort/save', 'CMS\RechargePackFilterController@saveSortFilter')
        ->name('recharge-pack.filter.sort.save');

    // MINUTES
    Route::get('minute-pack/filter/create', 'CMS\MinutePackFilterController@create')
        ->name('minute-pack.filter.create');
    Route::post('minute-pack/price/save', 'CMS\MinutePackFilterController@savePriceFilter')
        ->name('minute-pack.filter.price.save');
    Route::get('minute-pack/filter/price', 'CMS\MinutePackFilterController@getPriceFilter')
        ->name('minute-pack.filter.price.list');

    Route::post('minute-pack/filter/delete', 'CMS\MinutePackFilterController@deleteFilter')
        ->name('minute-pack.filter.delete');

    Route::post('minute-pack/filter/minute/save', 'CMS\MinutePackFilterController@saveMinuteFilter')
        ->name('minute-pack.filter.minute.save');
    Route::get('minute-pack/filter/minute', 'CMS\MinutePackFilterController@getMinuteFilter')
        ->name('minute-pack.filter.minute.list');

    Route::post('minute-pack/filter/validity/save', 'CMS\MinutePackFilterController@saveValidityFilter')
        ->name('minute-pack.filter.validity.save');
    Route::get('minute-pack/filter/validity', 'CMS\MinutePackFilterController@getValidityFilter')
        ->name('minute-pack.filter.validity.list');

    Route::post('minute-pack/filter/sort/save', 'CMS\MinutePackFilterController@saveSortFilter')
        ->name('minute.filter.sort.save');

    // SPECIAL CALL RATE FILTER
    Route::get('special-pack/filter/create', 'CMS\SpecialCallRateFilterController@create')
        ->name('special-pack.filter.create');
    Route::post('special-pack/price/save', 'CMS\SpecialCallRateFilterController@savePriceFilter')
        ->name('special-pack.filter.price.save');
    Route::get('special-pack/filter/price', 'CMS\SpecialCallRateFilterController@getPriceFilter')
        ->name('special-pack.filter.price.list');

    Route::post('special-pack/filter/delete', 'CMS\SpecialCallRateFilterController@deleteFilter')
        ->name('special-pack.filter.delete');
//
    Route::post('special-pack/filter/minute/save', 'CMS\SpecialCallRateFilterController@saveMinuteFilter')
        ->name('special-pack.filter.minute.save');
    Route::get('special-pack/filter/minute', 'CMS\SpecialCallRateFilterController@getMinuteFilter')
        ->name('special-pack.filter.minute.list');
//
    Route::post('special-pack/filter/validity/save', 'CMS\SpecialCallRateFilterController@saveValidityFilter')
        ->name('special-pack.filter.validity.save');
    Route::get('special-pack/filter/validity', 'CMS\SpecialCallRateFilterController@getValidityFilter')
        ->name('special-pack.filter.validity.list');
//
    Route::post('special-pack/filter/sort/save', 'CMS\SpecialCallRateFilterController@saveSortFilter')
        ->name('special.filter.sort.save');

    Route::post('special-pack/filter/sms/save', 'CMS\SpecialCallRateFilterController@saveSmsFilter')
        ->name('special-pack.filter.sms.save');
    Route::get('special-pack/filter/sms', 'CMS\SpecialCallRateFilterController@getSmsFilter')
        ->name('special-pack.filter.sms.list');

    Route::post('special-pack/filter/internet/save', 'CMS\SpecialCallRateFilterController@saveInternetFilter')
        ->name('special-pack.filter.internet.save');
    Route::get('special-pack/filter/internet', 'CMS\SpecialCallRateFilterController@getInternetFilter')
        ->name('special-pack.filter.internet.list');


    // SMS

    Route::get('sms-pack/filter/create', 'CMS\SmsPackFilterController@create')
        ->name('sms-pack.filter.create');
    Route::post('sms-pack/price/save', 'CMS\SmsPackFilterController@savePriceFilter')
        ->name('sms-pack.filter.price.save');
    Route::get('sms-pack/filter/price', 'CMS\SmsPackFilterController@getPriceFilter')
        ->name('sms-pack.filter.price.list');

    Route::post('sms-pack/filter/delete', 'CMS\SmsPackFilterController@deleteFilter')
        ->name('sms-pack.filter.delete');

    Route::post('sms-pack/filter/sms/save', 'CMS\SmsPackFilterController@saveSmsFilter')
        ->name('sms-pack.filter.sms.save');
    Route::get('sms-pack/filter/sms', 'CMS\SmsPackFilterController@getSmsFilter')
        ->name('sms-pack.filter.sms.list');

    Route::post('sms-pack/filter/validity/save', 'CMS\SmsPackFilterController@saveValidityFilter')
        ->name('sms-pack.filter.validity.save');
    Route::get('sms-pack/filter/validity', 'CMS\SmsPackFilterController@getValidityFilter')
        ->name('sms-pack.filter.validity.list');

    Route::post('sms-pack/filter/sort/save', 'CMS\SmsPackFilterController@saveSortFilter')
        ->name('sms.filter.sort.save');

    Route::get('mybl/settings/najat', 'CMS\NajatContentsSettingsController@index')->name('mybl.settings.najat.index');
    Route::post('mybl/settings/najat', 'CMS\NajatContentsSettingsController@store')->name('mybl.settings.najat.store');

    /*
    * Bandho Sim image
    */
    Route::resource('bandhosimimage', 'CMS\BandhoSimImageController');
    Route::get('bandhosim/index', 'CMS\BandhoSimImageController@index')->name('bandhosim.index');
    Route::post(
        'mybl/settings/bandhosimimage/Store',
        'CMS\BandhoSimImageController@store'
    )->name('mybl.settings.bandho.sim.image.store');
    Route::post(
        'mybl/settings/bandhosimimage/update/{id}',
        'CMS\BandhoSimImageController@update'
    )->name('mybl.settings.bandho.sim.image.update');

    /*
     *  API Debug For Developer
     */

    Route::get('developer/api/debug', 'CMS\ApiDebugController@userBalancePanel')->name('mybl.api.debug');
    Route::get('developer/api/debug/balance-summary/{number}', 'CMS\ApiDebugController@getBalanceSummary')
        ->name('mybl.api.debug.balance-summary');
    Route::get('developer/api/debug/balance-details/{number}/{type}', 'CMS\ApiDebugController@getBalanceDetails')
        ->name('mybl.api.debug.balance-details');

    Route::get(
        'developer/api/debug/product/log/{number}',
        'CMS\ApiDebugController@getProductLogs'
    )->name('product.api.log');

    Route::get('developer/api/debug/audit_logs/{number}', 'CMS\ApiDebugController@getBrowseHistory');
    Route::get('developer/api/debug/bonus_logs/{number}', 'CMS\ApiDebugController@getLoginBonusHistory');
    Route::get('developer/api/debug/otp-logs/{number}', 'CMS\ApiDebugController@getOtpRequestLogs');

    Route::get('developer/api/debug/otp-login-logs/{number}', 'CMS\ApiDebugController@getOtpLoginRequestLogs');

    Route::get('developer/api/debug/last-login/{number}', 'CMS\ApiDebugController@getLastLogin');

    Route::get('developer/api/debug/usage-summary/{number}', 'CMS\ApiDebugController@getUsageSummary');

    Route::get('developer/api/debug/usage-details/{number}/{type}', 'CMS\ApiDebugController@getUsageDetails');
    Route::get('developer/api/debug/contact-restore-logs/{number}', 'CMS\ApiDebugController@getContactRestoreLogs');

    Route::get('developer/api/debug/header-enrichment-logs', 'CMS\ApiDebugController@getHeaderEnrichmentLogs')
            ->name('header-enrichment-logs');


    Route::get('developer/api/debug/non-bl-request-logs', 'CMS\ApiDebugController@getNonBlNumberLogs')
        ->name('non-bl-request-logs');

    // Agent Deeplink
    //    Route::resource('deeplink/agent', 'CMS\AgentListController');

    Route::get('deeplink/agent/list', 'CMS\AgentListController@index')->name('deeplink.agent.list');
    Route::get('deeplink/agent/create', 'CMS\AgentListController@create')->name('deeplink.agent.create');
    Route::POST('deeplink/agent/store', 'CMS\AgentListController@store')->name('deeplink.agent.store');
    Route::get('deeplink/agent/{id}/edit', 'CMS\AgentListController@edit')->name('deeplink.agent.edit');
    Route::get('deeplink/agent/{id}/change-status', 'CMS\AgentListController@changeStatus')->name('deeplink.agent.statusChange');
    Route::POST('deeplink/agent/{id}/update', 'CMS\AgentListController@update')->name('deeplink.agent.update');
    Route::DELETE('deeplink/agent/destroy/{id}', 'CMS\AgentListController@destroy')->name('deeplink.agent.destroy');

    // Agent deeplink list
    Route::get('deeplink/agent/deeplink/list', 'CMS\AgentListController@index')->name('deeplink.agent.list');
    Route::get('deeplink/agent/deeplink/list/{id}', 'CMS\AgentListController@viewAgentDeeplinkDetails')->name('deeplink.agent.deeplink.list');
    Route::POST('agent/deeplink/store', 'CMS\AgentListController@agentDeeplinkStore')->name('agent.deeplink.store');
    Route::get('agent/deeplink/item/delete/{agentId}/{id}', 'CMS\AgentListController@agentDeeplinkDelete')->name('agent.deeplink.item.delete');
    Route::get('agent/deeplink/report', 'CMS\AgentListController@agentDeeplinkReport')->name('agent.deeplink.report');
    Route::get('agent/deeplink/report/details/{id}', 'CMS\AgentListController@agentDeeplinkReportDetails')->name('agent.deeplink.report.details');
    Route::get('agent/deeplink/report/details', 'CMS\AgentListController@agentDeeplinkReport')->name('agent.deeplink.report');
    Route::POST('agent/deeplink/email-send', 'CMS\AgentListController@agentDeeplinkEmailSend')->name('agent.deeplink.emailsend');

    // Learn Priyojon Sections

    Route::get('mybl/learn-priyojon', 'CMS\LearnPriyojonContentController@show')->name('learn-priyojon.show');
    Route::post('mybl/learn-priyojon', 'CMS\LearnPriyojonContentController@store')->name('learn-priyojon.store');

    // Migrate Plan
    Route::resource('migrate-plan', 'CMS\MigratePlanController');
    Route::get('migrate-plan/destroy/{id}', 'CMS\MigratePlanController@destroy');

//    Banner Analytic
//    Route::resource('banner-analytic', 'CMS\BannerAnalyticController');
    Route::get('banner-analytic', 'CMS\BannerAnalyticController@index')->name('banner-analytic.index');
    Route::Get('banner-analytic/data', 'CMS\BannerAnalyticController@data')->name('banner-analytic.data');
    Route::Get('banner-analytic/report/details/{id}', 'CMS\BannerAnalyticController@detailreport')->name('banner-analytic.report.details');
    Route::Get('banner-analytic/purchase/report/details/{id}', 'CMS\BannerAnalyticController@purchaseDetailreport')->name('banner-analytic.purchase.report.details');

    /*
    * Refer And Earn
    */
    Route::resource('mybl-refer-and-earn', 'CMS\MyBlReferAndEarnController')->except(['show', 'destroy']);
    Route::get('mybl-refer-and-earn/destroy/{id}', 'CMS\MyBlReferAndEarnController@destroy');
    Route::get('mybl-refer-and-earn/campaign-details/{id}', 'CMS\MyBlReferAndEarnController@campaignDetails')
        ->name('refer-and-earn.campaign.details');
    Route::get('mybl-refer-and-earn/analytics', 'CMS\MyBlReferAndEarnController@getReferAndEarnAnalytics')
        ->name('refer-and-earn.analytics');

    Route::get('mybl-refer-and-earn/referee-details/{id}', 'CMS\MyBlReferAndEarnController@refereeDetails');

    /*
    * Event Base bonus
    */
    Route::get('event-base-bonus/tasks-del/{id}', 'CMS\EventBaseTaskController@delete');
    Route::resource('event-base-bonus/tasks', 'CMS\EventBaseTaskController')->except(['show']);
    Route::resource('event-base-bonus/campaigns', 'CMS\EventBaseCampaignController')->except(['show']);
    Route::get('event-base-bonus/analytics', 'CMS\EventBaseTaskAnalyticController@index');
    Route::post('event-base-bonus/analytics/find', 'CMS\EventBaseTaskAnalyticController@analytics');
    Route::post('event-base-bonus/analytics/search', 'CMS\EventBaseTaskAnalyticController@analyticsUserDetails');
    Route::get('event-base-bonus/analytics/{campaign}/{task}', 'CMS\EventBaseTaskAnalyticController@viewDetails');

    /*
    * Event Base bonus V2
    */
    Route::get('event-base-bonus/v2/tasks-del/{id}', 'CMS\EventBaseTaskV2Controller@delete');
    Route::resource('event-base-bonus/v2/tasks', 'CMS\EventBaseTaskV2Controller')->except(['show']);
    Route::resource('event-base-bonus/v2/campaigns', 'CMS\EventBaseCampaignV2Controller')->except(['show']);
    Route::get('event-base-bonus/v2/analytics', 'CMS\EventBaseTaskAnalyticV2Controller@index');
    Route::post('event-base-bonus/v2/analytics/find', 'CMS\EventBaseTaskAnalyticV2Controller@analytics');
    Route::post('event-base-bonus/v2/analytics/search', 'CMS\EventBaseTaskAnalyticV2Controller@analyticsUserDetails');
    Route::get('event-base-bonus/v2/analytics/{campaign}/', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallenges');
    Route::get('event-base-bonus/v2/analytics/{campaign}/{challenge}/', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallengeTasks');
    Route::get('event-base-bonus/v2/analytics/{campaign}/{challenge}/{task}/{msisdn?}', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallengeTaskMsisdnList');
    Route::resource('event-base-bonus/v2/challenges', 'CMS\EventBaseChallengeV2Controller')->except(['show']);
    Route::get('event-base-bonus/v2/campaign-del/{id}', 'CMS\EventBaseCampaignV2Controller@delete');
    /*
     *  Feed Routes
     */
    Route::namespace('CMS')->prefix('feeds')->name('feeds.')->group(function () {
        Route::resource('/', 'FeedController')->parameters(['' => 'feed'])->except('show');
        // Category resource
        Route::resource('categories', 'FeedCategoryController')->except('show');
        Route::get(
            'categories/update-position',
            'FeedCategoryController@updatePosition'
        )->name('categories.update_position');
    });
    Route::get('feed-list', 'CMS\FeedController@getFeedForAjax')->name('feed.ajax.request');

    /*
     * Product Activities
     */
    Route::get('mybl-product-activities', 'CMS\ProductActivityController@index')
        ->name('product-activities.history');
    Route::get('product-activities-details/{id}', 'CMS\ProductActivityController@show')
        ->name('product-activities.details');

    /*
     * Dynamic Deeplink
     */
    Route::get('store-deeplink/create', 'CMS\DynamicDeeplinkController@storeDeepLinkCreate');
    Route::get('feed-deeplink/create', 'CMS\DynamicDeeplinkController@feedDeepLinkCreate');
    Route::get('internet-pack-deeplink/create', 'CMS\DynamicDeeplinkController@internetPackDeepLinkCreate');
    Route::get('deeplink-analytic', 'CMS\DynamicDeeplinkController@analyticData');
    //App MENU  ====================================
    Route::get('mybl-menu/create', 'CMS\MyblAppMenuController@create');
    Route::get('mybl-menu/{id}/child-menu/create', 'CMS\MyblAppMenuController@create');
    Route::resource('mybl-menu', 'CMS\MyblAppMenuController')->only(['update', 'edit', 'store']);
    Route::get('mybl-menu/{id?}/{child_menu?}', 'CMS\MyblAppMenuController@index');
    Route::get('mybl-menu-auto-save', 'CMS\MyblAppMenuController@parentMenuSortable');
    Route::get('mybl-menu/{parentId}/destroy/{id}', 'CMS\MyblAppMenuController@destroy');
    /*
     * Dynamic Deeplink
     */
    Route::get('store-deeplink/create', 'CMS\DynamicDeeplinkController@storeDeepLinkCreate');
    Route::get('feed-deeplink/create', 'CMS\DynamicDeeplinkController@feedDeepLinkCreate');
    Route::get('mybl-campaign-section-deeplink/create', 'CMS\DynamicDeeplinkController@myblCampaignSectionDeepLinkCreate');
    Route::get('commerce-bill-category-deeplink/create', 'CMS\DynamicDeeplinkController@commerceBillCategoryDeepLinkCreate');
    Route::get('commerce-bill-utility-deeplink/create', 'CMS\DynamicDeeplinkController@commerceBillUtilityDeepLinkCreate');
    Route::get('internet-pack-deeplink/create', 'CMS\DynamicDeeplinkController@internetPackDeepLinkCreate');
    Route::get('menu-deeplink/create', 'CMS\DynamicDeeplinkController@menuDeepLinkCreate');
    Route::get('manage-deeplink/create', 'CMS\DynamicDeeplinkController@manageDeepLinkCreate');
    Route::get('deeplink-analytic', 'CMS\DynamicDeeplinkController@analyticData');
    Route::get('content-deeplink/create', 'CMS\DynamicDeeplinkController@contentDeepLinkCreate');
    Route::get('fifa-deeplink/create', 'CMS\DynamicDeeplinkController@fifaDeepLinkCreate');

    //App Manage  ====================================
    Route::resource('manage-category', 'CMS\MyblManageController')->except('show', 'destroy');
    Route::get('manage-category/destroy/{id}', 'CMS\MyblManageController@destroy')
        ->name('manage-category.destroy');
    Route::get('manage-category/sort-auto-save', 'CMS\MyblManageController@categorySortable');

    Route::prefix('mybl-manage-items/{category_id}')->group(function () {
        Route::get('/', 'CMS\MyblManageController@manageItemsList')->name('mybl-manage-items.index');
        Route::get('/create', 'CMS\MyblManageController@createItem')->name('mybl-manage-items.create');
        Route::post('/store', 'CMS\MyblManageController@storeItem')->name('mybl-manage-items.store');
        Route::get('/edit/{id}', 'CMS\MyblManageController@editItem')->name('mybl-manage-items.edit');
        Route::put('/update/{id}', 'CMS\MyblManageController@updateItem')->name('mybl-manage-items.update');
        Route::get('/destroy/{id}', 'CMS\MyblManageController@destroyItem')->name('mybl-manage-items.destroy');
        Route::get('/sort-auto-save', 'CMS\MyblManageController@itemSortable');
    });
    // Home Component
    Route::get('mybl-home-components', 'CMS\MyblHomeComponentController@index')->name('mybl.home.components');
    Route::get('mybl-home-components/edit/{id}', 'CMS\MyblHomeComponentController@edit')
        ->name('mybl.home.components.edit');
    Route::post('mybl-home-components/store', 'CMS\MyblHomeComponentController@store')
        ->name('mybl.home.components.store');
    Route::post('mybl-home-components/update', 'CMS\MyblHomeComponentController@update')
        ->name('mybl.home.components.update');
    Route::get('mybl-home-components-sort', 'CMS\MyblHomeComponentController@componentSort');
    Route::get('components-status-update/{id}', 'CMS\MyblHomeComponentController@componentStatusUpdate')
        ->name('components.status.update');
    Route::get('mybl-home-components/destroy/{id}', 'CMS\MyblHomeComponentController@destroy')
        ->name('mybl.home.components.destroy');

    //Commerce Component
    Route::get('mybl-commerce-components', 'CMS\MyblCommerceComponentController@index')->name('mybl.commerce.components');
    Route::get('mybl-commerce-components/edit/{id}', 'CMS\MyblCommerceComponentController@edit')
        ->name('mybl.commerce.components.edit');
    Route::post('mybl-commerce-components/store', 'CMS\MyblCommerceComponentController@store')
        ->name('mybl.commerce.components.store');
    Route::post('mybl-commerce-components/update', 'CMS\MyblCommerceComponentController@update')
        ->name('mybl.commerce.components.update');
    Route::get('mybl-commerce-components-sort', 'CMS\MyblCommerceComponentController@componentSort');
    Route::get('commerce-components-status-update/{id}', 'CMS\MyblCommerceComponentController@componentStatusUpdate')
        ->name('commerce-components.status.update');
    Route::get('mybl-commerce-components/destroy/{id}', 'CMS\MyblCommerceComponentController@destroy')
        ->name('mybl.commerce.components.destroy');

    //Content Component
    Route::get('content-components', 'CMS\ContentComponentController@index')->name('content-components');
    Route::get('content-components/edit/{id}', 'CMS\ContentComponentController@edit')
        ->name('content-components.edit');
    Route::post('content-components/store', 'CMS\ContentComponentController@store')
        ->name('content-components.store');
    Route::post('content-components/update', 'CMS\ContentComponentController@update')
        ->name('content-components.update');
    Route::get('content-components-sort', 'CMS\ContentComponentController@componentSort');
    Route::get('content-components-status-update/{id}', 'CMS\ContentComponentController@componentStatusUpdate')
        ->name('content-components.status.update');
    Route::get('content-components/destroy/{id}', 'CMS\ContentComponentController@destroy')
        ->name('content-components.destroy');

    //LMS Component
    Route::get('lms-components', 'CMS\LMS\LmsController@index')->name('lms-components');
    Route::get('lms-components/edit/{id}', 'CMS\LMS\LmsController@edit')
        ->name('lms.components.edit');
    Route::post('lms-components/store', 'CMS\LMS\LmsController@store')
        ->name('lms-components.store');
    Route::post('lms-components/update', 'CMS\LMS\LmsController@update')
        ->name('lms-components.update');
    Route::get('lms-components-sort', 'CMS\LMS\LmsController@componentSort');
    Route::get('lms-components-status-update/{id}', 'CMS\LMS\LmsController@componentStatusUpdate')
        ->name('lms-components.status.update');
    Route::get('lms-components/destroy/{id}', 'CMS\LMS\LmsController@destroy')
        ->name('lms-components.destroy');

    //LMS Shortcut
    Route::get('shortcut-components', 'CMS\LMS\ShortcutController@index')->name('shortcut-components');
    Route::get('shortcut-component-create', 'CMS\LMS\ShortcutController@create')
        ->name('shortcut-component.create');
    Route::get('shortcut-component/edit/{id}', 'CMS\LMS\ShortcutController@edit')
        ->name('shortcut-component.edit');
    Route::post('shortcut-component/store', 'CMS\LMS\ShortcutController@store')
        ->name('shortcut-component.store');
    Route::put('shortcut-component/update/{id}', 'CMS\LMS\ShortcutController@update')
        ->name('shortcut-component.update');
    Route::get('shortcut-components-sort', 'CMS\LMS\ShortcutController@componentSort');
    Route::get('shortcut-status-update/{id}', 'CMS\LMS\ShortcutController@componentStatusUpdate')
        ->name('shortcut-components.status.update');
    Route::get('shortcut-components/destroy/{id}', 'CMS\LMS\ShortcutController@destroy')
        ->name('shortcut-components.destroy');

    // Flash Hour
    Route::resource('flash-hour-campaign', 'CMS\MyBlFlashHourController')->except(['show', 'destroy']);
    Route::get('flash-hour-campaign-duplicate/{id}', 'CMS\MyBlFlashHourController@duplicateFlashHours')->name('flash-hour-campaign.duplicate');
    Route::get('flash-hour-campaign/destroy/{id}', 'CMS\MyBlFlashHourController@destroy');

    Route::get('flash-hour-analytic/{campaign_id}', 'CMS\MyBlFlashHourController@analyticReport')
        ->name('flash-hour-analytic.report');

    Route::get('flash-hour-purchase-msisdn-list/{campaignId}/{purchaseID}', 'CMS\MyBlFlashHourController@purchaseMsisdnList')
        ->name('mybl-campaign.purchase-msisdn.list');

    Route::get('flash-hour-purchase-msisdn/{id}', 'CMS\MyBlFlashHourController@purchaseDetails');

    // Mybl Campaign
    Route::resource('mybl-campaign', 'CMS\MyBlCampaignController')->except(['show', 'destroy']);
    Route::get('mybl-campaign/destroy/{id}', 'CMS\MyBlCampaignController@destroy');

    Route::get('mybl-campaign-analytic/{campaign_id}', 'CMS\MyBlCampaignController@analyticReport')
        ->name('mybl-campaign-analytic.report');

    Route::get('mybl-campaign-purchase-msisdn-list/{campaignId}/{purchaseID}', 'CMS\MyBlCampaignController@purchaseMsisdnList')
        ->name('purchase-msisdn.list');

    Route::get('mybl-campaign-purchase-msisdn/{id}', 'CMS\MyBlCampaignController@purchaseDetails');

//    Route::get('flash-hour-campaign/analytics', 'CMS\MyBlFlashHourController@getReferAndEarnAnalytics')
//        ->name('refer-and-earn.analytics');

    // Cash Back Campaign
    Route::resource('cash-back-campaign', 'CMS\MyBlCashBackController')->except(['show', 'destroy']);
    Route::get('cash-back-campaign/destroy/{id}', 'CMS\MyBlCashBackController@destroy');

    //    Free Product Purchase Report
    Route::get('free-product-purchase-report', 'CMS\MyblProductEntryController@freeProductPurchaseReport')
        ->name('free-product.purchase.report');

    Route::get('free-product-purchase-msisdn/{id}', 'CMS\MyblProductEntryController@purchaseDetails')
        ->name('free-product-purchase-msisdn.list');

    //Loyality Image Upload
    Route::resource('loyalty-partner-image', 'CMS\LoyaltyPartnerImageController')->except(['show']);
    Route::get('loyalty-partner-images/filter', 'CMS\LoyaltyPartnerImageController@filter');
    Route::get('loyalty-partner-images/report', 'CMS\LoyaltyPartnerImageController@report');

    //Mybl Welcome Banner
    Route::resource('welcome-banner', 'CMS\WelcomeBannerController')->except(['show']);
    /*
     * Own Recharge Inventory
     */

    Route::resource('own-recharge-inventory', 'CMS\MyBlOwnRechargeInvertoryController')->except(['show', 'destroy']);
    Route::get('own-recharge-inventory/destroy/{id}', 'CMS\MyBlOwnRechargeInvertoryController@destroy');

    /*
     * Event Base bonus
     */
    Route::get('event-base-bonus/tasks-del/{id}', 'CMS\EventBaseTaskController@delete');
    Route::resource('event-base-bonus/tasks', 'CMS\EventBaseTaskController')->except(['show']);
    Route::resource('event-base-bonus/campaigns', 'CMS\EventBaseCampaignController')->except(['show']);
    Route::get('event-base-bonus/analytics', 'CMS\EventBaseTaskAnalyticController@index');
    Route::post('event-base-bonus/analytics/find', 'CMS\EventBaseTaskAnalyticController@analytics');
    Route::post('event-base-bonus/analytics/search', 'CMS\EventBaseTaskAnalyticController@analyticsUserDetails');
    Route::get('event-base-bonus/analytics/{campaign}/{task}', 'CMS\EventBaseTaskAnalyticController@viewDetails');

    Route::get('mybl-home-components/destroy/{id}', 'CMS\MyblHomeComponentController@destroy')
        ->name('mybl.home.components.destroy');
    //    Free Product Purchase Report
    Route::get('free-product-purchase-report', 'CMS\MyblProductEntryController@freeProductPurchaseReport')
        ->name('free-product.purchase.report');

    Route::get('free-product-purchase-msisdn/{id}', 'CMS\MyblProductEntryController@purchaseDetails')
        ->name('free-product-purchase-msisdn.list');

    Route::get('product-schedule', 'CMS\MyblProductEntryController@getScheduleProduct')
        ->name('product.schedule');

    Route::get('product-schedule-revert/{id}', 'CMS\MyblProductEntryController@getScheduleProductRevert');

    Route::get('product-schedule-view/{id}', 'CMS\MyblProductEntryController@scheduleProductsView')->name('schedule-product.view');

    /*
     * Event Base bonus V2
     */
    Route::get('event-base-bonus/v2/tasks-del/{id}', 'CMS\EventBaseTaskV2Controller@delete');
    Route::resource('event-base-bonus/v2/tasks', 'CMS\EventBaseTaskV2Controller')->except(['show']);
    Route::resource('event-base-bonus/v2/campaigns', 'CMS\EventBaseCampaignV2Controller')->except(['show']);
    Route::get('event-base-bonus/v2/analytics', 'CMS\EventBaseTaskAnalyticV2Controller@index');
    Route::post('event-base-bonus/v2/analytics/find', 'CMS\EventBaseTaskAnalyticV2Controller@analytics');
    Route::post('event-base-bonus/v2/analytics/search', 'CMS\EventBaseTaskAnalyticV2Controller@analyticsUserDetails');
    Route::get('event-base-bonus/v2/analytics/{campaign}/', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallenges');
    Route::get('event-base-bonus/v2/analytics/{campaign}/{challenge}/', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallengeTasks');
    Route::get('event-base-bonus/v2/analytics/{campaign}/{challenge}/{task}/{msisdn?}', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallengeTaskMsisdnList');
    Route::resource('event-base-bonus/v2/challenges', 'CMS\EventBaseChallengeV2Controller')->except(['show']);
    Route::get('event-base-bonus/v2/campaign-del/{id}', 'CMS\EventBaseCampaignV2Controller@delete');

    /*
    * Usim Eligibility
    */
    Route::get('usim-eligibility', 'CMS\MyblUsimEligibilityController@index')
        ->name('usim-eligibility.index');
    Route::post('usim-eligibility-update/{id}', 'CMS\MyblUsimEligibilityController@update')
        ->name('usim-eligibility.update');

    Route::get('usim-eligibility-massage', 'CMS\MyblUsimEligibilityController@showMassage')
        ->name('usim-eligibility.show.massage');
    Route::post('usim-eligibility-massage-save', 'CMS\MyblUsimEligibilityController@saveMassage')
        ->name('usim-eligibility.save.massage');

    /*
     * Remove MSISDN
     */
    Route::get('remove-msisdn', 'CMS\RemoveMsisdnController@index')->name('remove-msisdn.index');
    Route::post('remove-msisdn/remove', 'CMS\RemoveMsisdnController@removeMsisdn')->name('remove-msisdn.remove');
    //Mybl Welcome Banner
    Route::resource('welcome-banner', 'CMS\WelcomeBannerController')->except(['show']);
    Route::post('welcome-banner/set-order', 'CMS\WelcomeBannerController@order');

    // Health Hub
    Route::resource('health-hub', 'CMS\HealthHubController')->except(['show', 'destroy']);
    Route::get('health-hub-auto-save', 'CMS\HealthHubController@itemSortable');
    Route::get('health-hub/destroy/{id}', 'CMS\HealthHubController@destroy')->name('healthHubItem.destroy');
    Route::get('health-hub-analytic-data', 'CMS\HealthHubController@analyticData')->name('health-hub.analytics');
    Route::get('health-hub-item-details/{itemId}', 'CMS\HealthHubController@analyticReportsItem');

    Route::get('health-hub-deeplink/analytic', 'CMS\HealthHubController@deeplinkAnalytic')
        ->name('health-hub-deeplink.analytic');
    Route::get('health-hub-deeplink/analytic-details/{dynamic_deeplink_id}', 'CMS\HealthHubController@deeplinkAnalyticDetails')
        ->name('health-hub-deeplink-analytic-details');

    Route::get('health-hub-category/in-app-analytic', 'CMS\HealthHubController@categoryInAppAnalytic')
        ->name('health_hub.in_app.analytic');
    Route::get('health-hub-category/in-app-analytic-details/{feed_cat_id}', 'CMS\HealthHubController@categoryInAppAnalyticDetails')
        ->name('health_hub.in_app.analytic.details');


    // Health Hub New Journey
    Route::resource('health-hub-feature-dashboard', 'CMS\HealthHubNewJourney\HealthHubDashboardController');
    Route::get('health-hub-feature-dashboard/destroy/{id}', 'CMS\HealthHubNewJourney\HealthHubDashboardController@destroy')->name('health-hub-feature-dashboard.destroy');
    Route::resource('health-hub-feature-service', 'CMS\HealthHubNewJourney\HealthHubServiceController');
    Route::get('health-hub-feature-service/destroy/{id}', 'CMS\HealthHubNewJourney\HealthHubServiceController@destroy');
    Route::get('health-hub-feature-service/update-dashboard-id/{id}', 'CMS\HealthHubNewJourney\HealthHubServiceController@updateDashboardId');
    Route::get('health-hub-feature-service/delete-dashboard-id/{id}', 'CMS\HealthHubNewJourney\HealthHubServiceController@deleteDashboardId');
    Route::resource('health-hub-feature-partner', 'CMS\HealthHubNewJourney\HealthHubPartnerController');
    Route::get('health-hub-feature-partner/destroy/{id}', 'CMS\HealthHubNewJourney\HealthHubPartnerController@destroy');
    Route::resource('health-hub-feature-package', 'CMS\HealthHubNewJourney\HealthHubPackageController');
    Route::get('health-hub-feature-package/destroy/{id}', 'CMS\HealthHubNewJourney\HealthHubPackageController@destroy');
    Route::get('health-hub-feature-package/update-dashboard-id/{id}', 'CMS\HealthHubNewJourney\HealthHubPackageController@updateDashboardId');
    Route::get('health-hub-feature-package/delete-dashboard-id/{id}', 'CMS\HealthHubNewJourney\HealthHubPackageController@deleteDashboardId');
    Route::resource('health-hub-feature-plan', 'CMS\HealthHubNewJourney\HealthHubPlanController');
    Route::get('health-hub-feature-plan/destroy/{id}', 'CMS\HealthHubNewJourney\HealthHubPlanController@destroy');

    Route::get('get-feed-data/{cat_id?}', 'CMS\HealthHubController@getFeedsData')->name('feed.data');

    // Guest User Tracking Page Wise
    Route::get('guest-user-track-list', 'CMS\GuestUserTrackController@index')
        ->name('guest-user-track-list');
    Route::post('guest-user-data-export', 'CMS\GuestUserTrackController@dataExport')
        ->name('guest-user-data-export');
    Route::post('guest-user-show-data', 'CMS\GuestUserTrackController@showData')
        ->name('guest-user-show-data');
    Route::get('guest-user-data-download', 'CMS\GuestUserTrackController@downloadFile');

//    Route::get('non-bl-request-logs', 'CMS\GuestUserTrackController@getNonBlNumberLogs')
//        ->name('non-bl-request-logs');

    // Health Hub
    Route::resource('health-hub', 'CMS\HealthHubController')->except(['show', 'destroy']);
    Route::get('health-hub-auto-save', 'CMS\HealthHubController@itemSortable');
    Route::get('health-hub/destroy/{id}', 'CMS\HealthHubController@destroy')->name('healthHubItem.destroy');
    Route::get('health-hub-analytic-data', 'CMS\HealthHubController@analyticData')->name('health-hub.analytics');
    Route::get('health-hub-item-details/{itemId}', 'CMS\HealthHubController@analyticReportsItem');

//    Route::get('health-hub-item-details-export', 'CMS\HealthHubController@itemDetailsExport');



    Route::get('get-feed-data/{cat_id?}', 'CMS\HealthHubController@getFeedsData')->name('feed.data');
    //Loyality Image Upload
    Route::resource('loyalty-partner-image', 'CMS\LoyaltyPartnerImageController')->except(['show']);
    Route::get('loyalty-partner-images/filter', 'CMS\LoyaltyPartnerImageController@filter');
    Route::get('loyalty-partner-images/report', 'CMS\LoyaltyPartnerImageController@report');

    /**
     * SMS Language Config
     */
    Route::get('sms-languages', 'CMS\SmsLanguageController@index')->name('sms-languages.index');
    Route::get('sms-languages/create', 'CMS\SmsLanguageController@create')->name('sms-languages.create');
    Route::get('sms-languages/edit/{id}', 'CMS\SmsLanguageController@edit')->name('sms-languages.edit');
    Route::post('sms-languages/store', 'CMS\SmsLanguageController@store')->name('sms-languages.store');
    Route::put('sms-languages/update/{id}', 'CMS\SmsLanguageController@update')->name('sms-languages.update');

    /**
     * New Campaign Modality
     */
    Route::resource('new-campaign-modality', 'CMS\MyBlNewCampaignModalityController')->except(['show', 'destroy']);
    Route::get('new-campaign-modality/destroy/{id}', 'CMS\MyBlNewCampaignModalityController@destroy');
    Route::get('new-campaign-analytic/{campaign_id}', 'CMS\MyBlNewCampaignModalityController@analyticReport')
        ->name('new-campaign-analytic.report');
    Route::get('new-campaign-purchase-msisdn-list/{campaignId}/{purchaseID}', 'CMS\MyBlNewCampaignModalityController@purchaseMsisdnList')
        ->name('new-campaign.purchase-msisdn.list');

    Route::resource('mybl-campaign-section', 'CMS\NewCampaignModality\MyBlCampaignSectionController')->except(['show', 'destroy']);
    Route::get('mybl-campaign-section/destroy/{id}', 'CMS\NewCampaignModality\MyBlCampaignSectionController@destroy')->name('mybl-campaign-section.destroy');
    Route::get('mybl-campaign-section/sort-auto-save', 'CMS\NewCampaignModality\MyBlCampaignSectionController@categorySortable');

    Route::resource('mybl-campaign-winners', 'CMS\NewCampaignModality\MyBlCampaignWinnerController')->except(['show', 'destroy']);
    Route::get('mybl-campaign-winners/destroy/{id}', 'CMS\NewCampaignModality\MyBlCampaignWinnerController@destroy')->name('mybl-campaign-winner.destroy');
    /**
     * Home Navigation Rail
     */
    Route::resource('heme-navigation-rail', 'CMS\HomeNavigationRailController');
    Route::get('heme-navigation-rail-sortable', 'CMS\HomeNavigationRailController@navigationMenuSortable')
        ->name('navigation-rail.sort');
    Route::get('heme-navigation-rail/destroy/{id}', 'CMS\HomeNavigationRailController@destroy')
        ->name('heme-navigation-rail.destroy');

    Route::resource('mybl-campaign-winners', 'CMS\NewCampaignModality\MyBlCampaignWinnerController')->except(['show', 'destroy']);
    Route::get('mybl-campaign-winners/destroy/{id}', 'CMS\NewCampaignModality\MyBlCampaignWinnerController@destroy')->name('mybl-campaign-winner.destroy');
    /**
     * Orange CLub Banner
     */
    Route::resource('orange-club', 'CMS\MyblOrangeClubBannerController');
    Route::resource('orange-club-redeem', 'CMS\MyblOrangeClubRedeemDetailController');
    Route::delete('orange-club/{id}/delete', 'CMS\MyblOrangeClubBannerController@destroy')->name('orange-club.destroy');
    Route::get('orange-club/addImage/update-position', 'CMS\MyblOrangeClubBannerController@updatePosition');
    /**
     * Ad Tech
     */
    Route::resource('ad-tech', 'CMS\MyblAdTechController');
    Route::delete('ad-tech/{id}/delete', 'CMS\MyblAdTechController@destroy')->name('orange-club.destroy');
    Route::get('ad-tech/addImage/update-position', 'CMS\MyblAdTechController@updatePosition');

    /**
     * Commerce Bill Category
     */
    Route::resource('commerce-bill-category', 'CMS\CommerceBillCategoryController')->except(['show', 'destroy']);
    Route::get('commerce-bill-category/destroy/{id}', 'CMS\CommerceBillCategoryController@destroy')->name('commerce-bill-category.destroy');
    Route::get('commerce-bill-category/sort-auto-save', 'CMS\CommerceBillCategoryController@categorySortable');

    /**
     * Commerce Bill Category
     */
    Route::resource('commerce-bill-utility', 'CMS\CommerceBillUtilityController')->except(['show', 'destroy']);
    Route::get('commerce-bill-utility/destroy/{id}', 'CMS\CommerceBillUtilityController@destroy')->name('commerce-bill-utility.destroy');
    Route::get('commerce-bill-utility/sort-auto-save', 'CMS\CommerceBillUtilityController@categorySortable');
    /**
     * Home Navigation Rail
     */
    Route::resource('heme-navigation-rail', 'CMS\HomeNavigationRailController');
    Route::get('heme-navigation-rail-sortable', 'CMS\HomeNavigationRailController@navigationMenuSortable')
        ->name('navigation-rail.sort');
    Route::get('heme-navigation-rail/destroy/{id}', 'CMS\HomeNavigationRailController@destroy')
        ->name('heme-navigation-rail.destroy');

    /**
     * Content Deeplink
     */
    Route::get('content-deeplink', 'CMS\ContentDeeplinkController@index')->name('content-deeplink.index');
    Route::post('content-deeplink', 'CMS\ContentDeeplinkController@store')->name('content-deeplink.store');
    Route::get('content-deeplink/destroy/{id}', 'CMS\ContentDeeplinkController@destroy')
        ->name('content-deeplink.destroy');

    /**
     * Content Navigation Rail
     */
    Route::resource('content-navigation-rail', 'CMS\ContentNavigationRailController');
    Route::get('content-navigation-rail-sortable', 'CMS\ContentNavigationRailController@navigationMenuSortable')
        ->name('content-navigation-rail.sort');
    Route::get('content-navigation-rail/destroy/{id}', 'CMS\ContentNavigationRailController@destroy')
        ->name('content-navigation-rail.destroy');


    /**
     * FIFA WC
     */
    Route::resource('teams', 'CMS\FIFA\TeamController');
    Route::get('teams/destroy/{id}', 'CMS\FIFA\TeamController@destroy')
        ->name('teams.destroy');

    Route::resource('matches', 'CMS\FIFA\MatchController');
    Route::get('matches/destroy/{id}', 'CMS\FIFA\MatchController@destroy')
        ->name('matches.destroy');

    Route::get('signed-cookie', 'CMS\FIFA\MatchController@signedCookie')->name('signed-cookie');
    Route::get('generate-cookie/{id}', 'CMS\FIFA\MatchController@generateCookie')
        ->name('generate-cookie');

    Route::get('fifa-content', 'CMS\FIFA\FifaContentController@createOrEdit')->name('fifa-content');

    Route::post('fifa-content', 'CMS\FIFA\FifaContentController@store')
        ->name('fifa-content.update');

    /**
     * Fifa Deeplink
     */
    Route::get('fifa-deeplink', 'CMS\FIFA\FifaDeeplinkController@index')->name('fifa-deeplink');
    Route::post('fifa-deeplink', 'CMS\FIFA\FifaDeeplinkController@store')->name('fifa-deeplink.store');
    Route::get('fifa-deeplink/destroy/{id}', 'CMS\FIFA\FifaDeeplinkController@destroy')
        ->name('fifa-deeplink.destroy');

    //Mybl Popup Banner
    Route::resource('popup-banner', 'CMS\PopupBannerController');
    Route::get('popup-banner-sort-auto-save', 'CMS\PopupBannerController@bannerSortable');
    Route::get('popup-banner/destroy/{id}', 'CMS\PopupBannerController@destroy');
    Route::resource('popup-sequence', 'CMS\PopupPrioritizationController');

    Route::resource('gamification', 'CMS\TriviaGamificationController');
    Route::get('gamification-list', 'CMS\TriviaGamificationController@getGamificationForAjax')->name('gamification.ajax.request');



    // PGW Routes
    Route::resource('pgw-gateway', 'CMS\PgwGatewayController');
    Route::get('pgw-gateway/destroy/{id}', 'CMS\PgwGatewayController@destroy')->name('pgw-gateway.destroy');

    // Group Components
    Route::get('group-components', 'CMS\GroupComponentController@index')->name('group.components');
    Route::get('group-components/create', 'CMS\GroupComponentController@create')->name('group.components.create');
    Route::post('group-components/store', 'CMS\GroupComponentController@store')->name('group.components.store');
    Route::get('group-components/edit{id}', 'CMS\GroupComponentController@edit')->name('group.components.edit');
    Route::post('group-components/update/{id}', 'CMS\GroupComponentController@update')->name('group.components.update');
    Route::get('group-components/destroy/{id}', 'CMS\GroupComponentController@destroy')->name('group.components.destroy');
    Route::get('group-components-status-update/{id}', 'CMS\GroupComponentController@componentStatusUpdate')->name('group.components.status.update');


    // Non Bl Components
    Route::get('non-bl-components', 'CMS\NonBlComponentController@index')->name('nonbl.components');
    Route::get('non-bl-components-sort', 'CMS\NonBlComponentController@componentSort');
    Route::get('non-bl-components-status-update/{id}', 'CMS\NonBlComponentController@componentStatusUpdate')->name('nonbl.components.status.update');
    Route::post('non-bl-components/store', 'CMS\NonBlComponentController@store')->name('nonbl.components.store');
    Route::get('non-bl-components/edit/{id}', 'CMS\NonBlComponentController@edit')->name('nonbl.components.edit');
    Route::post('non-bl-components/update', 'CMS\NonBlComponentController@update')->name('nonbl.components.update');
    Route::get('non-bl-components/destroy/{id}', 'CMS\NonBlComponentController@destroy')->name('nonbl.components.destroy');

    Route::get('/non-bl-offers', 'CMS\NonBlOfferController@index')->name('nonbl.offers');
    Route::get('non-bl-offers-status-update/{id}', 'CMS\NonBlOfferController@offerStatusUpdate')->name('nonbl.offers.status.update');
    Route::get('non-bl-offers-components-sort', 'CMS\NonBlOfferController@componentSort');

    Route::resource('nonbl-navigation-rail', 'CMS\NonBlNavigationRailController');
    Route::get('nonbl-navigation-rail-sortable', 'CMS\NonBlNavigationRailController@navigationMenuSortable')
        ->name('nonbl-navigation-rail.sort');
    Route::get('nonbl-navigation-rail/destroy/{id}', 'CMS\NonBlNavigationRailController@destroy')
        ->name('nonbl-navigation-rail.destroy');

    //Payment Gateway
    Route::resource('payment-gateways', 'CMS\PaymentGatewayController')->except(['show', 'destroy']);
    Route::get('payment-gateways/destroy/{id}', 'CMS\PaymentGatewayController@destroy')->name('payment-gateways.destroy');
    Route::get('payment-gateways/sort-auto-save', 'CMS\PaymentGatewayController@categorySortable');

    //Active new Product Code
    Route::get('redis-key-update-view', 'CMS\MyblProductEntryController@redisKeyUpdateView')->name('active-product-redis-key.update.view');
    Route::get('redis-key-update', 'CMS\MyblProductEntryController@redisKeyUpdate')->name('active-product-redis-key.update');


    //Commerce Component
    Route::get('mybl-commerce-components', 'CMS\MyBlCommerceComponentController@index')->name('mybl.commerce.components');
    Route::get('mybl-commerce-components/edit/{id}', 'CMS\MyBlCommerceComponentController@edit')
        ->name('mybl.commerce.components.edit');
    Route::post('mybl-commerce-components/store', 'CMS\MyBlCommerceComponentController@store')
        ->name('mybl.commerce.components.store');
    Route::post('mybl-commerce-components/update', 'CMS\MyBlCommerceComponentController@update')
        ->name('mybl.commerce.components.update');
    Route::get('mybl-commerce-components-sort', 'CMS\MyBlCommerceComponentController@componentSort');
    Route::get('commerce-components-status-update/{id}', 'CMS\MyBlCommerceComponentController@componentStatusUpdate')
        ->name('commerce-components.status.update');
    Route::get('mybl-commerce-components/destroy/{id}', 'CMS\MyBlCommerceComponentController@destroy')
        ->name('mybl.commerce.components.destroy');

    /**
     * Commerce Bill Category
     */
    Route::resource('utility-bill', 'CMS\UtilityBillController')->except(['show', 'destroy']);
    Route::get('utility-bill/destroy/{id}', 'CMS\UtilityBillController@destroy')->name('utility-bill.destroy');
    Route::get('utility-bill/sort-auto-save', 'CMS\UtilityBillController@categorySortable');
    Route::get('utility-bill-deeplink/create', 'CMS\DynamicDeeplinkController@commerceBillUtilityDeepLinkCreate');
    Route::get('commerce-bill-status-view', 'CMS\UtilityBillController@showCommerceBill')->name('commerce-bill-status-view');
    Route::get('commerce-bill-status', 'CMS\UtilityBillController@getCommerceTransaction')->name('commerce-bill-status');

    /**
     * Commerce Bill Category
     */
    Route::resource('travel', 'CMS\TravelAgencyController')->except(['show', 'destroy']);
    Route::get('travel/destroy/{id}', 'CMS\TravelAgencyController@destroy')->name('travel.destroy');
    Route::get('travel/sort-auto-save', 'CMS\TravelAgencyController@categorySortable');

    /**
     * Commerce Navigation Rail
     */
    Route::resource('commerce-navigation-rail', 'CMS\CommerceNavigationRailController');
    Route::get('commerce-navigation-rail-sortable', 'CMS\CommerceNavigationRailController@navigationMenuSortable')
        ->name('commerce-navigation-rail.sort');
    Route::get('commerce-navigation-rail/destroy/{id}', 'CMS\CommerceNavigationRailController@destroy')
        ->name('commerce-navigation-rail.destroy');

    Route::resource('generic-slider', 'CMS\GenericSliderController');
    Route::get('generic-slider/destroy/{id}', 'CMS\GenericSliderController@destroy');
    Route::get('generic-slider/{slider_id}/images', 'CMS\GenericSliderImageController@index')->name('generic-slider.images.index');
    Route::get(
        'generic-slider/{slider_id}/images/create',
        'CMS\GenericSliderImageController@create'
    )->name('generic-slider.images.create');
    Route::post('generic-slider/images/store', 'CMS\GenericSliderImageController@store')->name('generic-slider.images.store');
    Route::get('generic-slider/images/{id}/edit', 'CMS\GenericSliderImageController@edit')->name('generic-slider.images.edit');
    Route::put(
        'generic-slider/images/{id}/update',
        'CMS\GenericSliderImageController@update'
    )->name('generic-slider.images.update');
    Route::put(
        'generic-slider/images/{id}/update',
        'CMS\GenericSliderImageController@update'
    )->name('generic-slider.images.update');
    Route::delete(
        'generic-slider/images/{id}/delete',
        'CMS\GenericSliderImageController@destroy'
    )->name('generic-slider.images.destroy');
    Route::get('generic-slider/addImage/update-position', 'CMS\GenericSliderImageController@updatePosition');


    /*
     *  Transaction status report
     */

    #Course
    Route::get('mybl/course-transaction-status-report-view', 'CMS\MyblTransactionStatusController@index')->name('mybl.transaction-status.course');
    Route::get('mybl/course-transaction-status-report', 'CMS\MyblTransactionStatusController@getCourseTransaction')
        ->name('mybl.transaction-status.course.list');

    #Music
    Route::get('mybl/music-transaction-status-report-view', 'CMS\MyblTransactionStatusController@musicTransactionList')->name('mybl.transaction-status.music');
    Route::get('mybl/music-transaction-status-report', 'CMS\MyblTransactionStatusController@getMusicTransaction')
        ->name('mybl.transaction-status.music.list');

    #ShareTrip
    Route::get('mybl/sharetrip-transaction-status-report-view', 'CMS\MyblTransactionStatusController@sharetripTransactionList')->name('mybl.transaction-status.sharetrip');
    Route::get('mybl/sharetrip-transaction-status-report', 'CMS\MyblTransactionStatusController@getSharetripTransaction')
        ->name('mybl.transaction-status.sharetrip.list');

    #DocTime
    Route::get('mybl/doctime-transaction-status-report-view', 'CMS\MyblTransactionStatusController@doctimeTransactionList')->name('mybl.transaction-status.doctime');
    Route::get('mybl/doctime-transaction-status-report', 'CMS\MyblTransactionStatusController@getDoctimeTransaction')
        ->name('mybl.transaction-status.doctime.list');

    /**
     * Have Plane to put all transaction status under one controller and service
     * onmobile
     */
    Route::get('mybl/{type}/transaction-status-report-view', 'CMS\MyblTransactionStatusController@getTransactionList')->name('mybl.transaction-status');
    Route::get('mybl/{type}/transaction-status-report', 'CMS\MyblTransactionStatusController@getTransaction')
        ->name('mybl.transaction-status.list');

    /**
     * Generic Carousel
     * Live content
     */
    Route::resource('generic-carousel', 'CMS\GenericCarouselController');
    Route::get('generic-carousel/destroy/{id}', 'CMS\GenericCarouselController@destroy');
    Route::get('generic-carousel/addImage/update-position', 'CMS\GenericCarouselController@updatePosition');


    /**
     * Internet Gift content
     */
    Route::resource('internet-gift-content', 'CMS\InternetGiftContentController');
    Route::get('internet-gift-content/destroy/{id}', 'CMS\InternetGiftContentController@destroy');
    Route::get('internet-gift-content/addImage/update-position', 'CMS\InternetGiftContentController@updatePosition');

    Route::resource('global-settings', 'CMS\GlobalSettingController');
    Route::resource('media', 'CMS\MediaController');

    /**
     * Product Special Type
     */
    Route::resource('product-special-types', 'CMS\MyBlSpecialTypeController');
    Route::get('product-special-types/destroy/{id}', 'CMS\MyBlSpecialTypeController@destroy');
    Route::get('product-special-types/addImage/update-position', 'CMS\MyBlSpecialTypeController@updatePosition');

    /**
     * Free Product Disburse file Upload
     */
    Route::get('free-product-disburse', 'CMS\MyBlFreeProductDisburseController@freeProductDisburseUploadPanel')->name('free-product-disburse');
    Route::post('free-product-disburse', 'CMS\MyBlFreeProductDisburseController@uploadFreeProductDisburseExcel')->name('free-product-disburse.save');
    Route::get('free-product-disburse-report-view', 'CMS\MyBlFreeProductDisburseController@freeProductDisburseReportView')->name('free-product-disburse-report');
    Route::get('free-product-disburse-report', 'CMS\MyBlFreeProductDisburseController@freeProductDisburseReport')->name('free-product-disburse-report.list');


    Route::resource('global-settings', 'CMS\GlobalSettingController');
    Route::resource('media', 'CMS\MediaController');


    /**
     * Digital Services
     */
    Route::resource('digital-service', 'CMS\MyBlDigitalServiceController');
    Route::get('digital-service/destroy/{id}', 'CMS\MyBlDigitalServiceController@destroy')
        ->name('digital-service.destroy');

    /**
     * Toffee Product
     */

    Route::resource('toffee-product', 'CMS\ToffeeProductController');
    Route::get('toffee-product/destroy/{id}', 'CMS\ToffeeProductController@destroy')
        ->name('toffee-product.destroy');

    Route::resource('toffee-subscription-types', 'CMS\ToffeeSubscriptionTypeController');
    Route::get('toffee-subscription-types/destroy/{id}', 'CMS\ToffeeSubscriptionTypeController@destroy');

    Route::resource('toffee-premium-products', 'CMS\ToffeePremiumProductController');
    Route::get('toffee-premium-products/destroy/{id}', 'CMS\ToffeePremiumProductController@destroy');
//

    /**
     * MyBL Plan Routes
     */
    Route::get('mybl-plan/products', 'CMS\MyBlPlan\MyBlPlanProductController@index')->name('mybl-plan.products');
    Route::get('mybl-plan/products/create', 'CMS\MyBlPlan\MyBlPlanProductController@create')->name("mybl-plan.products.create");
    Route::get('mybl-plan/products/{id}', 'CMS\MyBlPlan\MyBlPlanProductController@edit')->name("mybl-plan.products.edit");
    Route::post('mybl-plan/products/store', 'CMS\MyBlPlan\MyBlPlanProductController@store')->name("mybl-plan.products.store");
    Route::put('mybl-plan/products/update/{id}', 'CMS\MyBlPlan\MyBlPlanProductController@update')->name("mybl-plan.products.update");
    Route::post('mybl-plan/upload-products', 'CMS\MyBlPlan\MyBlPlanProductController@uploadPlanProductExcel')->name("mybl-plan.upload-products");
    Route::post('mybl-plan/products/download', 'CMS\MyBlPlan\MyBlPlanProductController@downloadPlanProducts')->name('mybl-plan.products.download');
    Route::post("mybl-plan/clear-redis-key", 'CMS\MyBlPlan\MyBlPlanProductController@clearRedisKey')->name('mybl-plan.clear-redis-key');

});

// 4G Map View Route
Route::view('/4g-map', '4g-map.view');

Route::get( 'winner-test', function() {
    $myBlCampaignWinnerSelectionService = resolve(MyBlCampaignWinnerSelectionService::class);
    return $myBlCampaignWinnerSelectionService->processCampaignWinner();
  });


Route::get('customer-remove-uat', function (\Illuminate\Http\Request $request) {
    if (isset($request->phone)) {
        $customer = \App\Models\Customer::where('phone', $request->phone)->first();
        if ($customer) {
            $customer->delete();
            return "Customer deleted successfully!";
        }
        return "Customer not found";
    }
});

/**
 * New CMS Token Generate
 */
Route::get('new-cms/verify-token', "Auth\NewCMSAuthController@verifyToken");

Route::get( 'winner-test', function() {
    $myBlCampaignWinnerSelectionService = resolve(MyBlCampaignWinnerSelectionService::class);
    return $myBlCampaignWinnerSelectionService->processCampaignWinner();
  });

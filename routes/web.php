<?php

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

Route::get('/', function () {
    return view('admin.admin-auth.login');
})->name('test');

Auth::routes();


Route::get('/cms', 'CMS\TestCMSController@index');

//Route::resource('sliders', 'SliderController');
//Route::get('slider/{parent_id}/images', 'CMS\SliderImageController@index');
//Route::get('slider-image/{id}/edit', 'CMS\SliderImageController@edit');

// SLIDERS PAGES ====================================
Route::get('sliders', 'SliderController@index');
Route::get('slider/{slider_id}/{type}', 'CMS\SliderImageController@index')->name('slider_images');
Route::get('slider/{slider_id}/{type}/image/create', 'CMS\SliderImageController@create');
Route::post('slider/{slider_id}/{type}/image/store', 'CMS\SliderImageController@store')->name('slider_image_store');
Route::get('slider/{slider_id}/{type}/image/{id}', 'CMS\SliderImageController@edit')->name('slider_image_edit');
Route::put('slider/{slider_id}/{type}/image/{id}/update', 'CMS\SliderImageController@update')->name('slider_image_update');
Route::get('slider/{slider_id}/{type}/image/destroy/{id}', 'CMS\SliderImageController@destroy');
Route::get('/slider-image-sortable','CMS\SliderImageController@sliderImageSortable');




Route::resource('questions', 'CMS\QuestionController');
// Route::resource('prize', 'PrizeController');
Route::resource('tags','TagController');
Route::resource('campaigns','CMS\CampaignController');
// Route::resource('prizes','CMS\PrizeController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

// CONFIG PAGES ====================================
Route::get('config','CMS\ConfigController@index');
Route::put('config/update','CMS\ConfigController@update');

// MENU PAGES ====================================
Route::resource('menu','CMS\MenuController');
Route::get('menu/{parentId}/destroy/{id}', 'CMS\MenuController@destroy');
Route::get('/menu-auto-save','CMS\MenuController@parentMenuSortable');
Route::group(['prefix' => 'menu'], function () {
    Route::get('/{id}/child-menu', 'CMS\MenuController@index');
    Route::get('/{id}/child-menu/create', 'CMS\MenuController@create');
});

// FOOTER MENU PAGES ====================================
Route::resource('footer-menu','CMS\FooterMenuController');
Route::get('footer-menu/{parentId}/destroy/{id}', 'CMS\FooterMenuController@destroy');
Route::get('sort-autosave/parent-footer-sort','CMS\FooterMenuController@parentFooterSortable');
Route::group(['prefix' => 'footer-menu'], function () {
    Route::get('/{id}/child-footer', 'CMS\FooterMenuController@index');
    Route::get('/{id}/child-footer/create', 'CMS\FooterMenuController@create');
});

// QUICK LAUNCH PAGES ====================================
Route::resource('quick-launch','CMS\QuickLaunchController');
Route::get('quick-launch/destroy/{id}', 'CMS\QuickLaunchController@destroy');
Route::get('/quick-launch-sortable','CMS\QuickLaunchController@quickLaunchSortable');


// PARTNERS PAGES ====================================
Route::resource('partners','CMS\PartnerController');
Route::get('partner/destroy/{id}', 'CMS\PartnerController@destroy');
//Route::get('/quick-launch-sortable','CMS\QuickLaunchController@quickLaunchSortable');


//Route::get('quick-launch-panel', 'CMS\QuickLaunchController@index');

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


Route::get('/cms', 'CMS\TestCMSController@index');

Route::resource('sliders', 'SliderController');
Route::resource('slider_image', 'SliderImageController');
Route::resource('questions', 'CMS\QuestionController');
// Route::resource('prize', 'PrizeController');
Route::resource('tags','TagController');
Route::resource('campaigns','CMS\CampaignController');
// Route::resource('prizes','CMS\PrizeController');

Route::resource('footer-menu','CMS\FooterMenuController');
Route::get('footer-menu/destroy/{id}', 'CMS\FooterMenuController@destroy');
Route::get('sort-autosave/parent-footer-sort','CMS\FooterMenuController@parentFooterSortable');

Route::group(['prefix' => 'footer-menu'], function () {
    Route::get('/{id}/child-footer', 'CMS\FooterMenuController@index');
    Route::get('/{id}/child-footer/create', 'CMS\FooterMenuController@create');

//    Route::post('/{id}/store', 'CMS\FooterMenuController@storeChildMenu');
//    Route::get('/{id}/edit/{parentId}', 'CMS\FooterMenuController@childEdit');
//    Route::put('/{id}/update', 'CMS\FooterMenuController@childUpdate');
//    Route::get('/{parentId}/delete/{id}', 'CMS\FooterMenuController@destroyChildMenu');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');


Route::resource('menu','CMS\MenuController');
Route::get('/menu-auto-save','CMS\MenuController@parentMenuSortable');

Route::group(['prefix' => 'menu'], function () {
    Route::get('/{id}/child_menu', 'CMS\MenuController@index');
    Route::get('/{id}/child-menu/create', 'CMS\MenuController@create');

    // Route::post('/{id}/child_menu/store', 'CMS\MenuController@store');
    // Route::get('/{id}/child_menu/edit', 'CMS\MenuController@childEdit');
    // Route::put('/{id}/child_menu/update', 'CMS\MenuController@childUpdate');
});

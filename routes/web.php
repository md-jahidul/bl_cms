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

Route::resource('menu','CMS\MenuController');


Route::group(['prefix' => 'child-footer'], function () {
    Route::get('/{id}', 'CMS\FooterMenuController@footerChildList');
    Route::get('/{id}/create', 'CMS\FooterMenuController@createChildMenu');
    Route::post('/{id}/store', 'CMS\FooterMenuController@storeChildMenu');
    Route::get('/{id}/edit/{parentId}', 'CMS\FooterMenuController@childEdit');
    Route::put('/{id}/update', 'CMS\FooterMenuController@childUpdate');
    Route::delete('/{id}/delete/{parentId}', 'CMS\FooterMenuController@destroyChildMenu');

    Route::get('/{id}/child_sub_menu', 'CMS\FooterMenuController@childSubList');
    Route::get('/{id}/child_sub_create', 'CMS\FooterMenuController@childSubForm');
    Route::post('/{id}/child_menu_store', 'CMS\FooterMenuController@childStore');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

//Route::get('')

Route::group(['prefix' => 'menu'], function () {
    // Route::get('/', 'CMS\MenuController@index');
    // Route::get('/create', 'CMS\MenuController@create');
    // Route::post('/store', 'CMS\MenuController@store')->name('menu.store');
    // Route::get('/{id}/edit', 'CMS\MenuController@edit');
    // Route::put('{id}/', 'CMS\MenuController@update')->name('menu.update');

    // Route::get('/destroy/{id}', 'CMS\MenuController@destroy');
    // Route::get('/parent_menu_sort','CMS\MenuController@parentMenuSortable');

    Route::get('/{id}/child_menu', 'CMS\MenuController@childList');
    // Route::get('/{id}/child_menu_create', 'CMS\MenuController@childForm');
    // Route::post('/{id}/child_menu_store', 'CMS\MenuController@childStore');
    // Route::get('/{id}/child_edit', 'CMS\MenuController@childEdit');
    // Route::put('/{id}/child_update', 'CMS\MenuController@childUpdate');

    // Route::get('/{id}/child_sub_menu', 'CMS\MenuController@childSubList');
    // Route::get('/{id}/child_sub_create', 'CMS\MenuController@childSubForm');
    // Route::post('/{id}/child_menu_store', 'CMS\MenuController@childStore');
});

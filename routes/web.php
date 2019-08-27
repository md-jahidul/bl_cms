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
});


Route::get('/cms', 'CMS\TestCMSController@index');

Route::resource('question', 'QuestionController');

Route::group(['prefix'=>'question'], function(){
    Route::get('/', ['uses' => 'QuestionController@index']);
    Route::get('/create', ['uses' => 'QuestionController@create']);
    Route::post('/store', ['uses' => 'QuestionController@store'])->name('question.store');
    Route::put('/update/{id}', ['uses' => 'QuestionController@update'])->name('question.update');
    Route::get('/edit/{id}', ['uses' => 'QuestionController@edit']);
});

Route::group(['prefix'=>'users'], function(){
    Route::get('/', ['uses' => 'Users\UserController@index']);
    Route::get('/store', ['uses' => 'Users\UserController@store'])->name('page.store');
    Route::delete('/destroy/{id}', ['uses' => 'Users\UserController@destroy'])->name('page.destroy');
    Route::put('/update/{id}', ['uses' => 'Users\UserController@update'])->name('page.update');
});


Route::group(['prefix'=>'page-builder'], function(){
    Route::get('/', ['middleware' => 'cross', 'uses' => 'API\PageBuilderApiController@index']);
    Route::get('/store', ['uses' => 'API\PageBuilderApiController@store'])->name('page.store');
});


Route::resource('sliders','SliderController');
Route::resource('slider_image','SliderImageController');
Route::get('slider_image/destroy/{id}','SliderImageController@destroy');

Route::group(['prefix'=>'menu'], function(){
    Route::get('/', 'CMS\MenuController@index');
    Route::get('/create', 'CMS\MenuController@create');
    Route::post('/store', 'CMS\MenuController@store')->name('menu.store');
    Route::get('/{id}/edit', 'CMS\MenuController@edit');
    Route::put('{id}/', 'CMS\MenuController@update')->name('menu.update');
    Route::get('/destroy/{id}','CMS\MenuController@destroy');
    Route::get('/parent_menu_sort','CMS\MenuController@parentMenuSortable');

    Route::get('/{id}/child_menu', 'CMS\MenuController@childList');
    Route::get('/{id}/child_menu_create', 'CMS\MenuController@childForm');
    Route::post('/{id}/child_menu_store', 'CMS\MenuController@childStore');
    Route::get('/{id}/child_edit', 'CMS\MenuController@childEdit');
    Route::put('/{id}/child_update', 'CMS\MenuController@childUpdate');

    Route::get('/{id}/child_sub_menu', 'CMS\MenuController@childSubList');
    Route::get('/{id}/child_sub_create', 'CMS\MenuController@childSubForm');
    Route::post('/{id}/child_menu_store', 'CMS\MenuController@childStore');

});

//Route::resource('menu','CMS\MenuController');
//Route::get('menu/child_menu/retret','CMS\MenuController@childList');
//Route::get('menu/destroy/{id}','CMS\MenuController@destroy');

Route::resource('tag','TagController');
Route::get('tag/destroy/{id}','TagController@destroy');

Route::resource('page','PageBuilderController');
Route::resource('campaign','CampaignController');
Route::resource('prize','PrizeController');

Route::resource('digital_service','DigitalServiceController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

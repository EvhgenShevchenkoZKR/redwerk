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
    return view('welcome');
});

Route::POST('/ajax-reorder', 'MenuController@ajaxReorder');
Route::POST('/ajax-slider', 'SliderController@ajaxReorder');


Route::group(
    [
        'prefix' => 'adm',
        'middleware' => ['auth']
    ],
    function()
    {
        Route::post('menu/add', 'MenuController@store');
        Route::get('menu/add', 'MenuController@create');
        Route::patch('menu/{menu}/edit', 'MenuController@update');
        Route::get('menu/{menu}/edit', 'MenuController@edit');
        Route::get('menus', 'MenuController@adminIndex');
        Route::delete('menu/{menu}/delete', 'MenuController@remove');

        Route::post('slider/add', 'SliderController@store');
        Route::get('slider/add', 'SliderController@create');
        Route::patch('slider/{slider}/edit', 'SliderController@update');
        Route::get('slider/{slider}/edit', 'SliderController@edit');
        Route::get('sliders', 'SliderController@adminIndex');
        Route::delete('slider/{slider}/delete', 'SliderController@remove');


        Route::post('subscription/delivery', 'SubscriptionController@delivery');
        Route::get('subscriptions', 'SubscriptionController@adminIndex');
        Route::delete('subscription/{subscription}/delete', 'SubscriptionController@remove');
    }
);

Route::post('subscription/add', 'SubscriptionController@store');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/', 'HomeController@index');
Route::get('/terms', 'HomeController@terms');

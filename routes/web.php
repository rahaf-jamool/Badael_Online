<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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

Auth::routes([
    'register' => false
]);

Route::get('/', function () {
    return view('welcome');
});
// change language
//Route::get('locale/{locale}','Languages\LanguageController@changeLang');

Route::prefix(LaravelLocalization::setLocale())->group(function () {

Route::prefix('admin')->middleware(['auth'])->group(function () {


//        Route::group([
//        'prefix' =>  LaravelLocalization::setLocale(),
//        'middleware' => [ 'auth']
//    ], function() {

        Route::group(['namespace' => 'User'], function () {
            Route::get('dashboard', 'UserController@dashboard')->name('admin.dashboard');
        });

        // Manage Portfolio Categories
        Route::group(['prefix' => 'portfolio-categories', 'namespace' => 'Pcategory'], function () {
            Route::get('/', 'PcategoryController@index')->name('admin.pcategory');
            Route::post('/', 'PcategoryController@store')->name('admin.pcategory.store');
            Route::get('/edit/{id}', 'PcategoryController@edit')->name('admin.pcategory.edit');
            Route::post('/edit/{id}', 'PcategoryController@update')->name('admin.pcategory.update');
            Route::delete('/destroy/{id}', 'PcategoryController@destroy')->name('admin.pcategory.destroy');
        });
        // Manage Portfolio
        Route::group(['prefix' => 'portfolio', 'namespace' => 'Portfolio'], function () {
            Route::get('/', 'PortfolioController@index')->name('admin.portfolio');
            Route::get('/create', 'PortfolioController@create')->name('admin.portfolio.create');
            Route::post('/create', 'PortfolioController@store')->name('admin.portfolio.store');
            Route::get('/edit/{id}', 'PortfolioController@edit')->name('admin.portfolio.edit');
            Route::post('/edit/{id}', 'PortfolioController@update')->name('admin.portfolio.update');
            Route::delete('/destroy/{id}', 'PortfolioController@destroy')->name('admin.portfolio.destroy');
        });
        //  // Manage Admin
        Route::group(['prefix' => 'users', 'namespace' => 'User'], function () {
            Route::get('/', 'UserController@index')->name('admin.user');
            Route::get('/create', 'UserController@create')->name('admin.user.create');
            Route::post('/create', 'UserController@store')->name('admin.user.store');
            Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
            Route::post('/edit/{id}', 'UserController@update')->name('admin.user.update');
            Route::delete('/destroy/{id}', 'UserController@destroy')->name('admin.user.destroy');
            Route::post('/{id}', 'UserController@changepassword')->name('admin.user.changepassword');

        });
    });
});


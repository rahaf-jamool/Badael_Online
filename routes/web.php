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

Route::prefix(LaravelLocalization::setLocale())->group(function () {

    Route::prefix('admin')->middleware(['auth'])->group(function () {


        Route::group(['namespace' => 'User'], function () {
            Route::get('dashboard', 'UserController@dashboard')->name('admin.dashboard');
        });

        // Manage Portfolio Categories
        Route::group([ 'namespace' => 'PortfolioCategory'], function () {
            Route::resource ('portfoliocategories','PortfolioCategoryController');
        });
        // Manage Portfolio
        Route::group(['namespace' => 'Portfolio'], function () {
            Route::resource ('portfolios','PortfolioController');
        });
        // Manage Admin
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


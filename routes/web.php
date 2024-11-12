<?php

use App\Http\Controllers\Backend\Action\CitymapController;
use App\Http\Controllers\Backend\Action\DealsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);
    Route::resource('routes', 'Backend\Action\JourneyController', ['names' => 'admin.routes']);
    Route::resource('operators', 'Backend\Action\OperatorController', ['names' => 'admin.operators']);
    Route::resource('providers', 'Backend\Action\ProviderController', ['names' => 'admin.providers']);
    Route::resource('deals', 'Backend\Action\DealsController', ['names' => 'admin.deals']);
    Route::resource('faqs', 'Backend\Action\FaqsController', ['names' => 'admin.faqs']);
    Route::resource('cities', 'Backend\Action\CityController', ['names' => 'admin.cities']);
    Route::resource('countries', 'Backend\Action\CountryController', ['names' => 'admin.countries']);
    Route::get('/get-options/{id}', [DealsController::class, 'getPagesbyId'])->name('get.options');

    //Populars Routes mapping with city
    Route::get('/citymap', [CitymapController::class, 'getPopularRoutes'])->name('admin.citymap.index');
    Route::post('/citymap', [CitymapController::class, 'storePopularRoute'])->name('admin.citymap.store');
    Route::get('/citymap/create', [CitymapController::class, 'createPopularRoute'])->name('admin.citymap.create');
    Route::put('/citymap/{citymap}', [CitymapController::class, 'updatePopularRoute'])->name('admin.citymap.update');
    Route::get('/citymap/{citymap}/edit', [CitymapController::class, 'editPopularRoute'])->name('admin.citymap.edit');
    //Route::get('/citymap/{citymap}', [CitymapController::class, 'getPopularRoutes'])->name('admin.citymap.show');

    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    //Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    //Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});

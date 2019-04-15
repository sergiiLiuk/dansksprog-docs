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

Route::get('/{any}', function(){
    return view('layouts/app');
})->where('any', '.*');


Route::get('/', 'PagesController@index');
Route::resource('documents', 'DocumentsController');
/*Route::resource('files', 'FileUploadController');
Route::get('/about', 'PagesController@about');
Auth::routes();
Route::resource('user/dashboard', 'UserDashboardController');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
//Route::resource('/user/documents', 'UserDashboardController');
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminDashboardController@index')->name('admin.dashboard');
    Route::resource('/documents', 'AdminDashboardController');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});*/
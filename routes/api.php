<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List documents
Route::get('documents', 'DocumentsController@index');

// List single document
Route::get('document/{id}', 'DocumentsController@show');

// Create new document
Route::post('document', 'DocumentsController@store');

// Update document
Route::put('document', 'DocumentsController@store');

// Delete document
Route::delete('document/{id}', 'DocumentsController@destroy');
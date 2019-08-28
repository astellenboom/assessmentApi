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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



//api end point to login
Route::post('login', 'API\UserController@login');

//api end point to register
Route::post('register', 'API\UserController@register');
//api end point to upload an image
Route::post('imageupload','API\ImageUploadController@imagePost');

//api end point to get all image by ID

Route::post('getAllImages','API\ImageUploadController@getAllImages');

//api end point to search all for all image by name
Route::post('searchImages','API\ImageUploadController@searchImages');



Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\UserController@details');

});
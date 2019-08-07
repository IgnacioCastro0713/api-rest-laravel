<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('register', 'Auth\RegisterController@register')->name('register.api');
});

Route::middleware('jwt')->group(function () {

    /*Routes controller*/

    Route::apiResources([
        'user' => 'API\UserController',
        'category' => 'API\CategoryController',
        'post' => 'API\CategoryController'
    ]);

    /*single routes*/

    //UserController
    Route::post('user/upload', 'API\UserController@upload')->name('user.upload');

    //CategoryController

    //PostController

});



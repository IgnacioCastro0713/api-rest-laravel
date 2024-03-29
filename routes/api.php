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

Route::get('/', function () {
    return response()->json([
        'title' => 'Blog - Api Rest Ful and JWT Token (Back-End)'
    ]);
});

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register')->name('register.api');
});

Route::middleware('jwt')->group(function () {

    /*Routes controller*/

    Route::apiResources([
        'user' => 'API\UserController',
        'category' => 'API\CategoryController',
        'post' => 'API\PostController'
    ]);

    /*single routes*/

    //UserController
    Route::post('user/upload', 'API\UserController@upload')->name('user.upload');

    //PostController
    Route::post('post/upload', 'API\PostController@upload')->name('post.upload');
    Route::get('post/image/{filename}', 'API\PostController@getImage')->name('post.image');
    Route::get('post/category/{id}', 'API\PostController@getPostByCategory')->name('post.category');
    Route::get('post/user/{id}', 'API\PostController@getPostByUser')->name('post.user');

});

Route::get('user/image/{filename}', 'API\UserController@getImage')->name('user.avatar');





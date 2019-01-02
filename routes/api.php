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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function() {
    Route::get('blogs', 'PostController@index')->name('blogs');
    Route::get('rating-reviews', 'RatingReviewController@get')->name('more.review');
    Route::resource('registers', 'RegisterController', ['only' => ['store']]);
    Route::get('suggestion', 'HomeController@suggestion')->name('suggestion');
    Route::post('akulaku/change-status', 'AkuLakuController@changeStatus')->name('akulaku.change-status');
    Route::get('akulaku/inquiry-status', 'AkuLakuController@inquiryStatus')->name('akulaku.inquiry-status');
});

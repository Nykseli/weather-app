<?php
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
header('Access-Control-Allow-Credentials:  true');
use Illuminate\Http\Request;
use App\Http\Controllers\WeatherController;

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


// Login needs to be name as login so laravel know how to redirect
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\RegisterController@register');


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('weather/{city}', 'WeatherController@getCity');
});

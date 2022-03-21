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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'APIUserController@login');
Route::post('register', 'APIUserController@register');
Route::get('token', 'DashboardController@getToken');

Route::group(['middleware' => ['auth.jwt']], function () {
    Route::get('verify', 'APIUserController@verify');
    Route::get('logout', 'APIUserController@logout');
    Route::get('dashboard', 'DashboardController@index');
});
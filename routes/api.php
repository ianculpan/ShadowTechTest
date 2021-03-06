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

Route::get('books', '\App\Http\Controllers\Books@getBookData');
Route::get('authors', '\App\Http\Controllers\Books@getAuthors');
Route::get('count', '\App\Http\Controllers\Books@getCount');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

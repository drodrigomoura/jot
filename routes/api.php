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

// Route::apiResource('contacts', 'ContactsController');
Route::post('/contacts', 'ContactsController@store')->name('contacts.store');
Route::get('/contacts/{contact}', 'ContactsController@show')->name('contacts.show');
Route::patch('/contacts/{contact}', 'ContactsController@update')->name('contacts.update');
Route::delete('/contacts/{contact}', 'ContactsController@destroy')->name('contacts.destroy');

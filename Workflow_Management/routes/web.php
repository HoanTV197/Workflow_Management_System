<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('calendar');
});
// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('admin' , 'Admin');


//fullcalender
Route::get('calendar','App\Http\Controllers\CalendarController@index');
Route::post('calendar/create','App\Http\Controllers\CalendarController@create');
Route::post('calendar/update','App\Http\Controllers\CalendarController@update');
Route::post('calendar/delete','App\Http\Controllers\CalendarController@destroy');

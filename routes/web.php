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
    return view('welcome');
});
Route::get('/put/{no}', function () {
    //$name = request('name');
    return view('put/{no}');
});

//Route::get('/welcome/{id}', 'db_test@db_test');
// Route::middleware('auth')->group(function () {
    Route::get('/todolist', 'Todocontroller@readTable');
    Route::put("/update", 'Todocontroller@update');
    Route::post('/create', 'Todocontroller@create');
    Route::delete('/delete', 'Todocontroller@delete');
// });

// Route::get('/', function () {
//     return 'Hello World';
// });
// Route::get('/', function () {
//     return view('about');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

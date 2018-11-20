<?php

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
Route::get('/rodgers', function () {
    $users = App\Task::all();

    return view('rodgers', ['users'=>$users]);
});

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('login');

Route::get('logout', 'Auth\LoginController@logout');

// Catch-all Route...
Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)');

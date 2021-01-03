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

Auth::routes();

Route::get('/', function(){
    return redirect()->route('login');
});

Route::middleware(['auth'])
    ->group(function(){

        // dashboard route 
        Route::get('/dashboard', 'HomeController@index')
            ->name('dashboard');

        // user controller
        Route::post('/user/change-name', 'UserController@changeName')
            ->name('user.change.name');

        Route::post('/user/change-password', 'UserController@changePassword')
            ->name('user.change.password');

    });



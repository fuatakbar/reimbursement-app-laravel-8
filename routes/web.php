<?php

// use Illuminate\Support\Facades\Route;

// controller define
// use App\Http\Controllers\HomeController;

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

// Route::get('/', function(){
//     return redirect()->route('login');
// });

Auth::routes();

Route::middleware(['auth'])
    ->group(function(){
    
    Route::get('/', 'HomeController@index')
        ->name('home');

    });

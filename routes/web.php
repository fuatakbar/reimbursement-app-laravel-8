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
    if (Auth::user()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
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

        Route::post('/user/add-bank', 'UserController@addBankAccount')
            ->name('user.add.bank');

        Route::post('/user/change-bank', 'UserController@updateBankAccount')
            ->name('user.change.bank');

        // employer controller
        Route::resource('employer', 'EmployerController');

        Route::get('/reimbursement/pending-employer', 'EmployerController@pending')
            ->name('employer.pending');

        Route::get('/reimbursement/rejected-employer', 'EmployerController@rejected')
            ->name('employer.rejected');

        Route::get('/reimbursement/approved-employer', 'EmployerController@approved')
            ->name('employer.approved');

        Route::get('/reimbursement/processed-employer', 'EmployerController@processed')
            ->name('employer.processed');

    });

// only business owner
Route::middleware(['auth', 'owner'])
    ->group(function(){

        Route::get('/employers', 'BusinessOwnerController@employer')
            ->name('employers');

        Route::get('/managers', 'BusinessOwnerController@manager')
            ->name('managers');

        Route::get('/finances', 'BusinessOwnerController@finance')
            ->name('finances');

        Route::resource('user', 'BusinessOwnerController')
            ->only(['edit', 'update', 'destroy']);

    });

// only business manager
Route::middleware(['auth', 'manager'])
    ->group(function(){

        Route::resource('manager', 'ManagerController'); 

        Route::get('/reimbursement/pending-manager', 'ManagerController@pending')
            ->name('manager.pending');

        Route::get('/reimbursement/rejected-manager', 'ManagerController@rejected')
            ->name('manager.rejected');

        Route::get('/reimbursement/approved-manager', 'ManagerController@approved')
            ->name('manager.approved');

    });

// only business manager
Route::middleware(['auth', 'finance'])
    ->group(function(){

        Route::resource('finance', 'FinanceController');  

        Route::get('/reimbursement/processed-finance', 'FinanceController@processed')
            ->name('finance.processed');

    });

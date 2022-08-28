<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::controller(EmployeeController::class)->group(function() {
    Route::get('/','index')->name('view.form');
    Route::post('employeeform','store')->name('store.form');
    Route::get('/employeedashboard','view')->name('employee.view');
    Route::get('/deleteemployee','delete')->name('employee.delete');
    Route::get('/editemployee/{id}','edit')->name('employee.edit');
    Route::post('/updateemployee/{id}','update')->name('employee.update');
    Route::get('/employeestatus/{id}','status')->name('employee.status');
    Route::post('/multipledelete','multipleDelete')->name('multiple.delete');
});

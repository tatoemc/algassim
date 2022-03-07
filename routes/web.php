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
    return view('auth.login');  
});

Auth::routes();

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('orphans', 'OrphanController');
Route::get('print_orphan/{id}','OrphanController@print_orphan');
Route::get('report', 'OrphanController@report')->name('report');
Route::get('download/{id}', 'OrphanController@get_file');
//Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');
Route::resource('guardians', 'GuardianController');
Route::get('print_guardian/{id}','GuardianController@print_guardian');

Route::resource('sponsors', 'SponsorController');
Route::get('sponsors_export','SponsorController@export')->name('sponsors_export');
Route::get('print_sponsor/{id}','SponsorController@print_sponsor');
Route::resource('sponserforms', 'SponserformController');
Route::resource('payments', 'PaymentController');
Route::get('getPayment','PaymentController@getPayment')->name('getPayment');
Route::resource('depts', 'DeptController');
Route::resource('students', 'StudentController');

Route::resource('reports', 'ReportsController');
Route::get('usereport', 'ReportsController@usereport')->name('usereport');
Route::get('sponsorsreport', 'ReportsController@sponsorsreport')->name('sponsorsreport');
//Route::get('reportsorphans', 'ReportsController@reportsorphans')->name('reportsorphans');


Route::group(['middleware' => ['auth']], function() {
    
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

});


                             

Route::get('/{page}', 'AdminController@index');

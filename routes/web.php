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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/address/{id?}', 'DashboardController@indexAddress');
Route::post('/address/add', 'DashboardController@addAddress');
Route::post('/address/edit', 'DashboardController@editAddress');
Route::post('/address/delete/{id}', 'DashboardController@deleteAddress');

Route::get('/belanja', 'DashboardController@indexBelanja');
Route::post('/transaksi/add', 'DashboardController@addTransaksi');
Route::get('/transaksi/{id}', 'DashboardController@transaksiDetail');

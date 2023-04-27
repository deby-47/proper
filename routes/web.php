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

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('/opd', ['as' => 'opd.index', 'uses' => 'App\Http\Controllers\OpdController@index']);
	Route::get('/opd/realisasi-keuangan', ['as' => 'realisasi_keuangan.index', 'uses' => 'App\Http\Controllers\RealisasiKeuanganController@index']);
	Route::get('/opd/realisasi-fisik', ['as' => 'realisasi_fisik.index', 'uses' => 'App\Http\Controllers\RealisasiFisikController@index']);
	Route::post('/opd/hapus/{id}', 'App\Http\Controllers\OpdController@destroy')->name('hapus');

	Route::get('/pergeseran', ['as' => 'pergeseran.index', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@index']);
	Route::get('/pergeseran/tambah', ['as' => 'pergeseran.create', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@create']);
	Route::post('/pergeseran/tambah', ['as' => 'pergeseran.store', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@store']);
});


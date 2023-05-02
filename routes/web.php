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
	Route::get('/opd/details/{id}', ['as' => 'opd.details', 'uses' => 'App\Http\Controllers\OpdController@details']);
	Route::get('/opd/cari', ['as' => 'opd.search', 'uses' => 'App\Http\Controllers\OpdController@search']);

	Route::get('/pergeseran', ['as' => 'pergeseran.index', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@index']);
	Route::get('/pergeseran/tambah', ['as' => 'pergeseran.create', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@create']);
	Route::post('/pergeseran/tambah', ['as' => 'pergeseran.store', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@store']);
	Route::get('/pergeseran/details/{id}', ['as' => 'pergeseran.details', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@details']);
	Route::get('/pergeseran/edit/{id}', ['as' => 'pergeseran.edit', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@edit']);
	Route::post('/pergeseran/edit/{id}', ['as' => 'pergeseran.update', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@update']);
	Route::post('/pergeseran/hapus/{id}', ['as' => 'pergeseran.delete', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@delete']);
	Route::get('/pergeseran/cari', ['as' => 'pergeseran.search', 'uses' => 'App\Http\Controllers\PergeseranAnggaranController@search']);

	Route::get('/penyerapan', ['as' => 'penyerapan.index', 'uses' => 'App\Http\Controllers\PenyerapanAnggaranController@index']);
	Route::get('/penyerapan/tambah', ['as' => 'penyerapan.create', 'uses' => 'App\Http\Controllers\PenyerapanAnggaranController@create']);
	Route::post('/penyerapan/tambah', ['as' => 'penyerapan.store', 'uses' => 'App\Http\Controllers\PenyerapanAnggaranController@store']);
	Route::get('/penyerapan/edit/{id}', ['as' => 'penyerapan.edit', 'uses' => 'App\Http\Controllers\PenyerapanAnggaranController@edit']);
	Route::post('/penyerapan/edit/{id}', ['as' => 'penyerapan.update', 'uses' => 'App\Http\Controllers\PenyerapanAnggaranController@update']);
	Route::post('/penyerapan/hapus/{id}', ['as' => 'penyerapan.delete', 'uses' => 'App\Http\Controllers\PenyerapanAnggaranController@delete']);
	Route::get('/penyerapan/cari', ['as' => 'penyerapan.search', 'uses' => 'App\Http\Controllers\PenyerapanAnggaranController@search']);

	Route::get('/dispensasi-spm', ['as' => 'dispensasi.index', 'uses' => 'App\Http\Controllers\DispensasiController@index']);
	Route::get('/dispensasi-spm/cari', ['as' => 'dispensasi.search', 'uses' => 'App\Http\Controllers\DispensasiController@search']);
	Route::get('/dispensasi-spm/tambah', ['as' => 'dispensasi.create', 'uses' => 'App\Http\Controllers\DispensasiController@create']);
	Route::post('/dispensasi-spm/tambah', ['as' => 'dispensasi.store', 'uses' => 'App\Http\Controllers\DispensasiController@store']);
	Route::get('/dispensasi-spm/edit/{id}', ['as' => 'dispensasi.edit', 'uses' => 'App\Http\Controllers\DispensasiController@edit']);
	Route::post('/dispensasi-spm/edit/{id}', ['as' => 'dispensasi.update', 'uses' => 'App\Http\Controllers\DispensasiController@update']);
	Route::post('/dispensasi-spm/hapus/{id}', ['as' => 'dispensasi.delete', 'uses' => 'App\Http\Controllers\DispensasiController@delete']);
});


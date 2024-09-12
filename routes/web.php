<?php

use App\Http\Controllers\dashboardC;
use App\Http\Controllers\jam_tayangR;
use App\Http\Controllers\kursiR;
use App\Http\Controllers\logC;
use App\Http\Controllers\loginC;
use App\Http\Controllers\productR;
use App\Http\Controllers\studioR;
use App\Http\Controllers\transactionR;
use App\Http\Controllers\userR;
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

Route::get('kursi/resetAllStatus', [kursiR::class, 'resetAllStatus'])->name('kursi.resetAllStatus')->middleware('userAkses:admin');


//pdf
Route::get('kursi/pdf', [kursiR::class, 'pdf'])->middleware('userAkses:admin');
Route::get('studio/pdf', [studioR::class, 'pdf'])->middleware('userAkses:admin');
Route::get('product/pdf', [productR::class, 'pdf'])->middleware('userAkses:admin');
Route::get('user/pdf', [userR::class, 'pdf'])->middleware('userAkses:admin');
Route::get('transaction/pdf', [transactionR::class, 'pdf'])->middleware('userAkses:admin');
Route::get('transaction/pdf2/{id}',  [transactionR::class, 'pdf2'])->middleware('userAkses:kasir');
Route::get('pertanggal/{start_date}/{end_date}', [transactionR::class, 'pertanggal'])->name('transaction.pertanggal')->middleware('userAkses:owner');
Route::get('transaction/all', [transactionR::class, 'all'])->name('transaction.all')->middleware('userAkses:owner');

//percobaan
Route::post('/transaction/reset-status', [transactionR::class, 'resetStatus'])->name('transaction.reset-status')->middleware('userAkses:admin');
Route::post('/transaction/ambiljam', [transactionR::class, 'ambiljam'])->name('transaction.ambiljam');
Route::get('/transaction/trakur', [transactionR::class, 'trakur'])->name('transaction.trakur');

//Login
Route::get('/', [loginC::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [loginC::class, 'login_action'])->name('login.action')->middleware('guest');
Route::post('/logout', [loginC::class, 'logout'])->name('logout');
// Route::get('logout', [loginC::class, 'logout'])->name('logout')->middleware('guest');

//dashboard
Route::get('home', [dashboardC::class, 'index'])->name('dashboard.index')->middleware('userAkses:admin,kasir,owner');

//user
Route::resource('user', userR::class)->middleware('userAkses:admin');
Route::get('user/changepassword/{id}', [userR::class, 'changepassword'])->name('user.changepassword')->middleware('userAkses:admin');
Route::put('user/change/{id}', [userR::class, 'change'])->name('user.change')->middleware('userAkses:admin');


//kursi
Route::resource('kursi', kursiR::class)->middleware('userAkses:admin');
Route::get('/kursi/reset/{id}', [kursiR::class, 'reset'])->name('kursi.reset')->middleware('userAkses:admin');
Route::get('update-kursi-status/{id}', [kursiR::class, 'updateProductStatus'])->name('kursi.updateStatus')->middleware('userAkses:admin');


//produk
Route::resource('product', productR::class)->middleware('userAkses:admin');

//transaksi
Route::resource('transaction', transactionR::class)->middleware('userAkses:admin,kasir,owner');

//Log
Route::get('log', [logC::class, 'index'])->name('log.index')->middleware('userAkses:admin,owner');
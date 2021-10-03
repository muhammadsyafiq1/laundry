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
Auth::routes();

Route::get('/' , [App\Http\Controllers\Frontend\HomeController::class, 'index'])
	->name('home.laundry');
Route::get('/detail/{slug}' , [App\Http\Controllers\Frontend\HomeController::class, 'detail'])
	->name('detail');


Route::group(['middleware' => 'auth'], function () {
	Route::post('booking/home',[App\Http\Controllers\Frontend\HomeController::class, 'bookingLaundry'])
		->name('booking.home');
	Route::get('booking/success',[App\Http\Controllers\Frontend\HomeController::class, 'success'])
		->name('success'); 
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
		->name('home');
	Route::get('user/profile',[App\Http\Controllers\UserController::class, 'profile'])
		->name('profile');
	Route::post('user/ganti-password', [App\Http\Controllers\UserController::class, 'gantiPassword'])
		->name('ganti-password');
	Route::get('user/setting-profile',[App\Http\Controllers\UserController::class, 'settingProfile'])
		->name('setting-profile');
	Route::resource('user', App\Http\Controllers\UserController::class);
	
	
});


Route::group(['middleware' => ['can:isAdmin','auth']], function(){
	Route::resource('banner', App\Http\Controllers\BannerController::class);
	Route::resource('rekening', App\Http\Controllers\RekeningAdminController::class);
	Route::get('masa-sewa', [App\Http\Controllers\JadwalSewaController::class, 'index'])
		->name('masa-sewa');
	Route::get('pemberitahuan-accept/{id}/', [App\Http\Controllers\PemberitahuanController::class, 'accept'])
		->name('pemberitahuan.accept');
	Route::post('pemberitahuan-decline/{id}/', [App\Http\Controllers\PemberitahuanController::class, 'decline'])
		->name('pemberitahuan.decline');
	Route::get('laundry-all', [App\Http\Controllers\LaundryController::class, 'tableLaundry'])
		->name('laundry-all');
	Route::get('laundry-aktif/{id}', [App\Http\Controllers\LaundryController::class, 'aktif'])
		->name('laundry-aktif');
	Route::get('laundry-nonaktif/{id}', [App\Http\Controllers\LaundryController::class, 'nonaktif'])
		->name('laundry-nonaktif');
});

Route::group(['middleware' => ['can:isPemilikAndAdmin','auth']], function(){
	Route::resource('laundry', App\Http\Controllers\LaundryController::class);
	Route::get('pembayaran/transfer', [App\Http\Controllers\DataBuktiBayarController::class, 'index'])
		->name('transfer.index');
});


Route::group(['middleware' => ['can:isPemilik','auth']], function(){
	Route::get('transaction-selesai/{id}', [App\Http\Controllers\TransactionController::class, 'updateStatusSelesai'])
		->name('transaction-selesai');
	Route::post('pembayaran/', [App\Http\Controllers\DataBuktiBayarController::class, 'store'])
		->name('pembayaran');
	Route::get('transaction-diterima/{id}/{laundryid}', [App\Http\Controllers\TransactionController::class, 'updateStatusTerima'])
		->name('transaction-diterima');
	Route::get('cetak-pdf/{id}', [App\Http\Controllers\TransactionController::class, 'cetakPdf'])
		->name('cetakPdf');
	Route::get('transaction/riwayat-pengguna', [App\Http\Controllers\TransactionController::class, 'riwayat_pengguna'])
		->name('transaction.riwayat-pengguna');
	Route::get('pemberitahuan-dibaca/{id}/', [App\Http\Controllers\PemberitahuanController::class, 'dibaca'])
		->name('pemberitahuan.dibaca');
	Route::get('pemberitahuan/remove/{id}/', [App\Http\Controllers\PemberitahuanController::class, 'remove'])
		->name('pemberitahuan.remove');
	Route::get('pemberitahuan/', [App\Http\Controllers\PemberitahuanController::class, 'index'])
		->name('pemberitahuan.index');
	Route::resource('gallery', App\Http\Controllers\LaundryGalleryController::class);
});

Route::group(['middleware' => ['can:isCustomer','auth']], function(){
	Route::post('booking', [App\Http\Controllers\TransactionController::class, 'booking'])
		->name('booking');
	Route::get('ulasan',[App\Http\Controllers\UlasanController::class, 'index'])
		->name('ulasan.index');
	Route::post('ulasan-create/{id}',[App\Http\Controllers\UlasanController::class, 'store'])
		->name('ulasan-create');
	Route::get('riwayat-laundry-saya', [App\Http\Controllers\TransactionController::class, 'riwayat_laundry_saya'])
		->name('riwayat-laundry-saya');
	Route::get('transaction-diterima/{id}/{laundryid}', [App\Http\Controllers\TransactionController::class, 'updateStatusTerima'])
		->name('transaction-diterima');
});



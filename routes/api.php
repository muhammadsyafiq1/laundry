<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IndoRegionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('provinces', [IndoRegionController::class, 'provinces'])->name('api.provinces');
Route::get('regencies/{provinces_id}', [IndoRegionController::class, 'regencies'])->name('api.regencies');
Route::get('districts/{regencies_id}', [IndoRegionController::class, 'districts'])->name('api.districts');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

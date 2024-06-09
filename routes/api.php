<?php

use App\Http\Controllers\Api\Auth\adminController;
use App\Http\Controllers\Api\Auth\ProviderController;
use App\Http\Controllers\Api\Auth\CustomerController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

#################### *start Auth User* #################
Route::prefix('auth')->group(function(){
    Route::post('/register', [CustomerController::class, 'register']);
    Route::post('/login', [CustomerController::class, 'login']);
    Route::post('/logout', [CustomerController::class, 'logout']);
});


// #################### *start Auth Provider* #################
Route::prefix('auth')->group(function(){
    Route::post('/register', [ProviderController::class, 'register']);
    Route::post('/login', [ProviderController::class, 'login']);
    Route::post('/logout', [ProviderController::class, 'logout']);
});
// #################### *start Auth admin* #################

Route::prefix('auth')->group(function(){
   Route::post('/register', [adminController::class, 'register']);
    Route::post('/login', [adminController::class, 'login']);
    Route::post('/logout', [adminController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
    Route::resource('services', [ServiceController::class]);
    Route::resource('bookings', [BookingController::class]);
});

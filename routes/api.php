<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ForgottenPasswordController;

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

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest');

Route::post('/sign-in', [RegisterController::class, 'register'])
    ->middleware('guest');

Route::post('/forgotten', [ForgottenPasswordController::class, 'sendLink'])
    ->middleware('guest');

Route::post('/change-password', [NewPasswordController::class, 'store'])
    ->middleware('guest');

Route::middleware(['auth:api'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/company-requests', [CompanyRequestController::class, 'getAll']);
    Route::get('/company-requests/{company_domain}', [CompanyRequestController::class, 'getCompanyRequestInfo']);
    Route::get('/company/{company_domain}', [CompanyRequestController::class, 'getCompanyInfo']);
    Route::post('/company', [CompanyRequestController::class, 'store']);
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
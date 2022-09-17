<?php

use App\Http\Controllers\Hello\HelloSignOauthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuthController;

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

Route::prefix('oauth')->group(function () {
    Route::get('/install', [OAuthController::class, 'install'])->middleware('commerce')->name('oauth.install');
    Route::get('/load', [OAuthController::class, 'load'])->middleware('decodes.tokens')->name('oauth.load');
    Route::get('/remove', [OAuthController::class, 'remove'])->name('oauth.remove');
});

Route::prefix('hello')->group(function () {
    Route::get('/callback', [HelloSignOauthController::class, 'callback']);
    // Route::get('/load', [OAuthController::class, 'load'])->middleware('decodes.tokens')->name('oauth.load');
    // Route::get('/remove', [OAuthController::class, 'remove'])->name('oauth.remove');
});
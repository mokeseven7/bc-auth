<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hello\HelloSignOauthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('hello')->group(function () {
    Route::post('/callback', [HelloSignOauthController::class, 'callback']);
    // Route::get('/load', [OAuthController::class, 'load'])->middleware('decodes.tokens')->name('oauth.load');
    // Route::get('/remove', [OAuthController::class, 'remove'])->name('oauth.remove');
});
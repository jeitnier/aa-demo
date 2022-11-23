<?php

use App\Http\Controllers\CrawlerController;
use Illuminate\Support\Facades\Route;

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

// This is one way you could enforce basic auth via API HTTP Request
//Route::middleware('auth.basic.once')->group(function () {
//    Route::post('/crawl', [CrawlerController::class, 'crawl']);
//});

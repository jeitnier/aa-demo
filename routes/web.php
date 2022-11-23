<?php

use App\Http\Controllers\CrawlerController;
use App\Http\Controllers\ResultsController;
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

Route::middleware('auth.basic')->group(function () {
    Route::get('/crawl', [CrawlerController::class, 'crawl'])->name('crawl');
    Route::get('/results/{job_id}', [ResultsController::class, 'show'])->name('results');
});


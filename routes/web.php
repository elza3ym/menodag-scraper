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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/data', [App\Http\Controllers\DataController::class, 'index'])->name('data.index');
    Route::get('/data/download', [App\Http\Controllers\DataController::class, 'download'])->name('data.download');
    Route::get('/scraper', [App\Http\Controllers\SessionController::class, 'index'])->name('session.index');
    Route::put('/scraper/{session}', [App\Http\Controllers\SessionController::class, 'update'])->name('session.stop');
    Route::get('/scraper/{session}/count', [App\Http\Controllers\SessionController::class, 'getDataCount'])->name('session.count');
    Route::post('/scraper', [App\Http\Controllers\SessionController::class, 'store'])->name('session.start');
    Route::post('/scraper/pattern', [App\Http\Controllers\SessionController::class, 'updatePattern'])->name('session.update.pattern');

});




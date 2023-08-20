<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KNNController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\ResolveWebParams;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => ['auth', ResolveWebParams::class],
    'prefix' => 'dashboard',
    'as' => 'dshb.'
], function () {
    Route::get('data/{data}/glcm', [DataController::class, 'glcm'])->name('data.glcm');
    Route::resource('data', DataController::class)->except(['edit', 'show', 'update']);

    Route::get('test', [TestController::class, 'index'])->name('test.index');
    Route::post('test', [TestController::class, 'process'])->name('test.process');

    Route::get('knn', [KNNController::class, 'index'])->name('knn.index');

    Route::get('history', [HistoryController::class, 'index'])->name('history.index');

    Route::get('/', [DashboardController::class, 'index'])->name('index');
});

Route::post('dashboard/knn', [KNNController::class, 'process'])->name('dshb.knn.process');

Route::post('upload/file', [FilepondController::class, 'process'])
    ->name('upload.process');

Route::delete('upload/file', [FilepondController::class, 'revert'])
    ->name('upload.revert');

Route::get('/', function () {
    return view('welcome');
});

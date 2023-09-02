<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KNNController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\ResolveWebParams;
use App\Jobs\PreprocessImgUjiLatih as Preprocess;
use App\Models\Data;
use Illuminate\Database\Eloquent\Collection;
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

Route::get('/about', fn () => view('about'))->name('landing.about');
Route::get('/', fn () => view('welcome'))->name('landing.index');

Route::get('re-glcm', function () {
    // calc euclidean distance between train data and new data
    Data::chunk(20, function (Collection $datas) {
        foreach ($datas as $data) {
            Preprocess::dispatch($data->id);
        }
    });
});

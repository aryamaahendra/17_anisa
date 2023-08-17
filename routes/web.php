<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FilepondController;
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
    Route::resource('data', DataController::class)->except(['edit', 'show', 'update']);
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});

Route::post('upload/file', [FilepondController::class, 'process'])
    ->name('upload.process');

Route::delete('upload/file', [FilepondController::class, 'revert'])
    ->name('upload.revert');

Route::get('/', function () {
    return view('welcome');
});

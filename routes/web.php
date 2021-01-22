<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\NomineeController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::prefix('/nominees')
    ->name('nominees.')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::get('', [NomineeController::class, 'index'])->name('home');
        Route::get('/{id}/show', [NomineeController::class, 'show'])->name('show');
        Route::get('/create', [NomineeController::class, 'create'])->name('create');
        Route::post('/', [NomineeController::class, 'store'])->name('store');
        Route::put('/{id}', [NomineeController::class, 'update'])->name('update');
        Route::delete('/{id}', [NomineeController::class, 'destroy'])->name('delete');
    });

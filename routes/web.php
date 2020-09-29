<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\App;
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

Route::get('/', HomeController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/links', [LinksController::class, 'index'])->name('links.index');

    Route::get('/links/create', [LinksController::class, 'create'])->name('links.create');

    Route::post('/links', [LinksController::class, 'store'])->name('links.store');

    Route::middleware(\App\Http\Middleware\CheckLinkAuthorShow::class)->group(function () {
        Route::get('links/{link}', [LinksController::class, 'show'])->name('links.show');
    });

    Route::middleware(\App\Http\Middleware\CheckLinkAuthorEdit::class)->group(function () {
        Route::get('links/{link}/edit', [LinksController::class, 'edit'])->name('links.edit');

        Route::patch('/links/{link}', [LinksController::class, 'update'])->name('links.update');
    });

    Route::delete('/links/{link}', [LinksController::class, 'destroy'])->name('links.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/login', [AuthController::class, 'loginCheck']);
});

Route::get('/{id?}', [RedirectController::class, 'redirect'])->name('redirect');


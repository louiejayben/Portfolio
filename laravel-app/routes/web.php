<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Public portfolio viewing — login is not required.
Route::get('/p/{token}', [PortfolioController::class, 'showPublic'])
    ->name('portfolios.public');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/portfolios', [PortfolioController::class, 'index'])
        ->name('portfolios.index');

    Route::get('/portfolios/create', [PortfolioController::class, 'create'])
        ->name('portfolios.create');

    Route::post('/portfolios', [PortfolioController::class, 'store'])
        ->name('portfolios.store');
}); 
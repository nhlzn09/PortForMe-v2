<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => app(AuthController::class)->show('login'))->name('login');
    Route::get('/register', fn () => app(AuthController::class)->show('register'))->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [PortfolioController::class, 'dashboard'])->name('dashboard');          // Manage Portfolio
    Route::get('/portfolio/create', [PortfolioController::class, 'form'])->name('portfolio.create'); // Portfolio Information
    Route::get('/portfolio/edit', [PortfolioController::class, 'form'])->name('portfolio.edit');
    Route::post('/portfolio', [PortfolioController::class, 'save'])->name('portfolio.save');
    Route::get('/portfolio/template', [PortfolioController::class, 'templates'])->name('portfolio.template'); // Template Selection
    Route::post('/portfolio/template', [PortfolioController::class, 'choose'])->name('portfolio.choose');
    Route::get('/portfolio/preview', [PortfolioController::class, 'preview'])->name('portfolio.preview');     // Preview
    Route::delete('/portfolio', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
});

Route::get('/u/{username}', [PortfolioController::class, 'show'])->name('portfolio.show');

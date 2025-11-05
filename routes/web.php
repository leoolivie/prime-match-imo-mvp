<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Investor\InvestorDashboardController;
use App\Http\Controllers\Businessman\BusinessmanDashboardController;
use App\Http\Controllers\Broker\BrokerDashboardController;
use App\Http\Controllers\Master\MasterDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Investor routes
Route::middleware(['auth'])->prefix('investor')->name('investor.')->group(function () {
    Route::get('/dashboard', [InvestorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [InvestorDashboardController::class, 'search'])->name('search');
    Route::post('/search', [InvestorDashboardController::class, 'searchResults'])->name('search.results');
    Route::post('/lead/{property}', [InvestorDashboardController::class, 'createLead'])->name('lead.create');
});

// Businessman routes
Route::middleware(['auth'])->prefix('businessman')->name('businessman.')->group(function () {
    Route::get('/dashboard', [BusinessmanDashboardController::class, 'index'])->name('dashboard');
    Route::get('/plans', [BusinessmanDashboardController::class, 'plans'])->name('plans');
    Route::post('/subscribe/{plan}', [BusinessmanDashboardController::class, 'subscribe'])->name('subscribe');
    // Properties (businessman)
    Route::get('/properties', [BusinessmanDashboardController::class, 'properties'])->name('properties');
    Route::get('/properties/create', [BusinessmanDashboardController::class, 'createProperty'])->name('property.create');
    Route::post('/properties', [BusinessmanDashboardController::class, 'storeProperty'])->name('property.store');
    Route::get('/properties/{property}/edit', [BusinessmanDashboardController::class, 'editProperty'])->name('property.edit');
    Route::put('/properties/{property}', [BusinessmanDashboardController::class, 'updateProperty'])->name('property.update');
    Route::delete('/properties/{property}', [BusinessmanDashboardController::class, 'destroyProperty'])->name('property.destroy');
});

// Prime Broker routes
Route::middleware(['auth'])->prefix('broker')->name('broker.')->group(function () {
    Route::get('/dashboard', [BrokerDashboardController::class, 'index'])->name('dashboard');
    Route::post('/lead/{lead}/claim', [BrokerDashboardController::class, 'claimLead'])->name('lead.claim');
    Route::put('/lead/{lead}', [BrokerDashboardController::class, 'updateLead'])->name('lead.update');
});

// Master/Admin routes
Route::middleware(['auth'])->prefix('master')->name('master.')->group(function () {
    Route::get('/dashboard', [MasterDashboardController::class, 'index'])->name('dashboard');
    
    // Users
    Route::get('/users', [MasterDashboardController::class, 'users'])->name('users');
    Route::get('/users/create', [MasterDashboardController::class, 'createUser'])->name('users.create');
    Route::post('/users', [MasterDashboardController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [MasterDashboardController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [MasterDashboardController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [MasterDashboardController::class, 'destroyUser'])->name('users.destroy');
    
    // Properties
    Route::get('/properties', [MasterDashboardController::class, 'properties'])->name('properties');
    
    // Partners
    Route::get('/partners', [MasterDashboardController::class, 'partners'])->name('partners');
    Route::get('/partners/create', [MasterDashboardController::class, 'createPartner'])->name('partners.create');
    Route::post('/partners', [MasterDashboardController::class, 'storePartner'])->name('partners.store');
    
    // Subscriptions
    Route::get('/subscriptions', [MasterDashboardController::class, 'subscriptions'])->name('subscriptions');
});

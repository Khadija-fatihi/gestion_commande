<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;

Route::redirect('/', '/commandes');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/commandes/stats', [CommandeController::class, 'stats'])->name('commandes.stats');
    Route::get('/commandes/{commande}/confirmer-suppression', [CommandeController::class, 'confirmDelete'])->name('commandes.confirm-delete');
    Route::get('/commandes/{commande}/ajouter-produit', [CommandeController::class, 'addProductForm'])->name('commandes.add-product-form');
    Route::post('/commandes/{commande}/ajouter-produit', [CommandeController::class, 'addProduct'])->name('commandes.add-product');
    Route::resource('commandes', CommandeController::class);
});

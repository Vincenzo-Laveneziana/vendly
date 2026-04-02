<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UtentiController;
use App\Models\Product;

Route::get('/', [ProductController::class, 'show'])->name('home');

Route::get('/ricerca', [ProductController::class, 'search'])->name('ricerca');

Route::get('/esplora', [ProductController::class, 'showAll'], [Product::class, 'getCategoryNameAttribute'])->name('esplora');

Route::get('/esplora/prodotto/{id}', [ProductController::class, 'showProduct'])->name('prodotto');


Route::get('/vendere', function () {
    return view('guest.pages.vendere');
})->name('vendere');

Route::get('/esplora/filtri', [ProductController::class, 'filtri'])->name('categoria');

Route::get('/login', function () {
    return view('guest.pages.loginPage');
})->name('login');

Route::get('/register', function () {
    return view('guest.pages.regPage');
})->name('registrazione');

Route::get('/password-request', function () {
    return view('guest.pages.password-request');
})->name('password-request');

Route::get('/reset-password/{token}', function (string $token) {
    return view('guest.pages.reset-password', [
        'token' => $token, 
        'email' => request('email') // L'email arriva nell'URL come parametro
    ]);
})->name('password.reset');

// Post
Route::post('/login', [AuthController::class, 'login']);

Route::post('/registration', [AuthController::class, 'register']);

Route::post('/password-request', [UtentiController::class, 'sendResetLink'])->name('sendResetLink');

Route::post('/reset-password', [UtentiController::class, 'updatePassword'])->name('password.update');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/profilo', [ProductController::class, 'showUserProducts'])->name('profilo');

    Route::put('/aggiorna-profilo', [UtentiController::class, 'updateUser'])->name('aggiornaProfilo');

    // rotta post per visualizzare il form di vendita
    Route::get('/vendere/nuovo', function () {
        return view('guest.pages.formVendita');
    })->name('formVendita');

    Route::post('/vendere/crea', [ProductController::class, 'createProduct'])->name('createProduct');

    Route::post('/delete-user', [UtentiController::class, 'deleteUser'])->name('Elimina');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/update-user/{user}', [UtentiController::class, 'updateUser'])->name('Aggiorna');
    //modifica in get
    Route::get('/visualizza/{id}', [UtentiController::class, 'visualizza'])->name('Modifica');

    Route::get('/status/{id}', [UtentiController::class, 'status'])->name('status');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backoffice\ChatController;
use App\Http\Controllers\Backoffice\ProductController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\Frontoffice\PagesController;
use App\Models\Product;

Route:: as('Auth.')->group(function () {

    // Visualizzazione

    Route::get('/login', function () {
        return view('auth.pages.loginPage');
    })->name('loginPage');

    Route::get('/register', function () {
        return view('auth.pages.regPage');
    })->name('regPage');

    // Invio dati

    Route::post('/login/auth', [AuthController::class, 'login'])->name('login');

    Route::post('/registration/auth', [AuthController::class, 'register'])->name('register');

    Route::post('/login', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::put('/update-user/{user}', [UserController::class, 'updateUser'])->name('updateUser');

});


Route:: as('Backoffice.')->group(function () {

    // Backoffice 
    Route::middleware(['auth'])->group(function () {

        //chat

        Route::get('/chat/{idProdotto?}/{idConversazione?}', [ChatController::class, 'show'])->name('createChat');

        route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('sendMessage');

        Route::get('/chat/{conversation}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');

        //vendita

        Route::post('/vendere/crea', [ProductController::class, 'create'])->name('createProduct');

        Route::get('/profilo', [UserController::class, 'showProfile'])->name('profile');

        // Vendita

        Route::get('/vendere/form', function () {
            $categories = Product::categories();
            return view('backoffice.sell.sellForm', compact('categories'));
        })->name('sellForm');
    });

});
Route::controller(PagesController::class)->as('Frontoffice.')->group(function () {

    Route::get('language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    });
    // Rotte per visualizzare le pagine

    Route::get('/ricerca', 'search')->name('ricerca');

    // Home
    Route::get('/', 'index')->name('home');

    // Esplora

    Route::get('/esplora', 'show')->name('explore');

    Route::get('/esplora/prodotto/{id}', 'product')->name('product');

    //vendere

    Route::get('/vendere', function () {
        return view('frontoffice.sell.sell');
    })->name('vendere');
});



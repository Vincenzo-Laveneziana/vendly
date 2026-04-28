<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backoffice\ChatController;
use App\Http\Controllers\Backoffice\ProductController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\Frontoffice\PagesController;
use App\Models\Product;
use App\Models\Order;

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

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::put('/update-user', [UserController::class, 'updateUser'])->name('updateUser');

});


Route:: as('Backoffice.')->group(function () {

    // Backoffice 
    Route::middleware(['auth'])->group(function () {

        // Product

        Route::post('/favorite/{product}', [ProductController::class, 'addFavorite'])->name('addFavorite');

        // Chat

        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
        Route::get('/chat/new/{product}/{message}', [ChatController::class, 'store'])->name('chat.store');
        Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
        Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
        Route::get('/chat/{conversation}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');

        //profilo

        Route::get('/profilo', [UserController::class, 'showProfile'])->name('profile');

        Route::get('/profilo/annunci', [UserController::class, 'showSale'])->name('sale');

        Route::get('/profilo/preferiti', [UserController::class, 'showFavorites'])->name('favorites');

        Route::get('/profilo/ordini', [UserController::class, 'showOrders'])->name('orders');


        // Vendita
        Route::post('/vendere/crea', [ProductController::class, 'create'])->name('createProduct');

        Route::get('/vendere', function () {
            $categories = Product::categories();
            return view('backoffice.sell.sellForm', compact('categories'));
        })->name('sellForm');

        Route::get('/acquista/{product}', [ProductController::class, 'showBuy'])->name('buy');

        Route::post('/acquista/{product}/conferma', [ProductController::class, 'buy'])->name('processBuy');

        Route::get('/acquista/conferma/{order}', function (Order $order) {
            return view('backoffice.buy.confirmBuy', compact('order'));
        })->name('confirmBuy');
    });

});
Route::controller(PagesController::class)->as('Frontoffice.')->group(function () {

    // Home
    Route::get('/', 'index')->name('home');

    Route::get('language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    });


    // Esplora

    Route::get('/ricerca', 'search')->name('ricerca');

    Route::get('/esplora', 'show')->name('explore');

    Route::get('/esplora/prodotto/{product}', 'product')->name('product');
});



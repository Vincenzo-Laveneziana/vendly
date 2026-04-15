<?php

namespace App\Http\Controllers\Backoffice;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateUserRequest;
use App\Models\Product;
use App\Models\Favorite;

class UserController extends Controller
{
    function updateUser(CreateUserRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        // 1. Validiamo i dati in arrivo
        $validated = $request->validated();

        // Se è presente una nuova password, aggiorniamo anche quella
        if (!empty($validated['new_password'])) {
            $validated['password'] = $validated['new_password'];
            unset($validated['new_password']);
        } else {
            $validated['password'] = $user->password; // Non aggiorniamo la password se non è stata fornita
        }

        if ($user->update($validated)) {
            Log::info("Update riuscito per utente " . $user->id);
            return redirect()->route('Backoffice.profile')->with('status', 'Utente aggiornato con successo.');
        }

        Log::error("Update fallito per utente " . $user->id);
        return back()->withErrors([
            'email' => 'Si è verificato un errore durante l\'aggiornamento. Riprova più tardi.',
        ]);
    }

    public function showProfile()
    {
        // Recupera tutti i post con le immagini, ordinati per data di creazione
        $productsCount = Product::where('user_id', Auth::id())->count();

        $soldProductCount = Product::where('user_id', Auth::id())->whereNotNull('sold_at')->count();

        $pendingProductCount = Product::where('user_id', Auth::id())->whereNull('sold_at')->count();

        return view('backoffice.profile.profile', compact('productsCount', 'soldProductCount', 'pendingProductCount'));
    }

    public function showAds()
    {
        $products = Product::with('images')->where('user_id', Auth::id())->latest()->get();

        return view('backoffice.profile.ads', compact('products'));
    }

    public function showFavorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();

        return view('backoffice.profile.favorites', compact('favorites'));
    }
}

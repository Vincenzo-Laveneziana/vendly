<?php

namespace App\Http\Controllers\Backoffice;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateUserRequest;
use App\Models\Product;

class UserController extends Controller
{
    function updateUser(CreateUserRequest $request, User $user)
    {
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
            return redirect()->route('Backoffice.profile')
                ->with([
                    'success' => true,
                    'message' => 'message.update_user',
                ]);
        }

        return back()->with([
            'success' => false,
            'message' => 'message.error_update_user',
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

    public function showSale()
    {
        $products = Product::with('images')->where('user_id', Auth::id())->latest()->paginate(12);

        return view('backoffice.profile.sale', compact('products'));
    }

    public function showFavorites()
    {
        $products = auth()->user()->favorites()->latest()->paginate(12);

        return view('backoffice.profile.favorites', compact('products'));
    }
}

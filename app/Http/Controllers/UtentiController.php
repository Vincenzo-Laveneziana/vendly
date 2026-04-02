<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateUserRequest;

class UtentiController extends Controller
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

        if($user->update($validated)) {
            Log::info("Update riuscito per utente " . $user->id);
            return redirect()->route('profilo')->with('status', 'Utente aggiornato con successo.');
        }

        Log::error("Update fallito per utente " . $user->id);
        return back()->withErrors([
            'email' => 'Si è verificato un errore durante l\'aggiornamento. Riprova più tardi.',
        ]);
    }
}

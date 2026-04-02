<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\CreateUserRequest;

class UtentiController extends Controller
{
    public function sendResetLink(StoreUserRequest $request)
    {
        // 1. Validazione base
        $request->validated();

        // Laravel controlla se l'email esiste e crea un token
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // 3. Controllo del risultato
        if ($status === Password::RESET_LINK_SENT) {
            // SUCCESSO: Torna indietro con messaggio verde
            return back()->with('status', 'Link di reset inviato! Controlla la tua casella di posta (anche nello spam).');
        }

        // ERRORE: Torna indietro con errore sul campo email
        return back()->withErrors([
            'email' => 'Non riusciamo a trovare un utente con questo indirizzo email.',
        ]);
    }

    public function updatePassword(UpdateUserRequest $request)
    {
        // 1. Validazione
        $request->validated();

        // 2. Aggiornamento Password (tutto automatico grazie a Laravel)
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // 3. Risultato
        if ($status === Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', 'La tua password è stata resettata!');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }

    // cancello l'utente
    function deleteUser(Request $request) {

        $authuser = Auth::user();
        if ($authuser->id == $request->user_id) {
            return redirect()->route('utenti')->with('error', 'Non puoi eliminare il tuo stesso account.');
        }

        $user = User::findOrFail($request->user_id); // Prendi l'id dal request body
        $user->delete();

        return redirect()->route('utenti')->with('status', 'Utente eliminato con successo.');
    }

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

    public function visualizza($id) {
        $user = User::findOrFail($id);
        return view('auth.pages.edit-user', compact('user'));
    }

    public function status($id) {
        $logUser = Auth::user();
        
        if ($logUser->id == $id) {
            return redirect()->route('profilo')->with('error', 'Non puoi modificare lo stato del tuo stesso account.');
        }

        $user = User::findOrFail($id);
        
        $user->status = ($user->status === 'Active') ? 'Inactive' : 'Active';
   
        $user->save();

        $statusMessage = $user->status === 'Active' ? 'Utente abilitato con successo.' : 'Utente disabilitato con successo.';
        return redirect()->route('utenti')->with('status', $statusMessage);
    }
}

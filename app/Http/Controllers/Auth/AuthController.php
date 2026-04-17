<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\CreateUserRequest;

class AuthController extends Controller
{

    // Gestisce il login
    public function login(LoginUserRequest $request)
    {


        // 1. Validazione dei dati in arrivo
        $credentials = $request->validated();

        // Creiamo una chiave unica per questo utente (basata su email e indirizzo IP)
        $throttleKey = 'login:' . Str::lower($request->input('email')) . '|' . $request->ip();

        // Controlliamo se ha fatto troppi tentativi (es. max 5 tentativi)
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            // Calcoliamo quanti secondi mancano allo sblocco
            $seconds = RateLimiter::availableIn($throttleKey);

            // Blocchiamo l'esecuzione lanciando un errore di validazione
            throw ValidationException::withMessages([
                'email' => "Troppi tentativi di accesso. Riprova tra $seconds secondi.",
            ]);
        }

        // --- LOGIN ---

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {

            // Login riuscito: cancello i tentativi falliti registrati
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // --- LOGIN FALLITO ---

        // Aumentiamo il contatore dei tentativi falliti (blocca per 60 secondi dopo i 5 errori)
        RateLimiter::hit($throttleKey, 60);

        return back()->with([
            'success' => false,
            'message' => 'message.error_login',
        ])->onlyInput('message');
    }


    // Funzione che gestisce la REGISTRAZIONE
    public function register(CreateUserRequest $request)
    {

        $success = false;
        $message = 'message.error_register';

        $validated = $request->validated();

        if (User::create($validated)) {

            $success = true;
            $message = "message.register_message";
        } else {

            // Se c'è stato un errore nella creazione, torniamo indietro con un messaggio di errore generico
            return back()->with([
                'success' => $success,
                'message' => $message,
            ]);
        }
    }

    public function logout(Request $request)
    {
        // 1. Esegue il logout
        Auth::logout();

        // 2. Invalida la sessione (per sicurezza)
        $request->session()->invalidate();

        // 3. Rigenera il token CSRF (per sicurezza)
        $request->session()->regenerateToken();

        // 4. Reindirizza alla HOME
        return redirect('/')->with([
            'message' => 'message.logout',
        ]);
    }


}
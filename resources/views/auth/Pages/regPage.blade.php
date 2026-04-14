@extends('auth.master')

@section('title', 'Registrazione - Vendly')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">{{ __('Registra il tuo account') }}</h2>
        <p class="text-gray-400 text-sm mt-2 font-medium">{{ __('Inserisci le credenziali per registrarti') }}</p>
    </div>

    <form action="{{ route('Auth.register') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label for="name" class="block text-sm font-semibold text-gray-600">{{ __('Nome') }}</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="50" placeholder="Mario"
                    class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300"
                    required>
            </div>

            <div class="space-y-1">
                <label for="surname" class="block text-sm font-semibold text-gray-600">{{ __('Cognome') }}</label>
                <input type="text" id="surname" name="surname" value="{{ old('surname') }}" maxlength="30"
                    placeholder="Rossi"
                    class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300"
                    required>
            </div>

            <div class="space-y-1">
                <label for="phone" class="block text-sm font-semibold text-gray-600">{{ __('Numero di Telefono') }}</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" maxlength="15"
                    placeholder="3471802344"
                    class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300">
            </div>

            <div class="space-y-1">
                <label for="DateOfBirth"
                    class="block text-sm font-semibold text-gray-600">{{ __('Data di Nascita') }}</label>
                <input type="date" id="DateOfBirth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                    class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200">
            </div>
        </div>

        <div class="space-y-1">
            <label for="address_street" class="block text-sm font-semibold text-gray-600">{{ __('Via') }}</label>
            <input type="text" id="address_street" name="address[street]" value="{{ old('address.street') }}"
                maxlength="100" placeholder="Rossi 12"
                class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300">
        </div>

        <div class="space-y-1">
            <label for="address_city" class="block text-sm font-semibold text-gray-600">{{ __('Città') }}</label>
            <input type="text" id="address_city" name="address[city]" value="{{ old('address.city') }}" maxlength="100"
                placeholder="Messina"
                class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300">
        </div>

        <div class="space-y-1">
            <label for="address_zip" class="block text-sm font-semibold text-gray-600">CAP</label>
            <input type="text" id="address_zip" name="address[zip_code]" value="{{ old('address.zip_code') }}"
                maxlength="100" placeholder="12023"
                class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300">
        </div>

        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-600">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="40"
                placeholder="m@example.com"
                class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300"
                required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label for="password" class="block text-sm font-semibold text-gray-600">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••"
                    class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300"
                    required>
            </div>

            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-600">{{ __('Conferma
                        Password') }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••"
                    class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300"
                    required>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-medium border border-red-100">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit"
            class="w-full bg-vendly hover:bg-[#0e9a96] text-white font-bold py-3 px-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 mt-2">
            {{ __('Registrati') }}
        </button>

    </form>

    <div class="mt-6">
        <a href="{{ route('Auth.loginPage') }}"
            class="flex items-center justify-center w-full py-3 px-4 border-2 border-vendly/20 text-vendly font-bold rounded-xl hover:bg-vendly/5 transition-all duration-300">
            {{ __('Hai già un account?') }}
        </a>
    </div>
@endsection
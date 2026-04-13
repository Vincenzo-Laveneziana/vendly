@extends('auth.master-login')

@section('title', 'Registrazione')

@section('content')
    <div class="flex items-center justify-center h-full p-2 bg-gray-100">

        <div class="bg-white p-8 rounded-2xl w-full max-w-lg border border-gray-200">
            <div class="text-center mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-600">Registrazione Utente</h1>
                <p class="text-gray-500 text-sm mt-2">Registra il tuo account</p>
            </div>

            <form action="/registration" method="POST">
                @csrf

                <div class="text-sm md:text-base grid grid-cols-1 md:grid-cols-2 md:gap-3 gap-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="50"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                            required>
                    </div>

                    <div>
                        <label for="surname" class="block text-sm font-medium text-gray-700 mb-2">Cognome</label>
                        <input type="text" id="surname" name="surname" value="{{ old('surname') }}" maxlength="30"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                            required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Numero di Telefono</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" maxlength="15"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                    </div>

                    <div>
                        <label for="DateOfBirth" class="block text-sm font-medium text-gray-700 mb-2">Data di
                            Nascita</label>
                        <input type="date" id="DateOfBirth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                    </div>

                    <div class="md:col-span-2">
                        <label for="address_street" class="block text-sm font-medium text-gray-700 mb-2">Via</label>
                        <input type="text" id="address_street" name="address[street]" value="{{ old('address.street') }}"
                            maxlength="100"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                    </div>

                    <div class="md:col-span-2">
                        <label for="address_city" class="block text-sm font-medium text-gray-700 mb-2">Città</label>
                        <input type="text" id="address_city" name="address[city]" value="{{ old('address.city') }}"
                            maxlength="100"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                    </div>

                    <div class="md:col-span-2">
                        <label for="address_zip" class="block text-sm font-medium text-gray-700 mb-2">CAP</label>
                        <input type="text" id="address_zip" name="address[zip_code]" value="{{ old('address.zip_code') }}"
                            maxlength="100"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="40"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                            required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                            required>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Conferma
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="••••••••"
                            class="w-full px-2 py-2 md:px-4 md:py-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                            required>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded-lg mt-4 text-sm border border-red-200">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit"
                    class="w-full text-lg bg-blue-600 hover:bg-blue-700 text-white font-bold mt-4 px-4 py-3 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5">
                    Registrati
                </button>

            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600">
                    Hai un account?
                    <a href="/login" class="font-bold text-blue-600 hover:text-blue-800 hover:underline ml-1">
                        Accedi
                    </a>
                </p>
            </div>

        </div>
    </div>
@endsection
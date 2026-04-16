@extends('auth.master')

@section('title', 'Registrazione - Vendly')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">{{ __('message.register_your_account') }}</h2>
        <p class="text-gray-400 text-sm mt-2 font-medium">{{ __('message.enter_credentials_to_register') }}</p>
    </div>

    <form action="{{ route('Auth.register') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label for="name" class="block text-sm font-semibold text-gray-600">{{ __('message.name') }}</label>
                <div class="vue-island">
                    <ui-input type="text" id="name" name="name" default-value="{{ old('name') }}" maxlength="50"
                        placeholder="Mario" required />
                </div>
            </div>

            <div class="space-y-1">
                <label for="surname" class="block text-sm font-semibold text-gray-600">{{ __('message.surname') }}</label>
                <div class="vue-island">
                    <ui-input type="text" id="surname" name="surname" default-value="{{ old('surname') }}" maxlength="30"
                        placeholder="Rossi" required />
                </div>
            </div>

            <div class="space-y-1">
                <label for="phone"
                    class="block text-sm font-semibold text-gray-600">{{ __('message.phone_number') }}</label>
                <div class="vue-island">
                    <ui-input type="text" id="phone" name="phone" default-value="{{ old('phone') }}" maxlength="15"
                        placeholder="3471802344" />
                </div>
            </div>

            <div class="space-y-1">
                <label for="DateOfBirth"
                    class="block text-sm font-semibold text-gray-600">{{ __('message.date_of_birth') }}</label>
                <div class="vue-island">
                    <ui-input type="date" id="DateOfBirth" name="date_of_birth"
                        default-value="{{ old('date_of_birth') }}" />
                </div>
            </div>
        </div>

        <div class="space-y-1">
            <label for="address_street" class="block text-sm font-semibold text-gray-600">{{ __('message.street') }}</label>
            <div class="vue-island">
                <ui-input type="text" id="address_street" name="address[street]" default-value="{{ old('address.street') }}"
                    maxlength="100" placeholder="Rossi 12" />
            </div>
        </div>

        <div class="space-y-1">
            <label for="address_city" class="block text-sm font-semibold text-gray-600">{{ __('message.city') }}</label>
            <div class="vue-island">
                <ui-input type="text" id="address_city" name="address[city]" default-value="{{ old('address.city') }}"
                    maxlength="100" placeholder="Messina" />
            </div>
        </div>

        <div class="space-y-1">
            <label for="address_zip" class="block text-sm font-semibold text-gray-600">{{ __('message.zip_code') }}</label>
            <div class="vue-island">
                <ui-input type="text" id="address_zip" name="address[zip]" default-value="{{ old('address.zip') }}"
                    maxlength="100" placeholder="12023" />
            </div>
        </div>

        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-600">Email</label>
            <div class="vue-island">
                <ui-input type="email" id="email" name="email" default-value="{{ old('email') }}" maxlength="40"
                    placeholder="m@example.com" required />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label for="password" class="block text-sm font-semibold text-gray-600">{{ __('message.password') }}</label>
                <div class="vue-island">
                    <ui-input type="password" id="password" name="password" placeholder="••••••••" required />
                </div>
            </div>

            <div class="space-y-1">
                <label for="password_confirmation"
                    class="block text-sm font-semibold text-gray-600">{{ __('message.confirm_password') }}</label>
                <div class="vue-island">
                    <ui-input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••"
                        required />
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-medium border border-red-100">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="vue-island">
            <ui-button type="submit" class="w-full mt-2">
                {{ __('message.register') }}
            </ui-button>
        </div>

    </form>

    <div class="mt-6">
        <a href="{{ route('Auth.loginPage') }}"
            class="flex items-center justify-center w-full py-3 px-4 border-2 border-vendly/20 text-green font-bold rounded-xl hover:bg-vendly/5 transition-all duration-300">
            {{ __('message.already_have_account') }}
        </a>
    </div>
@endsection
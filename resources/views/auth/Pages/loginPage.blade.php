@extends('auth.master')

@section('title', 'Accedi - Vendly')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">{{ __('message.log_in_to_your_account') }}</h2>
        <p class="text-gray-400 text-sm mt-2 font-medium">{{ __('message.enter_credentials_to_login') }}</p>
    </div>

    <form action="{{ route('Auth.login') }}" method="POST" class="space-y-5">
        @csrf

        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-600">Email</label>
            <div class="vue-island">
                <ui-input type="email" id="email" name="email" default-value="{{ old('email') }}" placeholder="m@example.com"
                    maxlength="40" required />
            </div>
        </div>

        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-semibold text-gray-600">{{ __('message.password') }}</label>
                <a href="#" class="text-xs text-gray-400 hover:text-green transition-colors">{{ __('message.forgot_password') }}</a>
            </div>

            <div class="vue-island">
                <ui-input type="password" id="password" name="password" maxlength="20" placeholder="••••••••" required />
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-medium border border-red-100">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="vue-island">
            <ui-button type="submit" class="w-full h-12 text-sm uppercase tracking-widest shadow-lg shadow-primary/20">
                {{ __('message.log_in') }}
            </ui-button>
        </div>

    </form>

    <div class="mt-6">
        <a href="{{ route('Auth.regPage') }}"
            class="flex items-center justify-center w-full py-3 px-4 border-2 border-vendly/20 text-green font-bold rounded-xl hover:bg-vendly/5 transition-all duration-300">
            {{ __('message.create_an_account') }}
        </a>
    </div>
@endsection
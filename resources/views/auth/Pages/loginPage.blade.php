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
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="m@example.com"
                maxlength="40"
                class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300"
                required>
        </div>

        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-semibold text-gray-600">{{ __('message.password') }}</label>
                <a href="#" class="text-xs text-gray-400 hover:text-vendly transition-colors">{{ __('message.forgot_password') }}</a>
            </div>

            <input type="password" id="password" name="password" maxlength="20" placeholder="••••••••"
                class="w-full px-4 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition duration-200 placeholder:text-gray-300"
                required>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-medium border border-red-100">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit"
            class="w-full bg-vendly hover:bg-[#0e9a96] text-white font-bold py-3 px-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
            {{ __('message.log_in') }}
        </button>

    </form>

    <div class="mt-6">
        <a href="{{ route('Auth.regPage') }}"
            class="flex items-center justify-center w-full py-3 px-4 border-2 border-vendly/20 text-vendly font-bold rounded-xl hover:bg-vendly/5 transition-all duration-300">
            {{ __('message.create_an_account') }}
        </a>
    </div>
@endsection
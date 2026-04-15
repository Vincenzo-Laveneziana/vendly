@extends('frontoffice.master')

@section('title', 'Profilo')

@section('content')
    <!-- Profile Navigation Bar -->
    <div class="w-full bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-16 md:top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex items-center overflow-x-auto no-scrollbar h-16 md:h-20">
                <a href="{{ route('Backoffice.profile') }}"
                    class="flex-1 min-w-[140px] h-full flex items-center justify-center transition-all relative group">
                    <div
                        class="px-6 py-2 rounded-xl transition-all {{ request()->routeIs('Backoffice.profile') ? 'bg-vendly text-white font-bold' : 'text-gray-600 hover:text-gray-900 font-medium' }}">
                        {{ __('message.my_profile') }}
                    </div>
                    <div class="absolute right-0 top-1/4 bottom-1/4 w-[1px] bg-gray-200"></div>
                </a>
                <a href="#"
                    class="flex-1 min-w-[140px] h-full flex items-center justify-center transition-all relative group">
                    <div class="px-6 py-2 rounded-xl transition-all text-gray-600 hover:text-gray-900 font-medium">
                        {{ __('message.my_favorites') }}
                    </div>
                    <div class="absolute right-0 top-1/4 bottom-1/4 w-[1px] bg-gray-200"></div>
                </a>
                <a href="#"
                    class="flex-1 min-w-[140px] h-full flex items-center justify-center transition-all relative group">
                    <div class="px-6 py-2 rounded-xl transition-all text-gray-600 hover:text-gray-900 font-medium">
                        {{ __('message.my_ads') }}
                    </div>
                    <div class="absolute right-0 top-1/4 bottom-1/4 w-[1px] bg-gray-200"></div>
                </a>
                <a href="#"
                    class="flex-1 min-w-[140px] h-full flex items-center justify-center transition-all relative group">
                    <div class="px-6 py-2 rounded-xl transition-all text-gray-600 hover:text-gray-900 font-medium">
                        {{ __('message.my_orders') }}
                    </div>
                    <div class="absolute right-0 top-1/4 bottom-1/4 w-[1px] bg-gray-200"></div>
                </a>
                <a href="{{ route('Backoffice.createChat') }}"
                    class="flex-1 min-w-[140px] h-full flex items-center justify-center transition-all relative group">
                    <div class="px-6 py-2 rounded-xl transition-all text-gray-600 hover:text-gray-900 font-medium">
                        {{ __('message.my_chats') }}
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gray-50 py-12" style="font-family: 'Satoshi-Regular', sans-serif;">

        @include('backoffice.profile.partials.profileDetails')

        <div class="max-w-7xl mx-auto my-6 px-4 md:px-8 pb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ __('message.your_ads') }}
                </h2>
                <a href="{{ route('Frontoffice.explore') }}"
                    class="text-gray-700 hover:text-[#08B2B4] font-semibold text-sm flex items-center gap-1 transition">
                    {{ __('message.go_to_ads') }} <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">

                @forelse($products as $product)
                    @include('frontoffice.partials.cardProdotto', ['product' => $product])
                @empty
                    <div class="col-span-full text-center py-20 bg-gray-50 rounded-[2rem]">
                        <p class="text-gray-500">{{ __('Nessun annuncio trovato.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
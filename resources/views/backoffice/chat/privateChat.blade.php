@extends('frontoffice.master')

@php
    $titoloProdotto = isset($product) && $product->title === 'Chat';
@endphp

@section('title', $titoloProdotto)

@section('content')
    <!-- Decorative Blobs -->
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="fixed bottom-0 -left-64 w-[32rem] pointer-events-none rotate-[15deg] opacity-20 -z-0 select-none">
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="fixed top-32 -right-64 w-[32rem] pointer-events-none -rotate-[20deg] opacity-20 -z-0 select-none">

    <div class="h-[calc(100vh-80px)] w-full p-6 flex bg-transparent md:p-6 md:gap-6 overflow-hidden relative z-10">

        <!-- COLONNA SINISTRA: Sidebar -->
        <div id="chat-sidebar"
            class="hidden md:flex w-full md:w-80 flex-col bg-vendly rounded-[2rem] shadow-xl h-full overflow-hidden shrink-0">
            <!-- Search Bar in Sidebar -->
            <div class="p-6 pb-2 shrink-0">
                <div
                    class="relative flex items-center bg-white/95 rounded-2xl shadow-inner border border-white/20 px-3 group focus-within:ring-2 focus-within:ring-white/20 transition-all">
                    <span
                        class="material-symbols-outlined text-gray-400 text-lg transition-colors group-focus-within:text-vendly flex-shrink-0">search</span>
                    <input type="text" placeholder="{{ __('message.search_chat') }}"
                        class="w-full pl-2 pr-4 py-2 bg-transparent border-none focus:outline-none focus:ring-0 text-sm">
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-3 no-scrollbar">
                @if (isset($conversations) && $conversations->count() > 0)
                    @foreach ($conversations as $chat)
                        @php
                            $otherPerson = $chat->buyer_id == auth()->id() ? $chat->seller : $chat->buyer;
                            $isActive = isset($conversation) && $conversation->id === $chat->id;
                        @endphp

                        <a href="{{ route('Backoffice.createChat', ['idProdotto' => $chat->product_id, 'idConversazione' => $chat->id]) }}"
                            class="chat-item-btn block w-full p-4 bg-white rounded-2xl shadow-sm transition-all hover:shadow-md hover:scale-[1.02] active:scale-95 
                                              {{ $isActive ? 'ring-2 ring-white ring-offset-2 ring-offset-vendly' : '' }}">

                            <div class="flex gap-4 items-center">
                                <!-- Product Image Small -->
                                <div class="w-12 h-12 rounded-xl border border-gray-100 overflow-hidden flex-shrink-0 bg-gray-50">
                                    @if($chat->product && $chat->product->images->isNotEmpty())
                                        <img src="{{ Storage::url($chat->product->images->first()->path) }}"
                                            class="w-full h-full object-cover" alt="">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <span class="material-symbols-outlined text-xl">image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-bold text-gray-900 text-sm truncate">
                                        {{ $chat->product->title ?? __('message.product_removed') }}
                                    </h4>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ $otherPerson->name ?? __('message.user_placeholder') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-center">
                        <p class="text-sm text-white/80">{{ __('message.no_conversations') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- COLONNA DESTRA: Finestra Chat -->
        <div id="chat-window"
            class="flex w-full md:flex-1 flex-col h-full bg-white/90 backdrop-blur-sm rounded-[2rem] shadow-xl overflow-hidden border border-white/20">
            <!-- HEADER CHAT -->
            <div class="p-4 md:p-6 pb-4 shrink-0">
                <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                    <!-- FRECCIA INDIETRO (Solo Mobile) -->
                    <button id="btn-back-mobile" type="button"
                        class="md:hidden p-2 -ml-2 text-gray-500 hover:bg-gray-100 rounded-full transition flex-shrink-0">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>

                    @if (isset($product))
                        @include('backoffice.chat.partials.chatWindow')
                    @else
                        <div class="flex-1 text-center py-2 font-medium text-gray-400">
                            {{ __('message.select_chat') }}
                        </div>
                    @endif
                </div>
            </div>

            @if (isset($product))
                @include('backoffice.chat.partials.textArea')
            @endif
        </div>

    </div>

    <!-- SCRIPT AGGIORNATO -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('chat-sidebar');
            const chatWindow = document.getElementById('chat-window');
            const backBtn = document.getElementById('btn-back-mobile');
            const chatItems = document.querySelectorAll('.chat-item-btn');

            if (backBtn) {
                backBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (window.innerWidth < 768) {
                        chatWindow.classList.remove('flex');
                        chatWindow.classList.add('hidden');
                        sidebar.classList.remove('hidden');
                        sidebar.classList.add('flex');
                    }
                });
            }

            chatItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('flex');
                        sidebar.classList.add('hidden');
                        chatWindow.classList.remove('hidden');
                        chatWindow.classList.add('flex');
                    }
                });
            });
        });
    </script>
@endsection
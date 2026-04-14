@extends('frontoffice.master')

@php
    $titoloProdotto = isset($product) && $product->title === 'Chat';
@endphp

@section('title', $titoloProdotto)

@section('content')
    <div class="h-[calc(100vh-80px)] w-full flex bg-white md:bg-gray-50 md:p-4 md:gap-4 overflow-hidden">

        <!-- COLONNA SINISTRA: Sidebar -->
        <div id="chat-sidebar"
            class="hidden md:flex w-full md:w-1/3 flex-col bg-white md:border md:border-gray-200 md:rounded-xl md:shadow-sm h-full overflow-hidden shrink-0">
            <div class="p-4 border-b border-gray-100 flex-shrink-0">
                <h2 class="text-lg font-bold text-gray-800">{{ __('message.your_conversations') }}</h2>
            </div>

            <div class="flex-1 overflow-y-auto p-2 space-y-1">
                @if(isset($conversations) && $conversations->count() > 0)
                    @foreach($conversations as $chat)
                        @php
                            // Recupera l'altro utente in modo sicuro
                            $otherPerson = ($chat->buyer_id == auth()->id()) ? $chat->seller : $chat->buyer;

                            // Verifica se la chat è quella attiva tramite l'URL o la variabile (se esiste)
                            $isActive = isset($conversation) && $conversation->id === $chat->id;
                        @endphp

                        <a href="{{ route('Backoffice.createChat', ['idProdotto' => $chat->product_id, 'idConversazione' => $chat->id]) }}"
                            class="chat-item-btn block w-full p-3 border-l-4 rounded-r-lg transition 
                                                                                                                                                                                                                                            {{ $isActive ? 'bg-blue-50 border-blue-600' : 'border-transparent hover:bg-gray-50' }}">

                            <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold text-gray-800 text-sm truncate">
                                    {{ $otherPerson->name ?? __('Utente eliminato') }}
                                </span>
                                <span class="text-[10px] text-gray-400">
                                    {{ $chat->updated_at->format('d/m H:i') }}
                                </span>
                            </div>

                            <p class="text-xs {{ $isActive ? 'text-gray-600' : 'text-gray-500' }} truncate">
                                {{ $chat->product->title ?? __('Prodotto rimosso') }}
                            </p>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-center">
                        <p class="text-sm text-gray-500">{{ __('Non hai ancora nessuna conversazione.') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- COLONNA DESTRA: Finestra Chat -->
        <div id="chat-window"
            class="flex w-full md:w-2/3 flex-col h-full bg-white md:border md:border-gray-200 md:rounded-xl md:shadow-sm overflow-hidden">
            <!-- HEADER CHAT -->
            <div
                class="flex items-center gap-3 md:gap-4 p-3 md:p-4 border-b border-gray-200 bg-white flex-shrink-0 shadow-sm z-10">
                <!-- FRECCIA INDIETRO (Solo Mobile) -->
                <button id="btn-back-mobile" type="button"
                    class="md:hidden p-2 -ml-2 text-gray-500 hover:bg-gray-100 rounded-full transition flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                @if(isset($product))
                    @include('backoffice.chat.partials.chatWindow')
                @else
                    <div>{{ __('message.select_chat') }}</div>
                @endif
            </div>
            @if(isset($product))
                @include('backoffice.chat.partials.textArea')
            @endif
        </div>

        <!-- SCRIPT AGGIORNATO -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('chat-sidebar');
                const chatWindow = document.getElementById('chat-window');
                const backBtn = document.getElementById('btn-back-mobile');
                // Selezioniamo TUTTI i bottoni delle chat nella sidebar
                const chatItems = document.querySelectorAll('.chat-item-btn');

                // 1. Logica per la freccia indietro: Nasconde la chat, mostra la sidebar
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

                // 2. Logica per rientrare nella chat: Nasconde la sidebar, mostra la chat
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
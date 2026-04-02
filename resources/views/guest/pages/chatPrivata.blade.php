@extends('guest.master-guest')

@section('title', 'Chat - ' . $product->title)

@section('content-guest')
    <div class="h-[calc(100vh-80px)] w-full flex bg-white md:bg-gray-50 md:p-4 md:gap-4 overflow-hidden">
        
        <!-- COLONNA SINISTRA: Sidebar -->
        <div id="chat-sidebar" class="hidden md:flex w-full md:w-1/3 flex-col bg-white md:border md:border-gray-200 md:rounded-xl md:shadow-sm h-full overflow-hidden shrink-0">
            <div class="p-4 border-b border-gray-100 flex-shrink-0">
                <h2 class="text-lg font-bold text-gray-800">Le tue conversazioni</h2>
            </div>
            
            <div class="flex-1 overflow-y-auto p-2 space-y-1">
                @if(isset($conversations) && $conversations->count() > 0)
                    @foreach($conversations as $chat)
                        @php
                            // 1. Capiamo chi è l'altra persona nella conversazione
                            // Se il mio ID è uguale a quello del compratore, mostro il venditore. Altrimenti, mostro il compratore.
                            $otherPerson = ($chat->buyer_id === auth()->id()) ? $chat->seller : $chat->buyer;

                            // 2. Controlliamo se questa è la chat correntemente aperta
                            $isActive = isset($conversation) && $conversation->id === $chat->id;
                        @endphp

                        <!-- Usiamo il tag <a> per permettere la navigazione tra le chat -->
                        <a href="{{ route('CambiaChat', ['idProdotto' => $chat->product_id], ['idConversazione' => $chat->id]) }}" 
                        class="chat-item-btn block w-full text-left p-3 border-l-4 rounded-r-lg transition 
                                {{ $isActive ? 'bg-blue-50 border-blue-600 hover:bg-blue-100' : 'border-transparent hover:bg-gray-50 hover:border-blue-300' }}">
                            
                            <div class="flex justify-between items-center mb-1">
                                <!-- Nome dell'interlocutore -->
                                <span class="font-semibold text-gray-800 text-sm truncate">
                                    {{ $otherPerson->name ?? 'Utente eliminato' }}
                                </span>
                                
                                <!-- Data ultimo aggiornamento/messaggio -->
                                <span class="text-[10px] text-gray-400">
                                    {{ $chat->updated_at->format('d/m H:i') }}
                                </span>
                            </div>
                            
                            <!-- Titolo del prodotto -->
                            <p class="text-xs {{ $isActive ? 'text-gray-600' : 'text-gray-500' }} truncate">
                                {{ $chat->product->title ?? 'Prodotto rimosso' }}
                            </p>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-center">
                        <p class="text-sm text-gray-500">Non hai ancora nessuna conversazione.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- COLONNA DESTRA: Finestra Chat -->
        <div id="chat-window" class="flex w-full md:w-2/3 flex-col h-full bg-white md:border md:border-gray-200 md:rounded-xl md:shadow-sm overflow-hidden">
            
            <!-- HEADER CHAT -->
            <div class="flex items-center gap-3 md:gap-4 p-3 md:p-4 border-b border-gray-200 bg-white flex-shrink-0 shadow-sm z-10">
                
                <!-- FRECCIA INDIETRO (Solo Mobile) -->
                <button id="btn-back-mobile" type="button" class="md:hidden p-2 -ml-2 text-gray-500 hover:bg-gray-100 rounded-full transition flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Immagine Prodotto -->
                 @if($product->images->isNotEmpty())
                    <div class="w-14 h-14 md:w-16 md:h-16 flex-shrink-0">
                        <img src="{{ Storage::url($product->images->first()->path) }}"
                             alt="{{ $product->title }}"
                             class="w-full h-full object-cover rounded-lg border border-gray-200 shadow-sm">
                    </div>
                @else
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-200 rounded-lg border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                @endif

                <!-- Titolo e Info -->
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm md:text-base font-bold text-gray-900 truncate">{{ $product->title }}</h3>
                    <p class="text-[10px] md:text-xs text-gray-500 truncate mb-1">Venditore: {{ $product->user->name ?? 'Utente' }}</p>
                    
                    <a href="{{ route('prodotto', $product->id) }}" class="inline-block text-[10px] md:text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-1 px-3 rounded-full transition whitespace-nowrap">
                        Vedi annuncio
                    </a>
                </div>

                <!-- PREZZO -->
                <div class="text-right flex-shrink-0 pl-2">
                    <span class="text-[10px] md:text-xs text-gray-400 uppercase font-bold tracking-wider block">Prezzo</span>
                    <span class="text-xl md:text-2xl font-black text-blue-600">
                        {{ number_format($product->price, 2, ',', '.') }}€
                    </span>
                </div>
            </div>

            @include('guest.partials.areamessaggi')
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
                backBtn.addEventListener('click', function(e) {
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
            chatItems.forEach(function(item) {
                item.addEventListener('click', function() {
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
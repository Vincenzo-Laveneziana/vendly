@extends('frontoffice.master')

@section('title', 'Le mie conversazioni')

@section('content')
    <div class="h-[calc(100vh-80px)] w-full flex bg-white md:bg-gray-50 md:p-4 md:gap-4 overflow-hidden">

        <!-- COLONNA SINISTRA: Sidebar -->
        <!-- NOTA: Modificato in "flex" di default (non più hidden), così su mobile si vede subito la lista! -->
        <div id="chat-sidebar"
            class="flex w-full md:w-1/3 flex-col bg-white md:border md:border-gray-200 md:rounded-xl md:shadow-sm h-full overflow-hidden shrink-0">
            <div class="p-4 border-b border-gray-100 flex-shrink-0">
                <h2 class="text-lg font-bold text-gray-800">{{ __('message.your_conversations') }}</h2>
            </div>
        </div>

        <!-- COLONNA DESTRA: Finestra Chat (Stato Vuoto) -->
        <!-- NOTA: Modificato in "hidden md:flex", così su mobile sparisce per far posto alla lista -->
        <div id="chat-window"
            class="hidden md:flex w-full md:w-2/3 flex-col h-full bg-gray-50 md:border md:border-gray-200 md:rounded-xl md:shadow-sm overflow-hidden items-center justify-center">

            <!-- SCHERMATA VUOTA (Empty State) -->
            <div class="text-center opacity-60 flex flex-col items-center p-6">
                <!-- Icona messaggi decorativa -->
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('message.your_conversations') }}</h3>
                <p class="text-sm text-gray-500 max-w-sm mx-auto">
                    {{ __('Seleziona una chat dalla barra laterale per visualizzare i messaggi o iniziare una nuova conversazione.') }}
                </p>
            </div>

        </div>
    </div>

    <!-- SCRIPT (Semplificato per la vista Index) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // In questa vista "Index", se sei su desktop non fa nulla.
            // Se sei su mobile e clicchi una chat, idealmente dovrebbe reindirizzarti alla pagina specifica della chat.
            // Dato che i tasti ora sono link (<a>), non serve Javascript per scambiare le classi: 
            // il link caricherà semplicemente la pagina con la vista "chat attiva" che abbiamo fatto precedentemente!
        });
    </script>
@endsection
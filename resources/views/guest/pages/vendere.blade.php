@extends('guest.master-guest')

@section('title', 'Vendi con TuttoSubito')

@section('content-guest')
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section con immagine come background -->
        <div class="relative z-0 w-full mb-8 overflow-hidden shadow-lg h-96 md:h-96" style="background-image: url('{{ asset('images/imageVendere.webp') }}'); background-size: cover; background-position: center;">
            
            <!-- Contenuto in sovraimpressione (visibile su desktop) -->
            <div class="hidden md:flex absolute inset-0 z-10 items-center justify-end pr-12 pointer-events-auto">
                <div class="bg-white rounded-lg shadow-lg p-8 max-w-md">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Inserisci il tuo annuncio in pochi minuti</h1>
                    <p class="text-gray-600 text-lg mb-6">Raggiungi milioni di acquirenti in tutta Italia e vendi i tuoi articoli in pochi minuti.</p>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('formVendita') }}" class="inline-flex items-center justify-center w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition duration-300 text-lg pointer-events-auto cursor-pointer">
                            <span class="material-symbols-outlined text-[24px] mr-2">add</span>
                            Inizia a vendere
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenuto mobile (sotto l'immagine) -->
        <div class="md:hidden bg-white rounded-lg shadow-lg p-8 m-2 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Inserisci il tuo annuncio in pochi minuti</h1>
            <a href="{{ route('formVendita') }}" class="inline-flex items-center justify-center w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition duration-300 text-lg">
                <span class="material-symbols-outlined text-[24px] mr-2">add</span>
                Inizia a vendere
            </a>
        </div>

        <div class="py-12 bg-gray-50 max-w-7xl mx-auto px-4 md:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight mb-4">Perché vendere con TuttoSubito?</h2>
            <p class="text-gray-600 text-lg mb-6">TuttoSubito è la piattaforma leader in Italia per la compravendita di articoli usati. Con milioni di utenti attivi, è il posto ideale per vendere i tuoi articoli velocemente e senza complicazioni.</p>
            <section class="py-6">
                <div class="max-w-6xl mx-auto px-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                        
                        <div class="flex flex-col items-center md:items-start group border-gray-300 border rounded-lg p-6">
                            <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mb-5 shadow-sm group-hover:bg-blue-50 transition-colors">
                                <span class="text-lg font-bold text-gray-900">1</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2 leading-tight">Scegli cosa vendere</h3>
                            <p class="text-sm text-gray-500 leading-relaxed text-center md:text-left">
                                Elettronica, moda, casa, auto e molto altro. Inizia dai prodotti che non usi più.
                            </p>
                        </div>

                        <div class="flex flex-col items-center md:items-start group border-gray-300 border rounded-lg p-6">
                            <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mb-5 shadow-sm group-hover:bg-blue-50 transition-colors">
                                <span class="text-lg font-bold text-gray-900">2</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2 leading-tight">Crea l'annuncio</h3>
                            <p class="text-sm text-gray-500 leading-relaxed text-center md:text-left">
                                Scatta foto chiare e aggiungi una descrizione dettagliata per attirare acquirenti.
                            </p>
                        </div>

                        <div class="flex flex-col items-center md:items-start group border-gray-300 border rounded-lg p-6">
                            <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mb-5 shadow-sm group-hover:bg-blue-50 transition-colors">
                                <span class="text-lg font-bold text-gray-900">3</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2 leading-tight">Vendi subito</h3>
                            <p class="text-sm text-gray-500 leading-relaxed text-center md:text-left">
                                Pubblica e raggiungi milioni di persone. Gestisci le offerte direttamente dal profilo.
                            </p>
                        </div>

                    </div>
                </div>
            </section>
        
        </div>
    </div>

@endsection
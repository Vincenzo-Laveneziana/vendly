@extends('guest.master-guest')

@section('title', 'Pagina 1')

@section('content-guest')
    <!-- Hero Section con immagine come background -->
    <div class="relative z-0 w-full mb-8 rounded-lg overflow-hidden shadow-lg h-96 md:h-96" style="background-image: url('{{ asset('images/imageVendere.webp') }}'); background-size: cover; background-position: center;">
        
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
    <div class="md:hidden bg-white rounded-lg shadow-lg p-8 mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Inserisci il tuo annuncio in pochi minuti</h1>
        <a href="{{ route('formVendita') }}" class="inline-flex items-center justify-center w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition duration-300 text-lg">
            <span class="material-symbols-outlined text-[24px] mr-2">add</span>
            Inizia a vendere
        </a>
    </div>

@endsection
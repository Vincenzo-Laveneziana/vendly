@extends('guest.master-guest')

@section('title', 'Pagina 1')

@section('content-guest')


<div>
    <h1 class="text-center text-3xl font-bold text-black-600 mt-8 mb-4">Benvenuto su <img src="{{ asset('images/logo.png') }}" alt="Logo TuttoSubito" class="h-12 inline-block align-middle">!</h1>
    <p class="text-center text-gray-600 text-sm md:text-lg mb-6">
        Esplora un mondo di opportunità per vendere e acquistare prodotti usati in modo semplice e veloce. Scopri le nostre categorie e trova ciò che stai cercando!
    </p>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6 p-4 md:p-8 w-full">
        
        <div class="flex flex-col text-center bg-white rounded-2xl border-2 border-gray-300 hover:bg-blue-50 hover:border-blue-400 transition-all duration-300 p-3 md:p-6 shadow-sm hover:shadow-md">
            <span class="material-symbols-outlined text-[28px] md:text-[40px] text-blue-600 mb-2">smart_toy</span>
            <h2 class="text-xs md:text-xl font-bold text-gray-800 md:mb-3">Elettronica</h2>
            <p class="hidden md:flex text-gray-600 text-sm mt-auto">Trova smartphone, laptop, TV e molto altro.</p>
        </div>

        <div class="flex flex-col text-center bg-white rounded-2xl border-2 border-gray-300 hover:bg-blue-50 hover:border-blue-400 transition-all duration-300 p-3 md:p-6 shadow-sm hover:shadow-md">
            <span class="material-symbols-outlined text-[28px] md:text-[40px] text-blue-600 mb-2">house</span>      
            <h2 class="text-xs md:text-xl font-bold text-gray-800 md:mb-3">Casa e Arredamento</h2>
            <p class="hidden md:flex text-gray-600 text-sm mt-auto">Dai mobili agli elettrodomestici, trova tutto per la tua casa.</p>
        </div>

        <div class="flex flex-col text-center bg-white rounded-2xl border-2 border-gray-300 hover:bg-blue-50 hover:border-blue-400 transition-all duration-300 p-3 md:p-6 shadow-sm hover:shadow-md">
            <span class="material-symbols-outlined text-[28px] md:text-[40px] text-blue-600 mb-2">stadia_controller</span>
            <h2 class="text-xs md:text-xl font-bold text-gray-800 md:mb-3">Giochi e Collezionabili</h2>
            <p class="hidden md:flex text-gray-600 text-sm mt-auto">Trova videogiochi, carte da collezione e molto altro.</p>
        </div>

        <div class="flex flex-col text-center bg-white rounded-2xl border-2 border-gray-300 hover:bg-blue-50 hover:border-blue-400 transition-all duration-300 p-3 md:p-6 shadow-sm hover:shadow-md">
            <span class="material-symbols-outlined text-[28px] md:text-[40px] text-blue-600 mb-2">directions_car</span>
            <h2 class="text-xs md:text-xl font-bold text-gray-800 md:mb-3">Moto, Auto e Veicoli</h2>
            <p class="hidden md:flex text-gray-600 text-sm mt-auto">Trova auto, moto e altri veicoli.</p>
        </div>
    </div>

    <div class="flex flex-col bg-white border-2 border-gray-400 shadow-xl rounded-2xl p-6 md:flex-row md:justify-between items-center justify-center gap-3 w-full max-w-4xl mx-auto mt-8 mb-12 px-6">
        <div class="inline-flex gap-2">
            <div class="hidden md:relative md:flex items-center w-full max-w-xs">
                <span class="material-symbols-outlined text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2">search</span>
                <input type="text" id="search" name="search" placeholder="Cerca Prodotto" 
                    class="w-full px-4 py-2 pl-10 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
            </div>

            <div class="inline-flex min-w-fit items-center justify-center rounded-md hover:text-blue-600 transition text-sm text-gray-800">
                <span class="material-symbols-outlined">location_on</span>
                <span class="text-sm text-gray-600">Italia, San Donaci</span>
            </div>

            <div class="inline-flex p-2 hover:text-blue-600 font-bold transition text-sm text-gray-800">
                <span class="material-symbols-outlined mr-0.5">social_distance</span>
                <span class="text-sm text-gray-600">50km</span>
            </div>

        </div>
        
        <div class="md:hidden relative flex items-center w-full max-w-xs">
            <span class="material-symbols-outlined text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2">search</span>
            <input type="text" id="search" name="search" placeholder="Cerca Prodotto" 
                class="w-full px-4 py-2 pl-10 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
        </div>
        <a href="/vendere" class="flex items-center justify-center gap-2 w-full max-w-xs px-4 py-2 bg-blue-600 text-white font-semibold rounded-full border-2 border-blue-600 hover:bg-blue-700 transition duration-300">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span class="text-sm">Inserisci Annuncio</span>
        </a>
    </div>
    
</div>
@endsection
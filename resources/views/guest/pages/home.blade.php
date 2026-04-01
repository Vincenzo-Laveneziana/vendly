@extends('guest.master-guest')

@section('title', 'Esplora Annunci')

@section('content-guest')
    <div class="min-h-screen bg-gray-50">
        <div class="relative mb-20">
        
        <div class="relative w-full overflow-hidden shadow-lg h-80 md:h-[450px] flex flex-col items-center justify-center text-center px-6" 
            style="background-image: url('{{ asset('images/imageHome.webp') }}'); background-size: cover; background-position: center;">
            
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">
                    Benvenuto su <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 md:h-16 inline-block align-middle invert brightness-0">!
                </h1>
                <p class="text-sm md:text-xl text-gray-200 max-w-2xl mx-auto drop-shadow-md">
                    Il modo più semplice e veloce per vendere e acquistare usato nella tua zona.
                </p>
            </div>
        </div>

        <div class="absolute left-1/2 -translate-x-1/2 bottom-0 translate-y-1/2 w-full max-w-4xl px-4 z-20">
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl px-1 py-1 md:py-3 md:px-2 w-full flex items-center gap-2 md:gap-4">
                
                <form action="{{ route('ricerca') }}" method="GET" id="searchForm" class="w-full flex items-center gap-2 md:gap-4">
                    <!-- Input di ricerca -->
                    <div class="w-full flex items-center relative gap-2 text-gray-500 md:px-4 whitespace-nowrap">
                        <span class="material-symbols-outlined text-gray-900 absolute pl-1">search</span>
                        <input 
                            id="searchInput"
                            name="query"
                            placeholder="Cosa stai cercando?" 
                            class="w-full pl-7 py-3 rounded-xl text-sm md:text-md bg-gray-50 border-none focus:ring-2 focus:ring-blue-500 outline-none text-gray-700"
                            autocomplete="off"
                        >
                    </div>

                    <div class="md:flex items-center gap-2 text-gray-500 border-l border-gray-200 px-4 whitespace-nowrap">
                        <span class="material-symbols-outlined text-blue-600 text-sm md:text-md">location_on</span>
                        <span class="text-xs md:text-sm font-medium">Italia, San Donaci</span>
                    </div>
                    <a href="/vendere" class="hidden w-full md:w-auto whitespace-nowrap bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-all md:flex items-center justify-center gap-2 active:scale-95">
                        <span class="material-symbols-outlined">add</span> 
                        <span class="text-sm md:textmd">Inserisci Annuncio</span>
                    </a>
                </form>                
            </div>
            <a href="/vendere" class="mt-2 flex w-full md:w-auto whitespace-nowrap bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl transition-all md:hidden items-center justify-center gap-2 active:scale-95">
                <span class="material-symbols-outlined">add</span> 
                <span class="text-xs md:textmd">Inserisci Annuncio</span>
            </a>
        </div>
        
    </div>

   
    
    <!-- Categorie -->
    <section class="py-12 bg-gray-50"> 
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            
            <div class="md:text-center flex-col items-center justify-center mb-8">
                <h2 class="w-full text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    Esplora le Categorie
                </h2>
                <h3 class="text-gray-600 text-lg mt-2">
                    Diverse categorie per ogni tipo di prodotto. Trova quello che cerchi o vendi ciò che non ti serve più!
                </h3>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4 md:gap-6">
                
                @php
                    $categories = [
                        ['icon' => 'smart_toy', 'name' => 'Elettronica', 'color' => 'bg-blue-50'],
                        ['icon' => 'house', 'name' => 'Casa', 'color' => 'bg-green-50'],
                        ['icon' => 'stadia_controller', 'name' => 'Giochi', 'color' => 'bg-purple-50'],
                        ['icon' => 'directions_car', 'name' => 'Veicoli', 'color' => 'bg-orange-50']
                    ];
                @endphp

                @foreach($categories as $cat)
                <div class="group flex flex-col items-center justify-center p-6 bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    
                    <div class="w-16 h-16 {{ $cat['color'] }} rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl text-gray-800">
                            {{ $cat['icon'] }}
                        </span>
                    </div>

                    <h3 class="text-base md:text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                        {{ $cat['name'] }}
                    </h3>
                    
                    <span class="text-xs text-gray-400 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        Scopri di più
                    </span>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Annunci Recenti -->
    @include('guest.partials.annunciRecenti')
</div>
@endsection
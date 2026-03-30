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
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-3 md:p-4 flex flex-col md:flex-row items-center gap-4">
                
                <div class="relative w-full">
                    <span class="material-symbols-outlined text-gray-400 absolute left-3 top-1/2 -translate-y-1/2">search</span>
                    <input type="text" placeholder="Cosa stai cercando?" 
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-none focus:ring-2 focus:ring-blue-500 outline-none text-gray-700">
                </div>

                <div class="hidden md:flex items-center gap-2 text-gray-500 border-l border-gray-200 px-4 whitespace-nowrap">
                    <span class="material-symbols-outlined text-blue-600">location_on</span>
                    <span class="text-sm font-medium">Italia, San Donaci</span>
                </div>

                <a href="/vendere" class="w-full md:w-auto whitespace-nowrap bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-all flex items-center justify-center gap-2 active:scale-95">
                    <span class="material-symbols-outlined">add</span> 
                    <span class="text-sm md:textmd">Inserisci Annuncio</span>
                </a>
            </div>
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

    <div class="max-w-7xl mx-auto px-4 md:px-8 pb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                Annunci Recenti
            </h2>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-1 transition">
                Vai agli annunci <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($posts as $post)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="aspect-[4/3] w-full bg-gray-100 relative">
                    @if($post->images->isNotEmpty())
                        <img src="{{ $post->images->first()->image_url }}" 
                             alt="{{ $post->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-gray-400">
                            <span class="material-symbols-outlined text-5xl">image</span>
                            <span class="text-xs mt-2 uppercase">No foto</span>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full shadow-sm">
                        <p class="text-[10px] font-bold text-indigo-600 uppercase">{{ $post->category }}</p>
                    </div>
                </div>

                <div class="p-5 flex-grow flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1 mb-1">{{ $post->title }}</h3>
                    <p class="text-2xl font-black text-blue-600 mb-4">
                        {{ number_format($post->price, 2, ',', '.') }} €
                    </p>
                    <div class="mt-auto">
                        <a href="#" class="block w-full text-center bg-gray-900 hover:bg-blue-600 text-white py-3 rounded-xl text-sm font-bold transition-colors">
                            Visualizza Prodotto
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
                <p class="text-gray-500 text-xl">Nessun annuncio trovato.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
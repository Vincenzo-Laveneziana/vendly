@extends('guest.master-guest')

@section('title', 'Esplora Annunci')

@section('content-guest')
<div class="min-h-screen">
    <div class="relative mb-20">
        
        <div class="relative w-full overflow-hidden shadow-lg h-80 md:h-[450px] flex flex-col items-center justify-center text-center px-6" 
            style="background-image: url('{{ asset('images/imageHome.webp') }}'); background-size: cover; background-position: center;">
            
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">
                    Catalogo <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 md:h-16 inline-block align-middle invert brightness-0">!
                </h1>
                <p class="text-sm md:text-xl text-gray-200 max-w-2xl mx-auto drop-shadow-md">
                    Cerca nuovo e usato vicino a te. Esplora migliaia di annunci in diverse categorie e trova l'affare perfetto!
                </p>
            </div>
        </div>

        <div class="absolute left-1/2 -translate-x-1/2 bottom-0 translate-y-1/2 w-full max-w-4xl px-4 z-20">
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl px-1 py-1 md:py-3 md:px-2 w-full flex items-center gap-2 md:gap-4">
                
                <div class="w-full flex items-center left gap-2 text-gray-500 md:px-4 whitespace-nowrap">
                    <span class="material-symbols-outlined text-black-900 absolute pl-1">search</span>
                    <input type="text" placeholder="Cosa stai cercando?" 
                        class="w-full pl-7 py-3 rounded-xl text-sm md:text-md bg-gray-50 border-none focus:ring-2 focus:ring-blue-500 outline-none text-gray-700">
                </div>

                <div class="md:flex items-center gap-2 text-gray-500 border-l border-gray-200 px-4 whitespace-nowrap">
                    <span class="material-symbols-outlined text-blue-600 text-sm md:text-md">location_on</span>
                    <span class="text-xs md:text-sm font-medium">Italia, San Donaci</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtri -->
    <div class="flex items-center justify-center mb-8 gap-2 px-2">
        <p class="hidden md:flex">Filtri:</p>
        <details class="relative group">
            <summary class="inline-flex items-center justify-center gap-2 px-2 md:px-5 py-2.5 text-xs font-medium text-white transition-colors bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700 list-none [&::-webkit-details-marker]:hidden focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm">
                <p class="hidden md:flex">Scegli Categoria</p>
                <p class="md:hidden">Categoria</p>
                <svg class="w-4 h-4 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            
            <ul class="absolute z-50 w-52 py-2 mt-2 bg-white border border-gray-100 rounded-lg shadow-xl top-full left-0">
                @foreach($categories as $id => $name)
                    @php
                        // Controlla se l'ID corrente è quello selezionato nell'URL
                        $isActive = request()->category == $id;
                    @endphp
                    <li>
                        <a href="{{ route('esplora.categoria', ['category' => $id]) }}" 
                        class="block px-4 py-2 text-sm transition-colors duration-200 
                        {{ $isActive 
                            ? 'bg-blue-100 text-blue-700 font-semibold' 
                            : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                            {{ $name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </details>

        <details class="relative group">
            <summary class="inline-flex items-center justify-center gap-2 px-2 md:px-5 py-2.5 text-xs font-medium text-white transition-colors bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700 list-none [&::-webkit-details-marker]:hidden focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm">
                <p class="hidden md:flex">Ordina per prezzo</p>
                <p class="md:hidden">Prezzo</p>
                <svg class="w-4 h-4 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            
            <ul class="absolute z-50 w-52 py-2 mt-2 bg-white border border-gray-100 rounded-lg shadow-xl top-full left-0">
                <!-- Cresc -->
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" 
                    class="block px-4 py-2 text-sm transition-colors duration-200 
                    {{ request('sort') == 'price_asc' 
                        ? 'bg-blue-100 text-blue-700 font-semibold' 
                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        Prezzo: dal più basso
                    </a>
                </li>

                <li>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" 
                    class="block px-4 py-2 text-sm transition-colors duration-200 
                    {{ request('sort') == 'price_desc' 
                        ? 'bg-blue-100 text-blue-700 font-semibold' 
                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        Prezzo: dal più alto
                    </a>
                </li>
            </ul>
        </details>

        <a href="{{ route('esplora') }}" class="inline-flex items-center justify-center md:gap-2 md:px-5 md:py-2.5 text-sm font-xs font-medium text-grey-900 transition-color cursor-pointer hover:bg-gray-200 rounded-lg">
            <span class="material-symbols-outlined text-red-800">delete</span>
            Rimuovi Filtri
        </a>
    </div>

    <!-- Prodotti -->

    <div>
        <div class="max-w-[1400px] mx-auto px-4 md:px-10 mb-12">
    
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
                
                @forelse($posts as $post)
                <div class="group bg-white rounded-md border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full overflow-hidden">
                    
                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-50">
                        @if($post->images->isNotEmpty())
                            <img src="{{ $post->images->first()->image_url }}" 
                                alt="{{ $post->title }}" 
                                class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                                <span class="material-symbols-outlined text-4xl">image</span>
                            </div>
                        @endif
                        
                        <div class="absolute top-1 left-1">
                            <span class="bg-white/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-blue-600 uppercase">
                                {{ $post->category_name }}
                            </span>
                        </div>
                    </div>

                    <div class="p-3 flex flex-col flex-grow">
                        
                        <h3 class="text-[15px] md:text-lg font-semibold text-gray-900 line-clamp-1 mb-2 first-letter:uppercase">
                            {{ $post->title }}
                        </h3>
                        
                        <p class="text-[13px] md:text-sm text-gray-500 line-clamp-2 leading-relaxed flex-grow first-letter:uppercase">
                            {{ $post->description }}
                        </p>
                        
                        <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Prezzo</span>
                                <span class="text-xl font-bold text-gray-900">
                                    {{ number_format($post->price, 2, ',', '.') }}€
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <a href="#" title="Aggiungi al carrello" class="flex items-center justify-center bg-gray-900 hover:bg-blue-600 text-white w-8 h-9 rounded-md transition-colors shadow-sm">
                                    <span class="material-symbols-outlined text-base">shopping_cart</span>
                                </a>
                                <a href="#" class="hidden md:flex bg-blue-600 hover:bg-blue-700 text-white h-full px-4 py-2 rounded-md text-sm font-semibold transition-all shadow-md shadow-blue-100">
                                    Dettagli
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-[2rem]">
                    <p class="text-gray-500">Nessun annuncio trovato.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
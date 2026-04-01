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
                
                <form action="{{ route('ricerca') }}" id="searchForm" class="w-full flex items-center gap-2 md:gap-4">
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

                </form>                
            </div>
        </div>

    </div>

   <!-- Filtri -->
    <div class="flex flex-col items-center gap-3 mb-8 px-4">
        <div class="flex items-center gap-2 flex-wrap justify-center">

            {{-- Categoria --}}
            <details class="relative group">
                <summary class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-xl cursor-pointer list-none [&::-webkit-details-marker]:hidden focus:outline-none transition-all
                    {{ request('category') 
                        ? 'bg-blue-600 text-white shadow-md shadow-blue-200' 
                        : 'bg-white text-gray-700 border border-gray-200 hover:border-blue-400 hover:text-blue-600' }}">
                    <span class="material-symbols-outlined text-base">category</span>
                    <span class="hidden md:inline">{{ request('category') ? ($categories[request('category')] ?? 'Categoria') : 'Categoria' }}</span>
                    <span class="md:hidden">Cat.</span>
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <ul class="absolute z-50 w-52 py-2 mt-2 bg-white border border-gray-100 rounded-xl shadow-xl top-full left-0">
                    @foreach($categories as $id => $name)
                        <li>
                            <a href="{{ route('categoria', ['category' => $id, 'sort' => request('sort')]) }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-colors
                            {{ request('category') == $id 
                                ? 'bg-blue-50 text-blue-700 font-semibold' 
                                : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                                @if(request('category') == $id)
                                    <span class="material-symbols-outlined text-sm text-blue-600">check</span>
                                @else
                                    <span class="w-4"></span>
                                @endif
                                {{ $name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </details>

            {{-- Prezzo --}}
            <details class="relative group">
                <summary class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-xl cursor-pointer list-none [&::-webkit-details-marker]:hidden focus:outline-none transition-all
                    {{ request('sort') 
                        ? 'bg-blue-600 text-white shadow-md shadow-blue-200' 
                        : 'bg-white text-gray-700 border border-gray-200 hover:border-blue-400 hover:text-blue-600' }}">
                    <span class="material-symbols-outlined text-base">euro</span>
                    <span class="hidden md:inline">
                        {{ request('sort') === 'price_asc' ? 'Prezzo ↑' : (request('sort') === 'price_desc' ? 'Prezzo ↓' : 'Prezzo') }}
                    </span>
                    <span class="md:hidden">€</span>
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <ul class="absolute z-50 w-52 py-2 mt-2 bg-white border border-gray-100 rounded-xl shadow-xl top-full left-0">
                    <li>
                        <a href="{{ route('categoria', ['category' => request('category'), 'sort' => 'price_asc']) }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm transition-colors
                        {{ request('sort') === 'price_asc' 
                            ? 'bg-blue-50 text-blue-700 font-semibold' 
                            : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            @if(request('sort') === 'price_asc') <span class="material-symbols-outlined text-sm text-blue-600">check</span> @else <span class="w-4"></span> @endif
                            Dal più basso
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categoria', ['category' => request('category'), 'sort' => 'price_desc']) }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm transition-colors
                        {{ request('sort') === 'price_desc' 
                            ? 'bg-blue-50 text-blue-700 font-semibold' 
                            : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            @if(request('sort') === 'price_desc') <span class="material-symbols-outlined text-sm text-blue-600">check</span> @else <span class="w-4"></span> @endif
                            Dal più alto
                        </a>
                    </li>
                </ul>
            </details>

            <!-- rimuovi i filtri -->
            <a href="{{ route('esplora') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-100 rounded-xl hover:bg-red-100 transition-colors">
                <span class="material-symbols-outlined text-base">close</span>
                Rimuovi filtri
            </a>
        </div>

        {{-- Recap filtri attivi --}}
        @if(request('category') || request('sort'))
            <div class="flex items-center gap-2 flex-wrap justify-center">
                <span class="text-xs text-gray-400 font-medium">Filtri attivi:</span>

                @if(request('category') && isset($categories[request('category')]))
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-100">
                        <span class="material-symbols-outlined text-xs">category</span>
                        {{ $categories[request('category')] }}
                        <a href="{{ route('categoria', ['sort' => request('sort')]) }}" class="ml-0.5 hover:text-blue-900">✕</a>
                    </span>
                @endif

                @if(request('sort'))
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-100">
                        <span class="material-symbols-outlined text-xs">euro</span>
                        {{ request('sort') === 'price_asc' ? 'Prezzo crescente' : 'Prezzo decrescente' }}
                        <a href="{{ route('categoria', ['category' => request('category')]) }}" class="ml-0.5 hover:text-blue-900">✕</a>
                    </span>
                @endif
            </div>
        @endif
    </div>
    <div>
        <div class="w-full px-4 md:px-10 mb-12">
    
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-2 md:gap-6">
                
                @forelse($products as $product)
                    @include('guest.partials.cardProdotto', ['product' => $product])
                @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-[2rem]">
                    <p class="text-gray-500">Nessun annuncio trovato.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    
    // Funzione di filtraggio
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.product-card');
        let found = false;

        cards.forEach(card => {
            // Leggiamo il titolo dal data-attribute
            const title = card.getAttribute('data-name') || "";
            
            if (title.includes(query)) {
                card.style.display = 'flex'; // Usiamo flex perché la card è flex-row
                found = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Gestione messaggio "Nessun risultato"
        const noResults = document.getElementById('noResults');
        if (noResults) {
            noResults.style.display = found ? 'none' : 'block';
        }
    });
});
</script>
@endsection
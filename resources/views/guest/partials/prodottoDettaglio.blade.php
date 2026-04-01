<div class="mx-3 md:mx-auto max-w-7xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col lg:flex-row">

        {{-- IMMAGINE PRINCIPALE --}}
        <div class="lg:w-1/2 relative w-full overflow-hidden bg-gray-100" style="aspect-ratio: 4/3">
            @if($product->images->isNotEmpty())
                <img id="main-image"
                     src="{{ Storage::url($product->images->first()->path) }}"
                     alt="{{ $product->title }}"
                     class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <span class="material-symbols-outlined text-4xl">image</span>
                </div>
            @endif

            <div class="absolute top-2.5 left-2.5">
                <span class="bg-white/90 backdrop-blur px-2.5 py-1 rounded-full text-xs font-bold text-blue-600 uppercase shadow-sm">
                    {{ $product->category_name ?? 'Annuncio' }}
                </span>
            </div>
        </div>

        {{-- MINIATURE --}}
        @if($product->images->count() > 1)
            <div class="grid grid-cols-4 gap-1 p-1 bg-gray-50 lg:hidden">
                @foreach($product->images as $image)
                    <button onclick="document.getElementById('main-image').src='{{ Storage::url($image->path) }}'"
                            class="aspect-square w-full overflow-hidden rounded-md border-2 border-transparent hover:border-blue-500 focus:border-blue-500 transition-all">
                        <img src="{{ Storage::url($image->path) }}"
                             alt="{{ $product->title }}"
                             class="w-full h-full object-cover">
                    </button>
                @endforeach
            </div>
        @endif

        {{-- CONTENUTO --}}
        <div class="lg:w-1/2 flex flex-col px-4 py-3 md:p-8 lg:p-14 gap-2 md:gap-4">

            {{-- Titolo + Descrizione --}}
            <div>
                <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight first-letter:uppercase">
                    {{ $product->title }}
                </h1>
                <p class="text-gray-500 text-xs md:text-base leading-snug mt-1 line-clamp-2 md:line-clamp-none first-letter:uppercase">
                    {{ $product->description }}
                </p>
            </div>

            {{-- Prezzo --}}
            <div>
                <span class="text-xs text-gray-400 uppercase font-bold tracking-wider block">Prezzo richiesto</span>
                <span class="text-2xl md:text-4xl font-black text-blue-600">
                    {{ number_format($product->price, 2, ',', '.') }}€
                </span>
            </div>

            {{-- Venditore + Città --}}
            <div class="border-t border-gray-100 pt-2 md:pt-4 grid grid-cols-2 gap-3">
                <div>
                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">person</span> Venditore
                    </span>
                    <p class="text-sm md:text-lg font-semibold text-gray-900 mt-0.5">
                        {{ $user->name }} {{ $user->surname }}
                    </p>
                </div>
                <div>
                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">location_on</span> Città
                    </span>
                    <p class="text-sm md:text-lg font-semibold text-gray-900 mt-0.5">
                        {{ $user->address['city'] ?? 'Non specificata' }}
                    </p>
                </div>
            </div>

            {{-- CTA --}}
            <div class="mt-auto pt-1">
                <a href="mailto:{{ $product->email }}"
                   class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 md:py-4 px-6 rounded-xl transition-all text-sm md:text-base">
                    Contatta il venditore
                </a>
            </div>

        </div>
    </div>
</div>
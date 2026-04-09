<div data-name="{{ strtolower($product->title) }}" data-category="{{ $product->category ?? '' }}"
    data-price="{{ $product->price }}" data-location="{{ strtolower($product->location ?? '') }}"
    class="product-card group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-row h-[160px] md:h-[200px] lg:h-[220px] overflow-hidden relative"
    style="font-family: 'Satoshi', sans-serif;">

    <a href="{{ route('prodotto', ['id' => $product->id]) }}" class="absolute inset-0 z-10 md:hidden"
        aria-label="Vedi dettagli"></a>

    <div class="relative w-[40%] md:w-[35%] h-full overflow-hidden bg-gray-50 flex-shrink-0">
        @if($product->images && $product->images->isNotEmpty())
            <img src="{{ Storage::url($product->images->first()->path) }}" alt="{{ $product->title }}"
                class="w-full h-full object-cover">
        @else
            <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                <span class="material-symbols-outlined text-4xl">image</span>
            </div>
        @endif
    </div>

    <div class="p-4 md:p-5 flex flex-col flex-grow min-w-0 bg-white relative">

        <div class="flex items-center justify-between mb-2 md:mb-3">
            <span
                class="inline-flex items-center px-2 md:px-3 py-0.5 md:py-1 rounded-full text-[8px] md:text-[9px] font-black bg-white text-gray-800 uppercase tracking-widest border-2 border-[#08B2B4]">
                {{ $product->category_name ?? 'CATEGORIA' }}
            </span>
            <button
                class="relative z-20 text-[#08B2B4] hover:scale-110 transition-transform hidden md:block focus:outline-none">
                <span class="material-symbols-outlined text-lg md:text-xl">favorite_border</span>
            </button>
        </div>

        <h3
            class="text-sm md:text-xl font-black text-gray-900 leading-tight group-hover:text-[#08B2B4] transition-colors first-letter:uppercase">
            <a href="{{ route('prodotto', ['id' => $product->id]) }}" class="line-clamp-1 relative z-20">
                {{ $product->title }}
            </a>
        </h3>

        <div class="flex flex-col mt-1 mb-2">
            <p class="text-[11px] md:text-[12px] text-gray-400 font-medium truncate">
                {{ $product->location ?? 'Mesagne (BR), 72023' }}
            </p>
            <p class="text-[11px] md:text-[12px] text-gray-400 font-medium truncate mt-0.5">
                {{ $product->user->name ?? 'Franco Rossi' }}
            </p>
        </div>

        <!-- Footer Card -->
        <div class="pt-3 md:pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
            <div class="flex flex-col">
                <span
                    class="text-[8px] md:text-[9px] text-gray-500 uppercase font-black tracking-widest leading-none mb-1">PREZZO</span>
                <span class="text-sm md:text-lg font-black text-gray-900 leading-none">
                    € {{ number_format($product->price, 2, ',', '.') }}
                </span>
            </div>

            <!-- <a href="{{ route('prodotto', ['id' => $product->id]) }}"
                class="bg-[#08B2B4] hover:bg-[#069a9b] text-white px-4 md:px-6 py-1.5 md:py-2 rounded-lg text[11px] md:text-xs font-black transition-all shadow-sm relative z-20 flex items-center hidden sm:flex">
                Dettagli
            </a> -->
        </div>
    </div>
</div>
<div data-name="{{ strtolower($product->title) }}" 
     class="product-card group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-row h-[180px] md:h-[210px] lg:h-[240px] overflow-hidden relative">
    
    <a href="{{ route('prodotto', ['id' => $product->id]) }}" class="absolute inset-0 z-10 md:hidden" aria-label="Vedi dettagli"></a>

    <div class="relative w-1/3 sm:w-2/5 md:w-2/5 lg:w-1/3 h-full overflow-hidden bg-gray-50 flex-shrink-0">
        @if($product->images && $product->images->isNotEmpty())
            <img src="{{ Storage::url($product->images->first()->path) }}" 
                 alt="{{ $product->title }}" 
                 class="w-full h-full object-cover">
        @else
            <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                <span class="material-symbols-outlined text-4xl">image</span>
            </div>
        @endif
    </div>

    <div class="p-4 md:p-5 lg:p-6 flex flex-col flex-grow justify-between min-w-0">
        <div class="flex flex-col gap-1 md:gap-2">
            <div class="flex items-center">
                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] md:text-[10px] font-bold bg-blue-50 text-blue-600 uppercase tracking-wider border border-blue-100">
                    {{ $product->category_name ?? 'Categoria' }}
                </span>
            </div>

            <h3 class="text-sm md:text-lg lg:text-xl font-bold text-gray-900 leading-tight group-hover:text-blue-600 transition-colors first-letter:uppercase">
                <a href="{{ route('prodotto', ['id' => $product->id]) }}" class="line-clamp-1 md:line-clamp-2">
                    {{ $product->title }}
                </a>
            </h3>

            <p class="text-[11px] md:text-sm text-gray-500 line-clamp-2 md:line-clamp-3 leading-relaxed opacity-80">
                {{ $product->description }}
            </p>
        </div>
        
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Prezzo</span>
                <span class="text-md md:text-xl font-black text-gray-900">
                    {{ number_format($product->price, 2, ',', '.') }}€
                </span>
            </div>
            
            <div class="flex items-center gap-2 relative z-20"> 
                <a href="{{ route('prodotto', ['id' => $product->id]) }}" class="hidden sm:flex bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all items-center justify-center">
                    Dettagli
                </a>
            </div>
        </div>
    </div>
</div>
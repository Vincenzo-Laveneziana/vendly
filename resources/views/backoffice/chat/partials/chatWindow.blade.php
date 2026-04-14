<!-- Immagine Prodotto -->
@if($product->images->isNotEmpty())
    <div class="w-14 h-14 md:w-16 md:h-16 flex-shrink-0">
        <img src="{{ Storage::url($product->images->first()->path) }}" alt="{{ $product->title }}"
            class="w-full h-full object-cover rounded-lg border border-gray-200 shadow-sm">
    </div>
@else
    <div
        class="w-14 h-14 md:w-16 md:h-16 bg-gray-200 rounded-lg border border-gray-200 flex items-center justify-center flex-shrink-0">
        <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </div>
@endif

<!-- Titolo e Info -->
<div class="flex-1 min-w-0">
    <h3 class="text-sm md:text-base font-bold text-gray-900 truncate">{{ $product->title }}</h3>
    <p class="text-[10px] md:text-xs text-gray-500 truncate mb-1">{{ __('Utente:') }}
        {{ $product->user->name ?? 'Utente' }}
    </p>

    <a href="{{ route('Frontoffice.product', $product->id) }}"
        class="inline-block text-[10px] md:text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-1 px-3 rounded-full transition whitespace-nowrap">
        {{ __('Vedi annuncio') }}
    </a>
</div>

<!-- PREZZO -->
<div class="text-right flex-shrink-0 pl-2">
    <span
        class="text-[10px] md:text-xs text-gray-400 uppercase font-bold tracking-wider block">{{ __('Prezzo') }}</span>
    <span class="text-xl md:text-2xl font-black text-blue-600">
        {{ number_format($product->price, 2, ',', '.') }}€
    </span>
</div>
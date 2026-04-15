<!-- Immagine Prodotto -->
@if($product->images->isNotEmpty())
    <div class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0">
        <img src="{{ Storage::url($product->images->first()->path) }}" alt="{{ $product->title }}"
            class="w-full h-full object-cover rounded-xl shadow-sm border border-gray-100">
    </div>
@else
    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center flex-shrink-0">
        <span class="material-symbols-outlined text-gray-300">image</span>
    </div>
@endif

<!-- Titolo e Info -->
<div class="flex-1 min-w-0">
    <h3 class="text-sm md:text-base font-bold text-gray-900 truncate tracking-tight">{{ $product->title }}</h3>
    <p class="text-[10px] md:text-sm text-gray-400 font-medium truncate">
        {{ $product->user->name ?? __('message.user_placeholder') }}
    </p>
</div>

<!-- PREZZO E ACTION -->
<div class="flex items-center gap-4 flex-shrink-0 pl-4">
    <span class="text-sm md:text-xl font-bold text-gray-900">
        {{ __('message.money') }} {{ number_format($product->price, 2, ',', '.') }}
    </span>
    
    <a href="{{ route('Frontoffice.product', $product->id) }}"
        class="hidden sm:flex items-center gap-2 text-[10px] md:text-xs border border-gray-200 hover:border-vendly hover:text-vendly text-gray-600 font-bold py-2 px-4 rounded-xl transition-all bg-white shadow-sm ring-offset-1 active:scale-95">
        <span class="material-symbols-outlined text-sm">visibility</span>
        {{ __('message.view') }}
    </a>
</div>
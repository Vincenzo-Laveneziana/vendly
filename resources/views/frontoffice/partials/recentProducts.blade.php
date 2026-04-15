<section class="relative py-12 overflow-hidden">
    <!-- Immagini decorative di sfondo (bolle) -->
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="absolute top-16 -right-32 w-48 md:w-96 pointer-events-none rotate-[15deg] opacity-70">
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="absolute bottom-16 -left-32 w-48 md:w-96 pointer-events-none -rotate-[20deg] opacity-70">

    <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">
        <div class="flex flex-col items-center justify-center mb-12 mt-8">
            <h2 class="text-2xl md:text-4xl text-vendly uppercase">
                {{ __('message.recent_ads') }}
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                @include('frontoffice.partials.cardProdotto', ['product' => $product])
            @empty
                <div
                    class="col-span-full text-center py-20 bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-100">
                    <p class="text-gray-400 font-medium">{{ __('message.no_ads_found') }}</p>
                </div>
            @endforelse
        </div>

        <div class="flex justify-center mt-12">
            <a href="{{ route('Frontoffice.explore') }}"
                class="group flex items-center gap-2 px-8 py-3 bg-gray-50 hover:bg-white border border-gray-400 hover:border-[#08B2B4] text-gray-700 hover:text-[#08B2B4] font-bold rounded-xl transition-all active:scale-95">
                {{ __('message.go_to_ads') }}
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
</section>
<section class="relative py-2 overflow-hidden">
    <!-- Immagini decorative diagioniali agli angoli -->
    <img src="{{ asset('images/AnnunciRecenti.png') }}" alt="" class="absolute -top-20 left-0 h-full w-auto object-cover opacity-40 md:opacity-100 pointer-events-none -rotate-225">
    <img src="{{ asset('images/AnnunciRecenti.png') }}" alt="" class="absolute -bottom-20 right-0 h-full w-auto object-cover opacity-40 md:opacity-100 pointer-events-none -rotate-225">

    <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">
        <div class="flex flex-col items-center justify-center mb-12 mt-8">
            <h2 class="text-2xl md:text-4xl font-black text-[#08B2B4] uppercase" style="font-family: 'Integralcf', sans-serif;">
                ANNUNCI RECENTI
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                @include('guest.partials.cardProdotto', ['product' => $product])
            @empty
            <div class="col-span-full text-center py-20 bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-100">
                <p class="text-gray-400 font-medium">Nessun annuncio trovato al momento.</p>
            </div>
            @endforelse
        </div>

        <div class="flex justify-center mt-12">
            <a href="{{ route('esplora') }}" class="group flex items-center gap-2 px-8 py-3 bg-gray-50 hover:bg-white border border-gray-100 hover:border-[#08B2B4] text-gray-700 hover:text-[#08B2B4] font-bold rounded-xl transition-all active:scale-95 shadow-sm">
                Vai a tutti gli annunci 
                <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
            </a>
        </div>
    </div>
</section>
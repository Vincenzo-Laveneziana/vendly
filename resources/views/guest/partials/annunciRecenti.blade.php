<div class="max-w-7xl mx-auto px-4 md:px-8 pb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                Annunci Recenti
            </h2>
            <a href="{{ route('esplora') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-1 transition">
                Vai agli annunci <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
                
            @forelse($posts as $post)
                @include('guest.partials.cardProdotto', ['post' => $post])
            @empty
            <div class="col-span-full text-center py-20 bg-gray-50 rounded-[2rem]">
                <p class="text-gray-500">Nessun annuncio trovato.</p>
            </div>
            @endforelse
        </div>
    </div>
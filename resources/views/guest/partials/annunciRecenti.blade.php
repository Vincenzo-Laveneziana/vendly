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
            <div class="group bg-white rounded-md border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full overflow-hidden relative">
                
                <a href="{{ route('prodotto', ['id' => $post->id]) }}" class="absolute inset-0 z-10 md:hidden" aria-label="Vedi dettagli"></a>

                <div class="relative aspect-[4/3] overflow-hidden bg-gray-50">
                    @if($post->images->isNotEmpty())
                        <img src="{{ $post->images->first()->image_url }}" 
                            alt="{{ $post->title }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                            <span class="material-symbols-outlined text-4xl">image</span>
                        </div>
                    @endif
                    
                    <div class="absolute top-1 left-1 z-20"> <span class="bg-white/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-blue-600 uppercase">
                            {{ $post->category_name }}
                        </span>
                    </div>
                </div>

                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="text-[15px] md:text-lg font-semibold text-gray-900 line-clamp-1 mb-2 first-letter:uppercase">
                        <a href="{{ route('prodotto', ['id' => $post->id]) }}" class="hover:text-blue-600 transition-colors">
                            {{ $post->title }}
                        </a>
                    </h3>
                    
                    <p class="text-[13px] md:text-sm text-gray-500 line-clamp-2 leading-relaxed flex-grow first-letter:uppercase">
                        {{ $post->description }}
                    </p>
                    
                    <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-[10px] text-gray-400 uppercase font-bold">Prezzo</span>
                            <span class="text-md font-bold text-gray-900">
                                {{ number_format($post->price, 2, ',', '.') }}€
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2 relative z-20"> <a href="#" title="Aggiungi al carrello" class="flex items-center justify-center bg-gray-900 hover:bg-blue-600 text-white w-8 h-9 rounded-md transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-base">shopping_cart</span>
                            </a>
                            
                            <a href="{{ route('prodotto', ['id' => $post->id]) }}" class="hidden md:flex bg-blue-600 hover:bg-blue-700 text-white h-full px-4 py-2 rounded-md text-sm font-semibold transition-all shadow-md shadow-blue-100">
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
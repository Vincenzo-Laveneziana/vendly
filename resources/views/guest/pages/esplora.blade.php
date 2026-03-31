@extends('guest.master-guest')

@section('title', 'Esplora Annunci')

@section('content-guest')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($posts as $post)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="aspect-[4/3] w-full bg-gray-100 relative">
                    @if($post->images->isNotEmpty())
                        <img src="{{ $post->images->first()->image_url }}" 
                             alt="{{ $post->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-gray-400">
                            <span class="material-symbols-outlined text-5xl">image</span>
                            <span class="text-xs mt-2 uppercase">No foto</span>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full shadow-sm">
                        <p class="text-[10px] font-bold text-indigo-600 uppercase">{{ $post->category_name }}</p>
                    </div>
                </div>

                <div class="p-5 flex-grow flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1 mb-1">{{ $post->title }}</h3>
                    <p class="text-2xl font-black text-blue-600 mb-4">
                        {{ number_format($post->price, 2, ',', '.') }} €
                    </p>
                    <div class="mt-auto">
                        <a href="#" class="block w-full text-center bg-gray-900 hover:bg-blue-600 text-white py-3 rounded-xl text-sm font-bold transition-colors">
                            Visualizza Prodotto
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
                <p class="text-gray-500 text-xl">Nessun annuncio trovato.</p>
            </div>
            @endforelse
        </div>
@endsection
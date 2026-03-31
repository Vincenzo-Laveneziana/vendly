@extends('guest.master-guest')

@section('title', 'Dettagli Annuncio')

@section('content-guest')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="mx-4 md:mx-auto max-w-4xl">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            
            <div class="md:w-1/2 lg:w-2/5 relative bg-gray-200 aspect-square md:aspect-auto">
                @if($post->images->isNotEmpty())
                    <img src="{{ $post->images->first()->image_url }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <span class="material-symbols-outlined text-6xl">image</span>
                    </div>
                @endif
                
                <div class="absolute top-4 left-4">
                    <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-blue-600 uppercase shadow-sm">
                        {{ $post->category_name ?? 'Annuncio' }}
                    </span>
                </div>
            </div>

            <div class="md:w-1/2 lg:w-3/5 p-6 md:p-10 flex flex-col">
                
                <div class="mb-auto">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-2 leading-tight first-letter:uppercase">
                        {{ $post->title }}
                    </h1>
                    <p class="text-gray-600 leading-relaxed mb-6 first-letter:uppercase">
                        {{ $post->description }}
                    </p>

                    <div class="inline-block py-2 mb-8">
                        <span class="text-xs text-gray-500 uppercase font-bold block">Prezzo richiesto</span>
                        <span class="text-3xl font-black text-blue-600">
                            {{ number_format($post->price, 2, ',', '.') }}€
                        </span>
                    </div>
                </div>

                <hr class="border-gray-100 mb-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-1 mb-1">
                            <span class="material-symbols-outlined text-sm">person</span> Venditore
                        </span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $user->name }} {{ $user->surname }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-1 mb-1">
                            <span class="material-symbols-outlined text-sm">location_on</span> Città
                        </span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{-- Accesso alla chiave 'city' dell'indirizzo --}}
                            {{ $user->address['city'] ?? 'Non specificata' }}
                        </p>
                    </div>
                </div>

                <div class="mt-10 flex gap-3">
                    <a href="mailto:{{ $post->email }}" class="flex-grow text-center bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-gray-200">
                        Contatta il venditore
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto mt-5 relative w-full max-w-4xl px-4 z-20">
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl px-1 py-1 md:py-3 md:px-2 w-full flex items-center gap-2 md:gap-4">
            
            <div class="w-full flex items-center left gap-2 text-gray-500 md:px-4 whitespace-nowrap">
                <span class="material-symbols-outlined text-black-900 absolute pl-1">search</span>
                <input type="text" placeholder="Cosa stai cercando?" 
                    class="w-full pl-7 py-3 rounded-xl text-sm md:text-md bg-gray-50 border-none focus:ring-2 focus:ring-blue-500 outline-none text-gray-700">
            </div>

            <div class="md:flex items-center gap-2 text-gray-500 border-l border-gray-200 px-4 whitespace-nowrap">
                <span class="material-symbols-outlined text-blue-600 text-sm md:text-md">location_on</span>
                <span class="text-xs md:text-sm font-medium">Italia, San Donaci</span>
            </div>
        </div>
    </div>

    <!-- Prodotti -->
    <div class="my-10">

    @include('guest.partials.annunciRecenti')
    </div>
</div>
@endsection
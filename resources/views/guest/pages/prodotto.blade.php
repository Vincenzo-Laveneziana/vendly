@extends('guest.master-guest')

@section('title', 'Dettagli Annuncio')

@section('content-guest')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="mx-4 md:mx-auto max-w-4xl">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            
            <div class="md:w-1/2 lg:w-2/5 relative bg-gray-200 aspect-square md:aspect-auto" x-data="{ activePhoto: 0 }">
    
                <div class="w-full h-full relative overflow-hidden">
                    @if($post->images->isNotEmpty())
                        @foreach($post->images as $index => $image)
                            <img src="{{ $image->image_url }}" 
                                alt="{{ $post->title }}" 
                                x-show="activePhoto === {{ $index }}"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                class="w-full h-full object-cover absolute inset-0"
                                style="display: none;">
                        @endforeach
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">
                            <span class="material-symbols-outlined text-6xl">image</span>
                        </div>
                    @endif
                </div>

                <div class="absolute top-4 left-4 z-10">
                    <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-blue-600 uppercase shadow-sm">
                        {{ $post->category_name ?? 'Annuncio' }}
                    </span>
                </div>

                @if($post->images->count() > 1)
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10 bg-black/20 backdrop-blur-sm p-2 rounded-full">
                        @foreach($post->images as $index => $image)
                            <button @click="activePhoto = {{ $index }}" 
                                    :class="activePhoto === {{ $index }} ? 'bg-white w-6' : 'bg-white/50 hover:bg-white/80 w-2'"
                                    class="h-2 rounded-full transition-all duration-300 shadow-sm"
                                    aria-label="Vai alla foto {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <button @click="activePhoto = (activePhoto === 0) ? {{ $post->images->count() - 1 }} : activePhoto - 1" 
                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 transition-colors">
                        <span class="material-symbols-outlined text-gray-800">chevron_left</span>
                    </button>
                    <button @click="activePhoto = (activePhoto === {{ $post->images->count() - 1 }}) ? 0 : activePhoto + 1" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 transition-colors">
                        <span class="material-symbols-outlined text-gray-800">chevron_right</span>
                    </button>
                @endif
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
<div class="mx-4 md:mx-auto max-w-7xl"> <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col lg:flex-row">
        
        <div class="lg:w-1/2 relative bg-gray-200 aspect-square md:aspect-video lg:aspect-auto">
           @if($product->images->isNotEmpty())
                <img src="{{ Storage::url($product->images->first()->path) }}" 
                     alt="{{ $product->title }}" 
                     class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                    <span class="material-symbols-outlined text-4xl">image</span>
                </div>
            @endif
            
            <div class="absolute top-4 left-4">
                <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-blue-600 uppercase shadow-sm">
                    {{ $product->category_name ?? 'Annuncio' }}
                </span>
            </div>
        </div>

        <div class="lg:w-1/2 p-6 md:p-10 lg:p-16 flex flex-col">
            
            <div class="mb-auto">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2 leading-tight first-letter:uppercase">
                    {{ $product->title }}
                </h1>
                
                <p class="text-gray-600 leading-relaxed mb-8 first-letter:uppercase">
                    {{ $product->description }}
                </p>

                <div class="inline-block py-2 mb-8">
                    <span class="text-xs text-gray-500 uppercase font-bold block mb-1">Prezzo richiesto</span>
                    <span class="text-4xl font-black text-blue-600">
                        {{ number_format($product->price, 2, ',', '.') }}€
                    </span>
                </div>
            </div>

            <hr class="border-gray-100 mb-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
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
                        {{ $user->address['city'] ?? 'Non specificata' }}
                    </p>
                </div>
            </div>

            <div class="mt-12">
                <a href="mailto:{{ $product->email }}" 
                   class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg shadow-gray-200">
                    Contatta il venditore
                </a>
            </div>
        </div>
        
    </div>
</div>
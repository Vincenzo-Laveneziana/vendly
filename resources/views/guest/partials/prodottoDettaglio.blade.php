<div class="mx-3 md:mx-auto max-w-7xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">

        {{-- SLIDER IMMAGINI --}}
        <div class="md:w-1/2 relative w-full overflow-hidden bg-gray-100" style="aspect-ratio: 4/3">
            @if($product->images->isNotEmpty())
                <div id="slider-track" class="flex h-full transition-transform duration-300 ease-in-out"
                     style="width: {{ $product->images->count() * 100 }}%">
                    @foreach($product->images as $image)
                        <div class="h-full flex-shrink-0" style="width: {{ 100 / $product->images->count() }}%">
                            <img src="{{ Storage::url($image->path) }}"
                                 alt="{{ $product->title }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>

                @if($product->images->count() > 1)
                    <button id="prev-btn" onclick="changeSlide(-1)"
                            class="hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white backdrop-blur shadow-md rounded-full w-9 h-9 items-center justify-center transition-all z-10">
                        <span class="material-symbols-outlined text-gray-800 text-xl">chevron_left</span>
                    </button>
                    <button id="next-btn" onclick="changeSlide(1)"
                            class="hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white backdrop-blur shadow-md rounded-full w-9 h-9 items-center justify-center transition-all z-10">
                        <span class="material-symbols-outlined text-gray-800 text-xl">chevron_right</span>
                    </button>

                    <div id="dots-container" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                        @foreach($product->images as $i => $image)
                            <button onclick="goToSlide({{ $i }})"
                                    class="dot w-2 h-2 rounded-full transition-all {{ $i === 0 ? 'bg-white scale-110' : 'bg-white/50' }}">
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <span class="material-symbols-outlined text-4xl">image</span>
                </div>
            @endif

            <div class="absolute top-2.5 left-2.5 z-10">
                <span class="bg-white/90 backdrop-blur px-2.5 py-1 rounded-full text-xs font-bold text-blue-600 uppercase shadow-sm">
                    {{ $product->category_name ?? 'Annuncio' }}
                </span>
            </div>
        </div>

        {{-- CONTENUTO --}}
        <div class="md:w-1/2 flex flex-col justify-between px-4 py-4 md:p-8 lg:p-14 gap-3 md:gap-4">

            {{-- Titolo + Descrizione --}}
            <div class="flex flex-col justify-between h-full">

                <div class="md:border-b border-gray-200 pb-4">
                    <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight first-letter:uppercase">
                        {{ $product->title }}
                    </h1>
                    <p class="text-gray-500 text-xs md:text-base leading-snug mt-2 line-clamp-2 md:line-clamp-none first-letter:uppercase">
                        {{ $product->description }}
                    </p>
                </div>
    
                {{-- Prezzo --}}
                <div>
                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider block">Prezzo richiesto</span>
                    <span class="text-2xl md:text-4xl font-black text-blue-600">
                        {{ number_format($product->price, 2, ',', '.') }}€
                    </span>
                </div>
            </div>

            {{-- Venditore + Città --}}
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">person</span> Venditore
                    </span>
                    <p class="text-sm md:text-lg font-semibold text-gray-900 mt-1">
                        {{ $user->name }} {{ $user->surname }}
                    </p>
                </div>
                <div>
                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">location_on</span> Città
                    </span>
                    <p class="text-sm md:text-lg font-semibold text-gray-900 mt-1">
                        {{ $user->address['city'] ?? 'Non specificata' }}
                    </p>
                </div>
            </div>

            {{-- CTA --}}
            @if($product->user_id !== auth()->id())
            <div class="mt-auto pt-1 pb-1">
                <a href="{{ route('chat', ['idProdotto' => $product->id]) }}"
                   class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 md:py-4 px-6 rounded-xl transition-all text-sm md:text-base">
                    Contatta il venditore
                </a>
            </div>
            @endif

        </div>
    </div>
</div>

<script>
    let currentSlide = 0;
    const total = {{ $product->images->count() }};
    const track = document.getElementById('slider-track');
    const dots = document.querySelectorAll('.dot');

    function goToSlide(index) {
        currentSlide = (index + total) % total;
        track.style.transform = `translateX(-${currentSlide * (100 / total)}%)`;
        dots.forEach((d, i) => {
            d.classList.toggle('bg-white', i === currentSlide);
            d.classList.toggle('scale-110', i === currentSlide);
            d.classList.toggle('bg-white/50', i !== currentSlide);
        });
    }

    function changeSlide(dir) {
        goToSlide(currentSlide + dir);
    }

    let touchStartX = 0;
    track.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX);
    track.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) changeSlide(diff > 0 ? 1 : -1);
    });
</script>
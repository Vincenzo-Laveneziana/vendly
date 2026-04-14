<div class="relative overflow-hidden z-0 w-full h-full flex justify-center items-center py-6 md:py-10 bg-transparent"
    style="font-family: 'Satoshi-Regular', sans-serif;">
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="absolute -z-10 bottom-10 -left-48 w-48 md:w-96 pointer-events-none rotate-[15deg] opacity-70">
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="absolute -z-10 top-10 -right-48 w-48 md:w-96 pointer-events-none -rotate-[20deg] opacity-70">
    <div
        class="bg-white rounded-3xl shadow-md duration-300 border border-gray-100 p-5 md:p-8 flex flex-col w-full max-w-3xl mx-4">

        <!-- Immagine -->
        <div
            class="relative w-full aspect-video bg-gray-50 rounded-lg overflow-hidden flex justify-center items-center">
            @if($product->images && $product->images->isNotEmpty())
                <div id="slider-track" class="flex h-full w-full transition-transform duration-300 ease-in-out">
                    @foreach($product->images as $image)
                        <div class="h-full min-w-full flex-shrink-0 flex justify-center items-center bg-transparent">
                            <img src="{{ Storage::url($image->path) }}" alt="{{ $product->title }}"
                                class="w-full h-full object-contain p-2">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <span class="material-symbols-outlined text-5xl">image</span>
                </div>
            @endif
        </div>

        <!-- Pagination-->
        @if($product->images && $product->images->count() > 1)
            <div class="flex mt-3 w-full justify-center gap-2 overflow-x-auto px-1">
                @foreach($product->images as $i => $image)
                    <button onclick="goToSlide({{ $i }})"
                        class="thumbnail-btn w-12 h-12 md:w-16 md:h-16 flex-shrink-0 bg-gray-50 rounded-md border-2 transition-all overflow-hidden focus:outline-none hover:border-[#08B2B4] hover:opacity-100 {{ $i === 0 ? 'border-[#08B2B4] opacity-100' : 'border-transparent opacity-60' }}">
                        <img src="{{ Storage::url($image->path) }}" class="w-full h-full object-contain p-1">
                    </button>
                @endforeach
            </div>

            <div class="flex justify-center items-center gap-2 mt-3 text-[#08B2B4] font-bold">
                <button onclick="changeSlide(-1)"
                    class="hover:scale-110 transition-transform flex items-center justify-center text-sm">
                    <span class="material-symbols-outlined text-sm font-bold">arrow_back</span>
                </button>
                <span id="slide-indicator" class="text-[13px]">1</span>
                <button onclick="changeSlide(1)"
                    class="hover:scale-110 transition-transform flex items-center justify-center text-sm">
                    <span class="material-symbols-outlined text-sm font-bold">arrow_forward</span>
                </button>
            </div>
        @endif

        <!-- Contenuto -->
        <div class="w-full flex flex-col mt-2">

            <!-- Categoria -->
            <div class="mb-3">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-[9px] md:text-[10px] font-black bg-white text-gray-800 border-2 border-[#08B2B4] uppercase tracking-widest leading-none">
                    {{ $product->category_name }}
                </span>
            </div>

            <!-- Titolo -->
            <h1 class="text-xl md:text-2xl font-black text-gray-900 leading-tight">
                {{ $product->title }}
            </h1>

            <!-- Posizione -->
            <div class="flex flex-col mt-1 mb-4 gap-1">
                <p class="text-[12px] md:text-[13px] text-gray-400 font-medium">
                    {{ $product->location ?? 'Mesagne (BR), 72023' }}
                </p>
                <p class="text-[12px] md:text-[13px] text-gray-400 font-medium">
                    {{ $user->name ?? 'Franco Rossi' }} {{ $user->surname ?? '' }}
                </p>
            </div>

            <!-- Descrizione -->
            <p class="text-gray-400 text-[12px] md:text-[13px] leading-relaxed mb-6 pt-1 transition-all">
                {{ $product->description }}
            </p>

            <!-- Prezzo e Bottone Contatta Venditore -->
            <div class="w-full flex flex-row items-center justify-between border-t border-gray-200 pt-5 mt-auto">
                <div class="flex flex-col">
                    <span
                        class="text-[9px] text-gray-500 uppercase font-black tracking-widest leading-none mb-1">{{ __('message.price') }}</span>
                    <span class="text-lg md:text-xl font-black text-gray-900 leading-none">
                        {{ __('message.money') }} {{ number_format($product->price, 2, ',', '.') }}
                    </span>
                </div>

                @if($product->user_id !== auth()->id())
                    <div>
                        <a href="{{ route('Backoffice.createChat', ['idProdotto' => $product->id]) }}"
                            class="bg-[#08B2B4] hover:bg-[#069a9b] text-white px-5 md:px-6 py-2 md:py-2.5 rounded-lg text-[13px] md:text-sm font-black transition-all flex items-center justify-center">
                            {{ __('message.contact_seller') }}
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<script>
    let currentSlide = 0;
    const total = {{ $product->images ? $product->images->count() : 0 }};
    const track = document.getElementById('slider-track');
    const indicator = document.getElementById('slide-indicator');
    const thumbs = document.querySelectorAll('.thumbnail-btn');

    function goToSlide(index) {
        if (total === 0) return;
        currentSlide = (index + total) % total;

        if (track) {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
        if (indicator) {
            indicator.textContent = currentSlide + 1;
        }

        thumbs.forEach((d, i) => {
            d.classList.toggle('border-[#08B2B4]', i === currentSlide);
            d.classList.toggle('border-transparent', i !== currentSlide);
            d.classList.toggle('opacity-100', i === currentSlide);
            d.classList.toggle('opacity-60', i !== currentSlide);
        });
    }

    function changeSlide(dir) {
        if (total <= 1) return;
        goToSlide(currentSlide + dir);
    }

    if (track && total > 1) {
        let touchStartX = 0;
        track.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX);
        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                changeSlide(diff > 0 ? 1 : -1);
            }
        });
    }
</script>
<div class="relative overflow-hidden z-0 w-full h-full flex justify-center items-center py-6 md:py-10 bg-transparent">
    <!-- Blob decorativi originali configurazione -->
    <img src="{{ asset('images/blob_02.webp') }}" alt=""
        class="absolute -z-10 bottom-10 -left-48 w-48 md:w-96 pointer-events-none rotate-[15deg] opacity-70">
    <img src="{{ asset('images/blob_02.webp') }}" alt=""
        class="absolute -z-10 top-10 -right-48 w-48 md:w-96 pointer-events-none -rotate-[20deg] opacity-70">

    <div class="max-w-6xl mx-auto px-4 md:px-6">
        <!-- Back Button - Adjusted Spacing -->
        <a href="{{ route('Frontoffice.explore') }}"
            class="inline-flex items-center gap-2 px-6 py-3 bg-[#08B2B4] text-white rounded-xl font-black text-[12px] uppercase tracking-wider mb-6 hover:bg-[#079fa1] transition-all shadow-sm">
            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
            {{ __('message.back') }}
        </a>

        <!-- Main Card - Optimized for Responsive -->
        <div
            class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden flex flex-col {{ ($product->images && $product->images->isNotEmpty()) ? 'md:flex-row min-h-[500px] md:min-h-[600px]' : 'max-w-3xl mx-auto' }}">

            @if($product->images && $product->images->isNotEmpty())
                <!-- Side Left: Media Section -->
                <div class="w-full md:w-1/2 lg:w-[55%] p-4 md:p-8 flex flex-col bg-white">
                    <div
                        class="relative w-full aspect-[4/3] bg-gray-50 rounded-[32px] overflow-hidden flex items-center justify-center">
                        <div id="slider-track" class="flex h-full w-full transition-transform duration-500 ease-out">
                            @foreach($product->images as $image)
                                <div class="h-full min-w-full flex-shrink-0 flex justify-center items-center">
                                    <img src="{{ Storage::url($image->path) }}" alt="{{ $product->title }}"
                                        class="w-full h-full object-contain p-4 md:p-6">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Thumbnails & Navigation -->
                    @if($product->images->count() > 0)
                        <div class="mt-6 md:mt-8">
                            <div class="flex flex-wrap md:grid md:grid-cols-5 gap-3 md:gap-4 justify-center">
                                @foreach($product->images as $i => $image)
                                    <button onclick="goToSlide({{ $i }})"
                                        class="thumbnail-btn w-12 h-12 md:w-auto md:aspect-square rounded-2xl overflow-hidden border-2 transition-all duration-300 {{ $i === 0 ? 'border-[#08B2B4]' : 'border-transparent opacity-60 hover:opacity-100' }}">
                                        <img src="{{ Storage::url($image->path) }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>

                            <!-- Manual Arrows -->
                            <div class="flex justify-center items-center gap-4 mt-6">
                                <button onclick="changeSlide(-1)"
                                    class="w-10 h-10 flex items-center justify-center rounded-full text-[#08B2B4] hover:bg-gray-50">
                                    <span class="material-symbols-outlined font-black">chevron_left</span>
                                </button>
                                <span class="text-[13px] font-black text-gray-900 min-w-[50px] text-center">
                                    <span id="slide-indicator">1</span> / {{ $product->images->count() }}
                                </span>
                                <button onclick="changeSlide(1)"
                                    class="w-10 h-10 flex items-center justify-center rounded-full text-[#08B2B4] hover:bg-gray-50">
                                    <span class="material-symbols-outlined font-black">chevron_right</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Side Right: Info Section -->
            <div
                class="w-full {{ ($product->images && $product->images->isNotEmpty()) ? 'md:w-1/2 lg:w-[45%] md:border-l' : '' }} p-6 md:p-10 flex flex-col border-t md:border-t-0 border-gray-50">
                <!-- Top Row -->
                <div class="flex items-center justify-between mb-6">
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($product->created_at)->translatedFormat('d F Y, H:i') }}
                    </span>
                    <div class="flex items-center gap-3">
                        <button
                            class="w-9 h-9 flex items-center justify-center rounded-full text-[#08B2B4] hover:scale-110 transition-transform shadow-sm bg-white border border-gray-50"
                            title="Condividi">
                            <span class="material-symbols-outlined text-[18px]">share</span>
                        </button>
                        <button
                            class="w-9 h-9 flex items-center justify-center rounded-full text-[#08B2B4] hover:scale-110 transition-transform shadow-sm bg-white border border-gray-50"
                            title="Preferiti">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                    </div>
                </div>

                <!-- Category Badge -->
                <div class="mb-4">
                    <span
                        class="px-4 py-1.5 bg-white border-2 border-[#08B2B4]/20 text-[#08B2B4] text-[10px] font-black uppercase tracking-widest rounded-xl">
                        {{ $product->category_name }}
                    </span>
                </div>

                <!-- Title & Location -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-gray-900 leading-tight mb-2">
                    {{ $product->title }}
                </h1>
                <p class="text-[13px] text-gray-400 font-medium mb-8 flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">location_on</span>
                    {{ $product->user->address['city'] ?? __('message.location_label') }}
                </p>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] mb-3">
                        {{ __('message.description') }}
                    </h3>
                    <div
                        class="text-[14px] text-gray-500 leading-relaxed font-regular max-h-[180px] overflow-y-auto pr-2 custom-scrollbar">
                        {{ $product->description }}
                    </div>
                </div>

                <!-- Vendor Profile -->
                <div class="mb-8 pb-8 border-b border-gray-100 flex items-center justify-between mt-auto">
                    <div class="flex flex-col">
                        <p class="text-[12px] text-gray-900 font-black flex items-center gap-2">
                            {{ __('message.sold_by') }}
                            <a href="#"
                                class="text-gray-400 font-medium underline underline-offset-4 decoration-gray-200 hover:text-[#08B2B4] transition-colors">
                                {{ $product->user->name ?? 'User' }}
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Pricing & Actions -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div class="flex flex-col">
                        <span
                            class="text-[9px] text-gray-400 uppercase font-black tracking-widest mb-1">{{ __('message.price') }}</span>
                        <span class="text-2xl lg:text-3xl font-black text-gray-900">
                            {{ __('message.money') }} {{ number_format($product->price, 2, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        @if($product->user_id !== auth()->id())
                            <a href="{{ route('Backoffice.createChat', ['idProdotto' => $product->id]) }}"
                                class="w-12 h-12 flex-shrink-0 flex items-center justify-center border-2 border-[#08B2B4] rounded-full text-[#08B2B4] hover:bg-[#08B2B4] hover:text-white transition-all shadow-sm"
                                title="Contatta il venditore">
                                <span class="material-symbols-outlined text-[20px]">chat_bubble</span>
                            </a>
                            <a href="{{ route('Backoffice.buy', $product->id) }}"
                                class="flex-grow sm:flex-grow-0 px-8 py-3.5 bg-[#08B2B4] text-white rounded-2xl text-[13px] font-black uppercase tracking-wider flex items-center justify-center gap-2 hover:bg-[#079fa1] transition-all shadow-md shadow-[#08B2B4]/20">
                                <span class="material-symbols-outlined text-base">shopping_cart</span>
                                {{ __('message.buy') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #E5E7EB;
        border-radius: 10px;
    }
</style>

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
            if (i === currentSlide) {
                d.classList.add('border-[#08B2B4]', 'opacity-100');
                d.classList.remove('border-transparent', 'opacity-60');
            } else {
                d.classList.remove('border-[#08B2B4]', 'opacity-100');
                d.classList.add('border-transparent', 'opacity-60');
            }
        });
    }

    function changeSlide(dir) {
        if (total <= 1) return;
        goToSlide(currentSlide + dir);
    }
</script>
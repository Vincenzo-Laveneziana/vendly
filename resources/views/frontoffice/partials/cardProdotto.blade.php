<div data-name="{{ strtolower($product->title) }}" data-category="{{ $product->category ?? '' }}"
    data-price="{{ $product->price }}" data-location="{{ strtolower($product->user->address['city'] ?? '') }}"
    class="product-card group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col h-full overflow-hidden relative"
    style="font-family: 'Satoshi-Regular', sans-serif;">

    <!-- Link intera card per accessibilità -->
    <a href="{{ route('Frontoffice.product', ['product' => $product->id]) }}" class="absolute inset-0 z-10"
        aria-label="Vedi dettagli"></a>

    <!-- Top: Image Section -->
    <div class="relative w-full aspect-[4/3] overflow-hidden bg-gray-50 flex-shrink-0 rounded-t-2xl">
        @if($product->images && $product->images->isNotEmpty())
            <img src="{{ Storage::url($product->images->first()->path) }}" alt="{{ $product->title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                <span class="material-symbols-outlined text-4xl sm:text-5xl">image</span>
            </div>
        @endif

        <!-- Overlay Badge: Category -->
        <div class="absolute bottom-2 left-2 sm:bottom-3 sm:left-3 z-20">
            <span
                class="inline-flex items-center px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg sm:rounded-xl text-[9px] sm:text-[10px] font-black bg-[#08B2B4] text-white uppercase tracking-wider shadow-sm">
                {{ $product->category_name ?? __('message.category_label') }}
            </span>
        </div>

        <!-- Overlay Badge: Image Count -->
        <div class="absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20">
            <div
                class="px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#08B2B4]/80 backdrop-blur-sm text-white flex items-center gap-1 sm:gap-1.5 shadow-sm">
                <span class="material-symbols-outlined text-xs sm:text-sm">photo_camera</span>
                <span class="text-[10px] sm:text-[11px] font-black">{{ $product->images->count() }}</span>
            </div>
        </div>
    </div>

    <!-- Bottom: Content Section -->
    <div class="p-3 sm:p-5 flex flex-col flex-grow min-w-0 bg-white">
        <h3
            class="text-[15px] sm:text-lg font-black text-gray-900 leading-tight group-hover:text-[#08B2B4] transition-colors first-letter:uppercase mb-1 sm:mb-2 line-clamp-2 min-h-[2.5rem]">
            {{ $product->title }}
        </h3>

        <div class="flex items-center gap-1 sm:gap-2 mb-1.5 sm:mb-2">
            <p class="text-[11px] sm:text-sm text-gray-900 font-medium flex items-center truncate">
                <span class="hidden xs:inline mr-1">{{ __('message.sold_by') }}</span>
                <span class="text-gray-400 decoration-gray-400 underline decoration-1 underline-offset-4">
                    {{ $product->user->name ?? 'User' }}
                </span>
            </p>
        </div>

        <div class="flex items-center gap-1 text-gray-400 mb-3 sm:mb-4">
            <span class="material-symbols-outlined text-base sm:text-lg">location_on</span>
            <p class="text-[11px] sm:text-[13px] font-medium truncate">
                {{ $product->user->address['city'] ?? __('message.location_label') }}
            </p>
        </div>

        <!-- Divider -->
        <div class="h-[1px] w-full bg-gray-100 mb-3 sm:mb-4"></div>

        <!-- Price and Actions Section -->
        <div class="flex items-center justify-between mt-auto px-0 gap-1">
            <!-- Price -->
            <div class="flex flex-col min-w-0">
                <span class="text-[8px] sm:text-[9px] text-gray-400 uppercase font-black tracking-widest leading-none mb-1 sm:mb-1.5">
                    {{ __('message.price') }}
                </span>
                <span class="text-lg sm:text-xl font-black text-gray-900 leading-none truncate">
                    {{ __('message.money') }} {{ number_format($product->price, 2, ',', '.') }}
                </span>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-1 sm:gap-2 relative z-20 flex-shrink-0">
                <button class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full hover:bg-gray-50 transition-colors"
                    title="Condividi">
                    <!-- Share -->
                    <span class="material-symbols-outlined text-[#08B2B4] text-[18px] sm:text-[20px]">share</span>
                </button>

                <!-- Bottone Preferiti  -->
                <button x-data="{ 
                        isFavorite: {{ $product->isFavoritedBy(auth()->user()) ? 'true' : 'false' }},
                        loading: false,
                        removeFavLabel: '{{ __('message.remove_favorite') }}',
                        addFavLabel: '{{ __('message.add_favorite') }}',
                        toggle() {

                            if (this.loading) return;
                            this.loading = true;

                            fetch('{{ route('Backoffice.addFavorite', $product->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) this.isFavorite = data.isFavorite;
                            })
                            .catch(err => console.error(err))
                            .finally(() => this.loading = false);
                        }
                    }" @click.prevent="toggle()"
                    class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full hover:bg-gray-50 transition-colors"
                    :title="isFavorite ? removeFavLabel : addFavLabel">
                    <span class="material-symbols-outlined text-[20px] sm:text-[22px] transition-all"
                        :class="[isFavorite ? 'text-red-500' : 'text-[#08B2B4]', loading ? 'animate-pulse opacity-50' : '']"
                        :style="isFavorite ? 'font-variation-settings: \'FILL\' 1' : 'font-variation-settings: \'FILL\' 0'">
                        favorite
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<div data-name="{{ strtolower($product->title) }}" data-category="{{ $product->category ?? '' }}"
    data-price="{{ $product->price }}" data-location="{{ strtolower($product->user->address['city'] ?? '') }}"
    class="product-card group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col h-full overflow-hidden relative"
    style="font-family: 'Satoshi-Regular', sans-serif;">

    <!-- Link intera card per accessibilità -->
    <a href="{{ route('Frontoffice.product', ['id' => $product->id]) }}" class="absolute inset-0 z-10"
        aria-label="Vedi dettagli"></a>

    <!-- Top: Image Section -->
    <div class="relative w-full aspect-[4/3] overflow-hidden bg-gray-50 flex-shrink-0 rounded-t-2xl">
        @if($product->images && $product->images->isNotEmpty())
            <img src="{{ Storage::url($product->images->first()->path) }}" alt="{{ $product->title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                <span class="material-symbols-outlined text-5xl">image</span>
            </div>
        @endif

        <!-- Overlay Badge: Category -->
        <div class="absolute bottom-3 left-3 z-20">
            <span
                class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-[#08B2B4] text-white uppercase tracking-wider shadow-sm">
                {{ $product->category_name ?? __('message.category_label') }}
            </span>
        </div>

        <!-- Overlay Badge: Image Count -->
        <div class="absolute bottom-3 right-3 z-20">
            <div
                class="px-2.5 py-1.5 rounded-xl bg-[#08B2B4]/80 backdrop-blur-sm text-white flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined text-sm">photo_camera</span>
                <span class="text-[11px] font-black">{{ $product->images->count() }}</span>
            </div>
        </div>
    </div>

    <!-- Bottom: Content Section -->
    <div class="p-5 flex flex-col flex-grow min-w-0 bg-white">
        <h3
            class="text-lg font-black text-gray-900 leading-tight group-hover:text-[#08B2B4] transition-colors first-letter:uppercase mb-2">
            {{ $product->title }}
        </h3>

        <div class="flex items-center gap-2 mb-2">
            <p class="text-sm text-gray-900 font-medium flex items-center">
                {{ __('message.sold_by') }}
                <span class="text-gray-400 decoration-gray-400 underline decoration-1 underline-offset-4 mx-2">
                    {{ $product->user->name ?? 'User' }}
                </span>
            </p>
            <!-- Rating Stars
            <div class="flex items-center gap-0.5 text-yellow-400">
                @for($i = 0; $i < 4; $i++)
                    <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1">star</span>
                @endfor
                <span class="material-symbols-outlined text-[16px]">star_half</span>
            </div> -->
        </div>

        <div class="flex items-center gap-1 text-gray-400 mb-4">
            <span class="material-symbols-outlined text-lg">location_on</span>
            <p class="text-[13px] font-medium truncate">
                {{ $product->user->address['city'] ?? __('message.location_label') }}
            </p>
        </div>

        <!-- Divider -->
        <div class="h-[1px] w-full bg-gray-100 mb-4"></div>

        <!-- Price and Actions Section -->
        <div class="flex items-center justify-between mt-auto px-0">
            <!-- Price -->
            <div class="flex flex-col">
                <span class="text-[9px] text-gray-400 uppercase font-black tracking-widest leading-none mb-1.5">
                    {{ __('message.price') }}
                </span>
                <span class="text-xl font-black text-gray-900 leading-none">
                    {{ __('message.money') }} {{ number_format($product->price, 2, ',', '.') }}
                </span>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2 relative z-20">
                <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-50 transition-colors"
                    title="Condividi">
                    <!-- Eventuale implementazione share futura -->
                    <span class="material-symbols-outlined text-[#08B2B4] text-[20px]">share</span>
                </button>

                @php
                    $isFavorite = auth()->check() ? \App\Models\Favorite::where('product_id', $product->id)->where('user_id', auth()->id())->exists() : false;
                @endphp
                <button x-data="{ isFavorite: {{ $isFavorite ? 'true' : 'false' }} }" @click.prevent="
                        if (!{{ auth()->check() ? 'true' : 'false' }}) {
                            window.location.href = '{{ route('Auth.loginPage') }}';
                            return;
                        }
                        
                        fetch('{{ route('Backoffice.addFavorite', $product->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                isFavorite = !isFavorite;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    " class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-50 transition-colors"
                    title="Aggiungi ai preferiti">
                    <span class="material-symbols-outlined text-[22px] transition-colors"
                        :class="isFavorite ? 'text-red-500' : 'text-[#08B2B4]'"
                        :style="isFavorite ? 'font-variation-settings: \'FILL\' 1' : 'font-variation-settings: \'FILL\' 0'">
                        favorite
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
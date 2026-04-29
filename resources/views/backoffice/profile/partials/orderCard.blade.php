<div class="vue-island">
    <div data-created-at="{{ $order->created_at->format('Y-m-d') }}"
        class="order-card bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center md:items-stretch">
        <!-- Immagine Prodotto -->
        <div
            class="w-full md:w-48 aspect-square flex-shrink-0 rounded-2xl overflow-hidden flex items-center justify-center p-4">
            <img src="{{ Storage::url($order->product->images->first()->path) ?? 'https://placehold.co/400x400/f9f9f9/08B2B4?text=Product' }}"
                alt="Product" class="w-full h-full object-contain mix-blend-multiply">
        </div>

        <!-- Dettagli Ordine -->
        <div class="flex-grow flex flex-col justify-center py-2">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <div
                    class="flex items-center gap-2 bg-[#FFF9E5] text-[#FFB800] px-3 py-1.5 rounded-full text-xs font-bold border border-[#FFECB3]">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#FFB800]"></span>
                    {{ __('message.arriving') }}
                </div>
                <div class="hidden md:block h-5 w-[1px] bg-gray-200 mx-1"></div>
                <div class="text-[15px] text-gray-600 font-medium">
                    {{ __('message.delivery_expected') }} <span
                        class="text-primary font-bold">{{ __('message.delivery_date') }}</span>
                </div>
            </div>

            <div class="mb-1 text-[15px] text-gray-600 font-medium">
                {{ __('message.order_nr') }} <span
                    class="order-id text-primary font-bold">{{ $order['order_number'] ?? 'VDL-2026-0000' }}</span>
            </div>

            <h3 class="order-title text-[20px] font-bold text-gray-900 mb-6">
                {{ $order->product['title'] ?? __('message.no_product_name') }}
            </h3>

            <div class="mt-auto">
                <div class="text-[10px] uppercase text-gray-400 font-extrabold tracking-[0.1em] mb-0.5">
                    {{ __('message.price') }}
                </div>
                <div class="text-[20px] font-bold text-gray-900">
                    € {{ number_format($order->product['price'] ?? 000.00, 2, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Bottoni Azione -->
        <div class="w-full md:w-auto flex flex-col gap-3 justify-center">
            <ui-button variant="outline"
                class="w-full md:w-60 h-11 border-primary/40 text-primary hover:bg-primary/5 hover:border-primary rounded-md font-bold px-5 flex justify-start items-center gap-3 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-truck">
                    <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                    <path d="M15 18H9" />
                    <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                    <circle cx="7" cy="18" r="2" />
                    <circle cx="17" cy="18" r="2" />
                </svg>
                {{ __('message.track_shipping') }}
            </ui-button>

            <ui-button variant="outline"
                class="w-full md:w-60 h-11 border-primary/40 text-primary hover:bg-primary/5 hover:border-primary rounded-md font-bold px-5 flex justify-start items-center gap-3 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-rotate-ccw">
                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                    <path d="M3 3v5h5" />
                </svg>
                {{ __('message.return_order') }}
            </ui-button>

            <ui-button variant="outline"
                class="w-full md:w-60 h-11 border-primary/40 text-primary hover:bg-primary/5 hover:border-primary rounded-md font-bold px-5 flex justify-start items-center gap-3 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-message-circle">
                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                </svg>
                {{ __('message.contact_seller') }}
            </ui-button>
        </div>
    </div>
</div>
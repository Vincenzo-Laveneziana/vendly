<footer class="bg-[#08B2B4] text-white py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8">

            <!-- Logo e Descrizione -->
            <div class="flex flex-col sm:col-span-2 lg:col-span-2 pr-0 lg:pr-8">
                <h3 class="text-5xl md:text-6xl font-black mb-4 uppercase"
                    style="font-family: 'Integralcf', sans-serif;">VENDLY</h3>
                <p class="text-white/90 text-sm leading-relaxed mb-6">
                    {{ __('VENDLY nasce nel 2026 da un\'idea del nostro CEO Francesco Palasciano, lo scopo è rendere fruibile l\'accesso a tutti i prodotti usati del globo.') }}
                </p>
                <div class="flex items-center gap-3">
                    <a href="#" aria-label="Facebook"
                        class="w-8 h-8 bg-white text-[#08B2B4] rounded-full flex items-center justify-center hover:scale-110 shadow-sm transition-transform">
                        <svg class="fill-current w-4 h-4" viewBox="0 0 24 24">
                            <path d="M14 6h3v-5h-3c-3.86 0-7 3.14-7 7v3h-3v5h3v8h5v-8h4l1-5h-5v-3c0-1.1.9-2 2-2z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter"
                        class="w-8 h-8 bg-white text-[#08B2B4] rounded-full flex items-center justify-center hover:scale-110 shadow-sm transition-transform">
                        <svg class="fill-current w-4 h-4" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724 9.864 9.864 0 0 1-3.127 1.196 4.916 4.916 0 0 0-8.384 4.482A13.94 13.94 0 0 1 1.671 3.149a4.916 4.916 0 0 0 1.523 6.574 4.903 4.903 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 0 1-2.224.084 4.923 4.923 0 0 0 4.6 3.42A9.867 9.867 0 0 1 0 19.54a13.94 13.94 0 0 0 7.548 2.212c9.057 0 14.01-7.502 14.01-14.01 0-.213-.005-.425-.014-.636A10.012 10.012 0 0 0 24 4.557z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram"
                        class="w-8 h-8 bg-white text-[#08B2B4] rounded-full flex items-center justify-center hover:scale-110 shadow-sm transition-transform">
                        <svg class="fill-current w-4 h-4" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.344 3.608 1.319.975.975 1.257 2.242 1.319 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.344 2.633-1.319 3.608-.975.975-2.242 1.257-3.608 1.319-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.344-3.608-1.319-.975-.975-1.257-2.242-1.319-3.608-.058-1.265-.07-1.645-.07-4.849s.012-3.584.07-4.849c.062-1.366.344-2.633 1.319-3.608.975-.975 2.242-1.257 3.608-1.319 1.265-.058 1.645-.07 4.849-.07M12 0C8.741 0 8.332.014 7.052.072 2.695.272.272 2.69.072 7.052.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.28.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.362-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948 0-3.259-.014-3.668-.072-4.948-.2-4.358-2.618-6.78-6.98-6.98-1.28-.058-1.689-.072-4.948-.072zm0 5.838A6.162 6.162 0 1 0 18.162 12 6.162 6.162 0 0 0 12 5.838zm0 10.162A4 4 0 1 1 16 12a4 4 0 0 1-4 4zm6.406-11.845a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- AZIENDA -->
            <div class="flex flex-col">
                <h4 class="text-base font-semibold mb-5" style="font-family: 'Inter', sans-serif;">{{ __('message.company') }}
                </h4>
                <ul class="space-y-3 text-[13px] md:text-sm text-white/95">
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.who_we_are') }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.future_projects') }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.collaborations') }}
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.career') }}</a>
                    </li>
                </ul>
            </div>

            <!-- AIUTO -->
            <div class="flex flex-col">
                <h4 class="text-base font-semibold mb-5" style="font-family: 'Inter', sans-serif;">{{ __('message.help') }}
                </h4>
                <ul class="space-y-3 text-[13px] md:text-sm text-white/95">
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.customer_service') }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.shipping_details') }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.terms_and_conditions') }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.privacy_policy') }}</a>
                    </li>
                </ul>
            </div>

            <!-- FAQ -->
            <div class="flex flex-col">
                <h4 class="text-base font-semibold mb-5" style="font-family: 'Inter', sans-serif;">{{ __('message.faq') }}</h4>
                <ul class="space-y-3 text-[13px] md:text-sm text-white/95">
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.account') }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.orders') }}</a></li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.payments') }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-white hover:underline transition duration-300">{{ __('message.deliveries') }}</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>
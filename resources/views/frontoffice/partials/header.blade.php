<div x-data="{ mobileSearch: false }">
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 h-20 flex items-center">
        <div class="container mx-auto px-6 flex justify-between items-center gap-8">

            <!-- LATO SINISTRO: Logo -->
            <div class="flex items-center shrink-0">
                <a href="/" class="text-3xl font-bold text-vendly leading-none">
                    VENDLY
                </a>
            </div>

            <!-- CENTRO: Barra di Ricerca (Desktop) -->
            <div class="hidden lg:flex flex-1 max-w-3xl">
                <form action="{{ route('Frontoffice.ricerca') }}" method="GET" class="w-full">
                    <div class="relative flex items-center">
                        <span
                            class="material-symbols-outlined absolute left-4 text-gray-400 text-xl select-none">search</span>
                        <input type="text" name="query" placeholder="{{ __('message.search_products') }}"
                            class="w-full pl-12 pr-4 py-2.5 bg-gray-50 border-none rounded-lg text-sm font-medium outline-none focus:ring-0 placeholder:text-gray-400">
                    </div>
                </form>
            </div>

            <!-- LATO DESTRO: Nav & Auth -->
            <div class="flex items-center gap-3">

                <!-- Desktop Elements -->
                <div class="hidden sm:flex items-center gap-3">
                    <!-- Language Switcher -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                            class="flex items-center gap-2 px-3 h-11 bg-white border border-[#08B2B4] rounded-lg hover:bg-vendly/5 transition-all focus:outline-none min-w-[90px] justify-between text-green">
                            <div class="flex items-center gap-2">
                                @if (app()->getLocale() == 'it')
                                    <img src="https://flagicons.lipis.dev/flags/4x3/it.svg" class="w-5 h-auto" alt="IT">
                                    <span class="text-xs uppercase">ITA</span>
                                @else
                                    <img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" class="w-5 h-auto" alt="EN">
                                    <span class="text-xs uppercase">ENG</span>
                                @endif
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute top-full left-0 mt-1 w-full min-w-[120px] bg-white border border-[#08B2B4] rounded-lg shadow-lg z-50 p-2 flex flex-col gap-1"
                            style="display: none;">
                            <a href="/language/it"
                                class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-vendly/5 text-xs text-green">
                                <img src="https://flagicons.lipis.dev/flags/4x3/it.svg" class="w-4 h-auto" alt="IT"> ITA
                            </a>
                            <a href="/language/en"
                                class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-vendly/5 text-xs text-green">
                                <img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" class="w-4 h-auto" alt="EN"> ENG
                            </a>
                        </div>
                    </div>

                    <!-- Help Button -->
                    <a href="#"
                        class="flex items-center gap-2 px-4 h-11 border border-[#08B2B4] rounded-lg text-green hover:bg-vendly/5 transition-all">
                        <span class="material-symbols-outlined text-xl">help</span>
                        <span class="text-sm font-medium">{{ __('message.help') ?? 'Aiuto' }}</span>
                    </a>

                    @auth
                        <!-- Profile Button -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center gap-2 px-4 h-11 border border-[#08B2B4] rounded-lg text-green hover:bg-vendly/5 transition-all">
                                <span class="material-symbols-outlined text-xl">account_circle</span>
                                <span class="text-sm font-medium">{{ __('message.profile') ?? 'Profilo' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-56 bg-white border border-gray-100 rounded-lg shadow-xl py-2 z-50 overflow-hidden"
                                style="display: none;">
                                <a href="{{ route('Backoffice.profile') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">person</span>
                                    {{ __('message.profile') }}
                                </a>
                                <a href="{{ route('Backoffice.sale') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">article</span>
                                    {{ __('message.sale') }}
                                </a>
                                <a href="{{ route('Backoffice.favorites') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">favorite</span>
                                    {{ __('message.favorites') }}
                                </a>
                                <a href="{{ route('Backoffice.orders') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">orders</span>
                                    {{ __('message.orders') }}
                                </a>
                                <a href="{{ route('Backoffice.createChat') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">chat_bubble</span>
                                    {{ __('message.chats') }}
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('Auth.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                        <span class="material-symbols-outlined text-xl">logout</span>
                                        {{ __('message.log_out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login Link -->
                        <a href="{{ route('Auth.loginPage') }}"
                            class="flex items-center gap-2 px-4 h-11 border border-[#08B2B4] rounded-lg text-green hover:bg-vendly/5 transition-all">
                            <span class="material-symbols-outlined text-xl">login</span>
                            <span class="text-sm font-medium">{{ __('message.log_in') ?? 'Accedi' }}</span>
                        </a>
                    @endauth

                    <!-- Sell Button -->
                    <a href="{{ route('Backoffice.sellForm') }}"
                        class="flex items-center justify-center bg-vendly text-white rounded-lg px-6 h-11 text-sm font-medium transition-all hover:bg-[#079fa1] active:scale-95 leading-none shadow-sm">
                        <span class="material-symbols-outlined text-xl mr-1">add</span>
                        {{ __('message.sell_on_vendly') ?? 'Vendi subito' }}
                    </a>
                </div>

                <!-- Mobile Header Icons (Visible only on mobile) -->
                <div class="flex sm:hidden items-center gap-4">
                    <a href="#" class="text-green flex items-center">
                        <span class="material-symbols-outlined text-2xl">help</span>
                    </a>
                    @auth
                        <!-- Profile Button -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center gap-1 h-11 text-green hover:bg-vendly/5 rounded-lg transition-all">
                                <span class="material-symbols-outlined text-3xl">account_circle</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-56 bg-white border border-gray-100 rounded-lg shadow-xl py-2 z-50 overflow-hidden"
                                style="display: none;">
                                <a href="{{ route('Backoffice.profile') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">person</span>
                                    {{ __('message.profile') }}
                                </a>
                                <a href="{{ route('Backoffice.sale') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">article</span>
                                    {{ __('message.sale') }}
                                </a>
                                <a href="{{ route('Backoffice.favorites') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">favorite</span>
                                    {{ __('message.favorites') }}
                                </a>
                                <a href="{{ route('Backoffice.orders') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">orders</span>
                                    {{ __('message.orders') }}
                                </a>
                                <a href="{{ route('Backoffice.createChat') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-vendly/5 hover:text-green">
                                    <span class="material-symbols-outlined text-xl">chat_bubble</span>
                                    {{ __('message.chats') }}
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('Auth.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                        <span class="material-symbols-outlined text-xl">logout</span>
                                        {{ __('message.log_out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login Link -->
                        <a href="{{ route('Auth.loginPage') }}"
                            class="flex items-center gap-2 px-4 h-11 border border-[#08B2B4] rounded-lg text-green hover:bg-vendly/5 transition-all">
                            <span class="material-symbols-outlined text-xl">login</span>
                            <span class="text-sm font-medium">{{ __('message.log_in') ?? 'Accedi' }}</span>
                        </a>
                    @endauth
                    <!-- Mobile Toggle -->
                    <button @click="mobileSearch = !mobileSearch" class="flex items-center justify-center text-green">
                        <span class="material-symbols-outlined text-3xl"
                            x-text="mobileSearch ? 'close' : 'menu'">menu</span>
                    </button>
                </div>

            </div>
        </div>
    </header>

    <!-- Mobile Expanded Menu -->
    <div x-show="mobileSearch" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="sm:hidden bg-white px-6 pb-6 border-b border-gray-100 space-y-6" style="display: none;">

        <!-- Middle Row: Language & Sell Button -->
        <div class="flex justify-between items-center pt-2">
            <!-- Language Switcher -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" type="button"
                    class="flex items-center gap-2 px-3 h-11 bg-white border border-[#08B2B4] rounded-lg text-green min-w-[100px] justify-between">
                    <div class="flex items-center gap-2">
                        @if (app()->getLocale() == 'it')
                            <img src="https://flagicons.lipis.dev/flags/4x3/it.svg" class="w-5 h-auto" alt="IT">
                            <span class="text-xs uppercase">ITA</span>
                        @else
                            <img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" class="w-5 h-auto" alt="EN">
                            <span class="text-xs uppercase">ENG</span>
                        @endif
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="transition-transform duration-200" :class="open ? 'rotate-180' : ''">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute top-full left-0 mt-1 w-full bg-white border border-[#08B2B4] rounded-lg shadow-lg z-50 p-2 flex flex-col gap-1">
                    <a href="/language/it"
                        class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-vendly/5 text-xs text-green">
                        <img src="https://flagicons.lipis.dev/flags/4x3/it.svg" class="w-4 h-auto" alt="IT"> ITA
                    </a>
                    <a href="/language/en"
                        class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-vendly/5 text-xs text-green">
                        <img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" class="w-4 h-auto" alt="EN"> ENG
                    </a>
                </div>
            </div>

            <!-- Sell Button -->
            <a href="{{ route('Backoffice.sellForm') }}"
                class="flex items-center justify-center bg-vendly text-white rounded-lg px-6 h-11 text-sm font-medium shadow-sm active:scale-95 transition-all">
                {{ __('message.sell_on_vendly') ?? 'Vendi subito' }}
            </a>
        </div>

        <!-- Bottom Row: Search Bar -->
        <form action="{{ route('Frontoffice.ricerca') }}" method="GET" class="w-full">
            <div class="relative flex items-center group">
                <span
                    class="material-symbols-outlined absolute left-4 text-gray-400 text-xl select-none transition-colors group-focus-within:text-green">search</span>
                <input type="text" name="query" placeholder="{{ __('message.search_products') }}"
                    class="w-full pl-12 pr-4 py-3 bg-gray-50 border-none rounded-lg text-sm outline-none transition-all focus:ring-0">
            </div>
        </form>
    </div>
</div>
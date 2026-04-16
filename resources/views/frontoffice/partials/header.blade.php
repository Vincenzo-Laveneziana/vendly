<div x-data="{ mobileSearch: false }">
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 h-16 md:h-20 flex items-center">
        <div class="container mx-auto px-6 flex justify-between items-center gap-4">

            <!-- LATO SINISTRO: Logo -->
            <div class="flex items-center shrink-0">
                <a href="/" class="text-2xl md:text-3xl text-vendly leading-none">
                    VENDLY
                </a>
            </div>

            <!-- CENTRO: Barra di Ricerca (Desktop) -->
            <div class="hidden lg:flex flex-1 max-w-2xl px-8">
                <form action="{{ route('Frontoffice.ricerca') }}" method="GET" class="w-full">
                    <div class="relative flex items-center group">
                        <span
                            class="material-symbols-outlined absolute left-4 text-gray-400 text-xl transition-colors group-focus-within:text-vendly select-none">search</span>
                        <input type="text" name="query" placeholder="{{ __('message.search_products') }}"
                            class="w-full pl-12 pr-4 py-2.5 bg-gray-100/50 hover:bg-gray-100 focus:bg-white border-transparent focus:border-vendly/20 focus:ring-4 focus:ring-vendly/5 rounded-2xl transition-all text-sm font-medium outline-none shadow-sm">
                    </div>
                </form>
            </div>

            <!-- LATO DESTRO: Nav & Auth -->
            <div class="flex items-center gap-3 md:gap-4">

                <!-- Language Switcher (Pills) -->
                <div class="hidden sm:flex items-center gap-2 mr-2">
                    <a href="/language/it"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs transition-all {{ app()->getLocale() == 'it' ? 'bg-vendly text-white shadow-lg shadow-vendly/20' : 'bg-white text-[#08B2B4] border border-vendly/30 hover:bg-vendly/5' }}">
                        <span
                            class="w-2.5 h-2.5 rounded-full {{ app()->getLocale() == 'it' ? 'bg-white' : 'border border-vendly/40 bg-white' }}"></span>
                        IT
                    </a>
                    <a href="/language/en"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs transition-all {{ app()->getLocale() == 'en' ? 'bg-vendly text-white shadow-lg shadow-vendly/20' : 'bg-white text-[#08B2B4] border border-vendly/30 hover:bg-vendly/5' }}">
                        <span
                            class="w-2.5 h-2.5 rounded-full {{ app()->getLocale() == 'en' ? 'bg-white' : 'border border-vendly/40 bg-white' }}"></span>
                        EN
                    </a>
                </div>

                <!-- Action Icons -->
                <div class="flex items-center gap-2 md:gap-3">
                    <!-- Help Icon -->
                    <a href="#"
                        class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-full border border-vendly/30 text-vendly hover:bg-vendly/5 transition-all">
                        <span class="material-symbols-outlined text-xl md:text-2xl">help</span>
                    </a>

                    @auth
                        <!-- Chat Icon -->
                        <a href="{{ route('Backoffice.createChat') }}"
                            class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-full border border-vendly/30 text-vendly hover:bg-vendly/5 transition-all relative">
                            <span class="material-symbols-outlined text-xl md:text-2xl">chat_bubble</span>
                        </a>

                        <!-- Profile Icon Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <div @click="open = !open"
                                class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-full border border-vendly text-vendly hover:bg-vendly/5 transition-all cursor-pointer">
                                <span class="material-symbols-outlined text-xl md:text-2xl">account_circle</span>
                            </div>

                            <!-- Dropdown Auth -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-[1.5rem] shadow-xl py-3 z-50 overflow-hidden ring-1 ring-black/5">
                                <a href="{{ route('Backoffice.profile') }}"
                                    class="flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-vendly/5 hover:text-vendly transition-colors">
                                    <span class="material-symbols-outlined text-xl">person</span>
                                    {{ __('message.profile') }}
                                </a>
                                <a href="{{ route('Backoffice.sellForm') }}"
                                    class="flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-vendly/5 hover:text-vendly transition-colors">
                                    <span class="material-symbols-outlined text-xl">add_circle</span>
                                    {{ __('message.create_ad') }}
                                </a>
                                <div class="border-t border-gray-100 my-2"></div>
                                <form method="POST" action="{{ route('Auth.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 w-full text-left px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <span class="material-symbols-outlined text-xl">logout</span>
                                        {{ __('message.log_out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('Auth.loginPage') }}"
                            class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-full border border-vendly text-vendly hover:bg-vendly/5 transition-all">
                            <span class="material-symbols-outlined text-xl md:text-2xl">login</span>
                        </a>
                    @endauth
                </div>

                <!-- Sell Button -->
                <a href="{{ route('Backoffice.sellForm') }}"
                    class="hidden md:flex items-center justify-center bg-vendly text-white rounded-xl px-6 py-2.5 text-sm transition-all hover:bg-[#079fa1] hover:shadow-lg hover:shadow-vendly/20 active:scale-95 leading-none shrink-0">
                    {{ __('message.sell_on_vendly') }}
                </a>

                <!-- Mobile Menu Toggle -->
                <button @click="mobileSearch = !mobileSearch"
                    class="md:hidden flex items-center justify-center w-10 h-10 text-vendly active:scale-90 transition-transform">
                    <span class="material-symbols-outlined text-3xl"
                        x-text="mobileSearch ? 'close' : 'menu'">menu</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Bar -->
    <div x-show="mobileSearch" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-white px-6 py-4 border-b border-gray-100"
        style="display: none;">

        <!-- Top Actions: Language & Sell Button -->
        <div class="flex justify-between items-center mb-4">
            <!-- Language Switcher (Pills) -->
            <div class="flex items-center gap-2">
                <a href="/language/it"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs transition-all {{ app()->getLocale() == 'it' ? 'bg-vendly text-white shadow-lg shadow-vendly/20' : 'bg-white text-[#08B2B4] border border-vendly/30 hover:bg-vendly/5' }}">
                    <span
                        class="w-2 h-2 rounded-full {{ app()->getLocale() == 'it' ? 'bg-white' : 'border border-vendly/40 bg-white' }}"></span>
                    IT
                </a>
                <a href="/language/en"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs transition-all {{ app()->getLocale() == 'en' ? 'bg-vendly text-white shadow-lg shadow-vendly/20' : 'bg-white text-[#08B2B4] border border-vendly/30 hover:bg-vendly/5' }}">
                    <span
                        class="w-2 h-2 rounded-full {{ app()->getLocale() == 'en' ? 'bg-white' : 'border border-vendly/40 bg-white' }}"></span>
                    EN
                </a>
            </div>

            <!-- Sell Button -->
            <a href="{{ route('Backoffice.sellForm') }}"
                class="flex items-center justify-center bg-vendly text-white rounded-xl px-4 py-2 text-xs transition-all hover:bg-[#079fa1] hover:shadow-lg hover:shadow-vendly/20 active:scale-95 leading-none shrink-0">
                {{ __('message.sell_on_vendly') }}
            </a>
        </div>

        <form action="{{ route('Frontoffice.ricerca') }}" method="GET" class="w-full">
            <div class="relative flex items-center group">
                <span
                    class="material-symbols-outlined absolute left-3 text-gray-400 text-lg transition-colors group-focus-within:text-vendly select-none">search</span>
                <input type="text" name="query" placeholder="{{ __('message.search_products') }}"
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-100/80 focus:bg-white border border-transparent focus:border-vendly/20 rounded-xl text-sm shadow-inner outline-none transition-all">
            </div>
        </form>
    </div>
</div>
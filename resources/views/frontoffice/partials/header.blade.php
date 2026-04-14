<header class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-2 sm:px-2 lg:px-4 flex justify-between items-center h-16 md:h-20">

        <!-- Logo e Navigazione Principale -->
        <div class="flex items-center mr-5 gap-6 xl:gap-10">
            <a href="/" class="text-2xl md:text-3xl font-black text-[#08B2B4] shrink-0 text-vendly">
                VENDLY
            </a>
        </div>

        <!-- Ricerca e Auth -->
        <div class="flex items-center gap-3 md:gap-6 flex-1 justify-end">

            <div class="flex gap-2">
                <a href="/language/it"
                    class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-300 shadow-sm flex items-center gap-1.5 {{ app()->getLocale() == 'it' ? 'bg-vendly text-white shadow-[#08B2B4]/30' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full {{ app()->getLocale() == 'it' ? 'bg-white' : 'bg-transparent border border-gray-300' }}"></span>
                    IT
                </a>
                <a href="/language/en"
                    class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-300 shadow-sm flex items-center gap-1.5 {{ app()->getLocale() == 'en' ? 'bg-vendly text-white shadow-[#08B2B4]/30' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full {{ app()->getLocale() == 'en' ? 'bg-white' : 'bg-transparent border border-gray-300' }}"></span>
                    EN
                </a>
            </div>


            <!-- Barra di Ricerca (Nasconde su Mobile, Espande su Desktop) -->
            <form action="{{ route('Frontoffice.ricerca') }}" method="GET"
                class="vue-island relative flex-1 max-w-[140px] sm:max-w-xs md:max-w-md hidden sm:block">
                <div class="relative flex items-center group">
                    <span
                        class="material-symbols-outlined absolute left-3 text-gray-400 text-lg md:text-xl transition-colors group-focus-within:text-[#08B2B4]">search</span>
                    <ui-input name="query" placeholder="{{ __('message.search_products') }}"
                        class="pl-10 pr-4 py-2 bg-gray-100/80 focus:bg-white focus:border-[#08B2B4] focus:ring-4 focus:ring-[#08B2B4]/10 rounded-2xl transition-all w-full h-10 md:h-11 text-sm shadow-inner"></ui-input>
                </div>
            </form>

            <div class="flex items-center gap-2 md:gap-4">
                <!-- Mobile Search Trigger (Solo su schermi piccolissimi se necessario, qui usiamo sm:block per il form) -->
                @auth
                    <a href="{{ route('Backoffice.createChat') }}"
                        class="text-[#08B2B4] text-md transition-all relative group">
                        <span class="material-symbols-outlined text-2xl">chat</span>
                    </a>
                @endauth

                @guest
                    <div class="vue-island flex items-center gap-2">
                        <ui-button as="a" href="{{ route('Auth.loginPage') }}" variant="outline"
                            class="inline-flex border-[#08B2B4] text-[#08B2B4] hover:bg-[#08B2B4]/5 font-bold rounded-xl px-2 md:px-4 h-8 md:h-10 text-xs md:text-sm transition-all">
                            {{ __('message.login_register') }}
                        </ui-button>
                    </div>
                @endguest

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <div @click="open = !open"
                            class="flex items-center gap-2 px-2 md:px-3 py-1.5 bg-gray-50 hover:bg-white hover:shadow-sm rounded-full border border-gray-200 cursor-pointer transition-all">
                            <span class="material-symbols-outlined text-[#08B2B4] text-2xl">account_circle</span>
                            <!-- <span class="hidden md:block text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span> -->
                            <span class="material-symbols-outlined text-gray-400 text-sm block">expand_more</span>
                        </div>

                        <!-- Dropdown Auth -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-56 bg-white border border-gray-200 rounded-xl shadow-sm py-2 z-50 overflow-hidden">
                            <a href="{{ route('Backoffice.profile') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#08B2B4] transition-colors">
                                <span class="material-symbols-outlined text-xl">person</span> {{ __('message.profile') }}
                            </a>
                            <a href="{{ route('Backoffice.sellForm') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#08B2B4] transition-colors">
                                <span class="material-symbols-outlined text-xl">add_circle</span> {{ __('message.create_ad') }}
                            </a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <form method="POST" action="{{ route('Auth.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors font-bold">
                                    <span class="material-symbols-outlined text-xl">logout</span> {{ __('message.log_out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                <div class="vue-island flex items-center gap-2">
                    <ui-button as="a" href="{{ route('Frontoffice.vendere') }}"
                        class="inline-flex bg-[#08B2B4] text-white font-bold rounded-xl px-2 md:px-4 h-8 md:h-10 text-xs md:text-sm transition-all">
                        {{ __('message.sell_on_vendly') }}
                    </ui-button>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16 md:h-20">
        
        <!-- Logo e Navigazione Principale -->
        <div class="flex items-center mr-5 gap-6 xl:gap-10">
            <a href="/" class="text-2xl md:text-3xl font-black text-[#08B2B4] tracking-tighter shrink-0" style="font-family: 'Integralcf', sans-serif;">
                VENDLY
            </a>

            <!-- Navbar Links (Tablet/Desktop) -->
            <nav class="hidden lg:flex items-center gap-5 xl:gap-8 text-sm font-bold tracking-wide text-gray-600" style="font-family: 'Satoshi', sans-serif;">
                <a href="{{ route('home') }}" class="hover:text-[#08B2B4] transition-all relative group">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#08B2B4] transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('esplora') }}" class="hover:text-[#08B2B4] transition-all relative group">
                    Prodotti
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#08B2B4] transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('vendere') }}" class="hover:text-[#08B2B4] transition-all relative group">
                    Vendi
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#08B2B4] transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('chat') }}" class="hover:text-[#08B2B4] transition-all relative group">
                    Chat
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#08B2B4] transition-all group-hover:w-full"></span>
                </a>
            </nav>
        </div>

        <!-- Ricerca e Auth -->
        <div class="flex items-center gap-3 md:gap-6 flex-1 justify-end">
            
            <!-- Barra di Ricerca (Nasconde su Mobile, Espande su Desktop) -->
            <form action="{{ route('ricerca') }}" method="GET" class="vue-island relative flex-1 max-w-[140px] sm:max-w-xs md:max-w-md hidden sm:block">
                <div class="relative flex items-center group">
                    <span class="material-symbols-outlined absolute left-3 text-gray-400 text-lg md:text-xl transition-colors group-focus-within:text-[#08B2B4]">search</span>
                    <ui-input 
                        name="query" 
                        placeholder="Cerca prodotti..." 
                        class="pl-10 pr-4 py-2 bg-gray-100/80 border-transparent focus:bg-white focus:border-[#08B2B4] focus:ring-4 focus:ring-[#08B2B4]/10 rounded-2xl transition-all w-full h-10 md:h-11 text-sm shadow-inner"
                    ></ui-input>
                </div>
            </form>

            <div class="flex items-center gap-2 md:gap-4">
                <!-- Mobile Search Trigger (Solo su schermi piccolissimi se necessario, qui usiamo sm:block per il form) -->
                
                @guest
                <div class="vue-island flex items-center gap-2">
                    <ui-button as="a" href="/login" class="bg-[#08B2B4] hover:bg-[#069a9b] text-white font-bold rounded-xl px-4 md:px-6 h-9 md:h-11 text-xs md:text-sm transition-all shadow-lg shadow-[#08B2B4]/20">
                        Accedi
                    </ui-button>
                    <ui-button as="a" href="/register" variant="outline" class="inline-flex border-[#08B2B4] text-[#08B2B4] hover:bg-[#08B2B4]/5 font-bold rounded-xl px-4 md:px-6 h-9 md:h-11 text-xs md:text-sm transition-all">
                        Registrati
                    </ui-button>
                </div>
                @endguest

                @auth
                <div class="relative" x-data="{ open: false }">
                    <div @click="open = !open" 
                        class="flex items-center gap-2 px-2 md:px-3 py-1.5 bg-gray-50 hover:bg-white hover:shadow-md rounded-full border border-gray-100 cursor-pointer transition-all">
                        <span class="material-symbols-outlined text-[#08B2B4] text-2xl">account_circle</span>
                        <span class="hidden md:block text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                        <span class="material-symbols-outlined text-gray-400 text-sm hidden md:block">expand_more</span>
                    </div>

                    <!-- Dropdown Auth -->
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
                        class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-2xl shadow-2xl py-2 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-50 md:hidden">
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Account</p>
                            <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        </div>
                        <a href="{{ route('profilo') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#08B2B4] transition-colors">
                            <span class="material-symbols-outlined text-xl">person</span> Profilo
                        </a>
                        <a href="{{ route('formVendita') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#08B2B4] transition-colors">
                            <span class="material-symbols-outlined text-xl">add_circle</span> Crea Annuncio
                        </a>
                        <div class="border-t border-gray-50 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors font-bold">
                                <span class="material-symbols-outlined text-xl">logout</span> Esci
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                <!-- Hamburger Menu (Mobile/Tablet) -->
                <div class="lg:hidden" x-data="{ mobileOpen: false }">
                    <button @click="mobileOpen = !mobileOpen" class="p-2 text-gray-600 hover:text-[#08B2B4] hover:bg-gray-50 rounded-lg transition-all">
                        <span class="material-symbols-outlined text-3xl">menu</span>
                    </button>

                    <!-- Mobile Menu Dropdown -->
                    <div x-show="mobileOpen" @click.away="mobileOpen = false" x-transition
                        class="absolute z-50 top-16 md:top-20 left-0 right-0 bg-white border-b border-gray-200 shadow-xl py-4 flex flex-col gap-2 px-6">
                        <a href="{{ route('home') }}" class="py-2 text-gray-700 font-medium border-b border-gray-50 hover:text-[#08B2B4]">Home</a>
                        <a href="{{ route('esplora') }}" class="py-2 text-gray-700 font-medium border-b border-gray-50 hover:text-[#08B2B4]">Prodotti</a>
                        <a href="{{ route('vendere') }}" class="py-2 text-gray-700 font-medium border-b border-gray-50 hover:text-[#08B2B4]">Vendi</a>
                        <a href="{{ route('chat') }}" class="py-2 text-gray-700 font-medium hover:text-[#08B2B4]">Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
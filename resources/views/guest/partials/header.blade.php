<header class="bg-white shadow-md">
    <div style="font-variation-settings: 'FILL' 2, 'wght' 300, 'GRAD' 0, 'opsz' 24;" class="container mx-auto px-6 py-4 flex justify-between items-center h-20">
        
        <div class="inline-flex items-center gap-2 md:gap-4">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo TuttoSubito" class="h-12 md:h-18">
            </a>
        </div>

        <!-- Navbar Links (Desktop) -->
        <nav class="hidden md:flex items-center gap-6">
            <a href="/" class="text-gray-700 font-medium hover:text-blue-600 transition-colors">Home</a>
            <a href="#" class="text-gray-700 font-medium hover:text-blue-600 transition-colors">Esplora</a>
            <a href="{{ route('vendere') }}" class="text-gray-700 font-medium hover:text-blue-600 transition-colors">Vendi</a>
        </nav>

        <!-- Mobile Menu Toggle -->
        <div class="flex items-center gap-2">
            <div class="md:hidden" x-data="{ mobileOpen: false }">
                <button @click="mobileOpen = !mobileOpen" class="text-gray-700 hover:text-blue-600">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>

            <!-- Mobile Menu Dropdown -->
                <div x-show="mobileOpen" @click.away="mobileOpen = false" x-transition
                    class="absolute z-20 top-20 left-0 right-0 bg-white border-b border-gray-200 shadow-lg py-2">
                    <a href="/" class="block px-6 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Home</a>
                    <a href="#" class="block px-6 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Esplora</a>
                    <a href="{{ route('vendere') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Vendi</a>
            </div>
        </div>

        @guest
        <div class="absolute z-50 flex items-center gap-2 md:gap-4">
            <a href="/login" class="inline-flex items-center justify-center px-3 py-1 md:px-5 md:py-1 bg-blue-600 text-white font-semibold rounded-full border-2 border-blue-600 hover:bg-blue-700 transition duration-300 text-sm md:text-base">
                Accedi
            </a>

            <a href="/register" class="inline-flex items-center justify-center px-3 py-1 md:px-5 md:py-1 bg-transparent text-blue-600 font-semibold rounded-full border-2 border-blue-600 hover:bg-blue-50 transition duration-300 text-sm md:text-base">
                Registrati
            </a>
        </div>
        @endguest

        @auth
        <div class="relative" x-data="{ open: false }">
            <div @click="open = !open" 
                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors duration-200 cursor-pointer border border-gray-200">
                <span class="material-symbols-outlined text-xl">account_circle</span>
                <span class="hidden md:flex ml-2 font-medium text-sm tracking-wide">{{ Auth::user()->name }}</span>
                <span class="material-symbols-outlined text-sm ml-1">expand_more</span>
            </div>

            <div x-show="open" 
                @click.away="open = false"
                x-transition
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50">
                
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Profilo</a>
                <a href="{{ route('vendere') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Crea Annuncio</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Impostazioni</a>
                
                <div class="border-t border-gray-100 my-1"></div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition-colors">
                        Esci
                    </button>
                </form>
            </div>
        </div>
        </div>
        
        @endauth

    </div>
</header>
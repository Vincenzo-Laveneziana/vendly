<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vendly')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">
    <script>console.log('loading..');</script>
    <div id="page-loader"
        class="fixed inset-0 flex items-center justify-center bg-white z-50 transition-opacity duration-500">
        <div class="w-12 h-12 border-4 border-[#10b1ac] border-t-transparent rounded-full animate-spin"></div>
    </div>

    <div class="fixed top-6 right-6 z-60 flex gap-2">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="transition-transform duration-200" :class="open ? 'rotate-180' : ''">
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
    </div>

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Left Section: Image Collage (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12 bg-gray-50/30">
            <img src="{{ asset('images/GroupImages.webp') }}" alt="Vendly Show"
                class="max-w-full h-auto object-contain">
        </div>

        <!-- Right Section: Form Content -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-12 lg:px-20">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex justify-center mb-6 lg:mb-8">
                    <h1 class="text-4xl font-extrabold tracking-tight text-vendly">VENDLY</h1>
                </div>

                <!-- Form Section -->
                <div class="bg-white">
                    @yield('content')
                </div>

                <!-- Back to Home Link -->
                <div class="mt-8">
                    <a href="/"
                        class="flex items-center justify-center gap-2 text-sm text-gray-500 hover:text-green transition-colors underline-offset-4 hover:underline">
                        <span class="material-symbols-outlined text-base">arrow_back</span>
                        {{ __('message.back_to_home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function () {
            const loader = document.getElementById('page-loader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        });
    </script>
</body>

</html>
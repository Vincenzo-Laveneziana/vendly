<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TuttoSubito')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    <!-- Sfondo base fisso -->
    <div class="fixed inset-0 bg-gray-100 -z-20"></div>

    <!-- Blob decorativi globali -->
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="fixed bottom-0 -left-32 w-64 md:w-[28rem] pointer-events-none rotate-[15deg] opacity-60 -z-10 select-none">
    <img src="{{ asset('images/blob_02.png') }}" alt=""
        class="fixed top-16 -right-32 w-64 md:w-[28rem] pointer-events-none -rotate-[20deg] opacity-60 -z-10 select-none">

    <div id="page-loader"
        class="fixed inset-0 flex items-center justify-center bg-white transition-opacity duration-500">
        <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
    </div>
    <!-- includo header e footer -->
    @include('guest.partials.header')

    <main class="">
        @include('guest.partials.toast')
        @yield('content-guest')
    </main>

    @include('guest.partials.footer')

</body>
<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('page-loader');
        loader.style.opacity = '0';
        setTimeout(() => {
            loader.style.display = 'none';
            document.body.classList.remove('loading');
        }, 500);
    });
</script>

</html>
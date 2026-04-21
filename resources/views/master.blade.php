<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vendly')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    <script>console.log('loading..');</script>
    <!-- Sfondo base fisso -->
    <div class="fixed inset-0 bg-gray-100 -z-20"></div>

    <div id="page-loader"
        class="fixed inset-0 flex items-center justify-center bg-white transition-opacity duration-500">
        <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
    </div>
    <!-- includo header e footer -->
    @include('frontoffice.partials.header')

    <main class="">
        @include('frontoffice.partials.toast')
        @yield('content')
    </main>

    @include('frontoffice.partials.footer')

    @stack('scripts')
</body>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
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
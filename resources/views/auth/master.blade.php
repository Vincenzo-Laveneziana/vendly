<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vendly')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Satoshi-VariableItalic', sans-serif;
        }

        .text-vendly {
            font-family: 'Integralcf-bold', sans-serif;
            color: #08B2B4;
        }

        .bg-vendly {
            background-color: #08B2B4;
        }
    </style>
</head>

<body class="bg-white min-h-screen">
    <div id="page-loader"
        class="fixed inset-0 flex items-center justify-center bg-white z-50 transition-opacity duration-500">
        <div class="w-12 h-12 border-4 border-[#10b1ac] border-t-transparent rounded-full animate-spin"></div>
    </div>

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Left Section: Image Collage (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12 bg-gray-50/30">
            <img src="{{ asset('images/GroupImages.png') }}" alt="Vendly Show" class="max-w-full h-auto object-contain">
        </div>

        <!-- Right Section: Form Content -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-12 lg:px-20">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex justify-center mb-6 lg:mb-8">
                    <h1 class="text-4xl font-extrabold tracking-tighter text-vendly">VENDLY</h1>
                </div>

                <!-- Form Section -->
                <div class="bg-white">
                    @yield('content')
                </div>

                <!-- Back to Home Link -->
                <div class="mt-8">
                    <a href="/"
                        class="flex items-center justify-center gap-2 text-sm text-gray-500 hover:text-vendly transition-colors underline-offset-4 hover:underline">
                        <span class="material-symbols-outlined text-base">arrow_back</span>
                        Torna alla Home
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
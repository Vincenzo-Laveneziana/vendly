@extends('guest.master-guest')

@section('title', 'Esplora Annunci')

@section('content-guest')
    <div class="min-h-screen bg-gray-50">
        <div class="relative">
            <div class="relative w-full overflow-hidden shadow-lg h-[320px] md:h-[420px] flex flex-col justify-center text-left px-8 md:px-24"
                style="background-image: url('{{ asset('images/home.jpg') }}'); background-size: cover; background-position: top;">

                <!-- Filtro grigio per scurire lo sfondo -->
                <div class="absolute inset-0 bg-gray-900/50 pointer-events-none"></div>
                <div class="w-full flex flex-col items-start justify-center">
                    <div class="relative z-10 max-w-xl">
                        <h1 class="text-2xl md:text-4xl font-black text-[#08B2B4] mb-6"
                            style="font-family: 'Integralcf', sans-serif;">
                            DAGLI OGGETTI<br>
                            CHE NON USI AI<br>
                            DESIDERI CHE<br>
                            ANCORA HAI.
                        </h1>

                        <a href="{{ route('esplora') }}"
                            class="inline-flex items-center mt-1 px-6 py-2 bg-[#08B2B4] hover:bg-[#069a9b] text-white font-bold text-sm rounded-xl transition-all active:scale-95">
                            Scopri ora
                        </a>
                    </div>
                </div>


                <div class="absolute bottom-2 left-0 right-0 flex justify-center z-10">
                    <h2 class="text-2xl md:text-4xl font-black text-[#08B2B4] uppercase letter-spacing-1"
                        style="font-family: 'Integralcf', sans-serif;">
                        TOP CATEGORIE
                    </h2>
                </div>
            </div>
        </div>
        <!-- Sezione Top Categorie -->
        <div>
            <div class="w-full bg-[#08B2B4] py-4 md:py-6">
                <div class="container min-w-full mx-auto px-2 flex flex-wrap justify-evenly items-center">
                    <a href="{{ route('esplora', ['categoria' => 'Elettronica']) }}"
                        class="text-white text-base md:text-xl font-medium hover:underline decoration-white decoration-2 underline-offset-8 transition-all">
                        Elettronica
                    </a>
                    <a href="{{ route('esplora', ['categoria' => 'Casa']) }}"
                        class="hidden md:flex text-white text-base md:text-xl font-medium hover:underline decoration-white decoration-2 underline-offset-8 transition-all">
                        Articoli per la casa
                    </a>
                    <a href="{{ route('esplora', ['categoria' => 'Abbigliamento']) }}"
                        class="text-white text-base md:text-xl font-medium hover:underline decoration-white decoration-2 underline-offset-8 transition-all">
                        Abbigliamento
                    </a>
                    <a href="{{ route('esplora', ['categoria' => 'Veicoli']) }}"
                        class="text-white text-base md:text-xl font-medium hover:underline decoration-white decoration-2 underline-offset-8 transition-all">
                        Veicoli
                    </a>
                </div>
            </div>
        </div>

        <!-- Annunci Recenti -->
        @include('guest.partials.annunciRecenti')
    </div>
@endsection
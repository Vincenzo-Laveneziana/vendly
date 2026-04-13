@extends('frontoffice.master')

@section('title', 'Esplora Annunci')

@section('content')
    <div class="relative overflow-hidden z-0 min-h-screen bg-gray-50 py-8 md:py-12"
        style="font-family: 'Satoshi-Regular', sans-serif;">

        <!-- Bolle decorative (background) -->
        <img src="{{ asset('images/blob_02.png') }}" alt=""
            class="absolute -z-10 bottom-0 left-0 w-64 md:w-[600px] pointer-events-none -translate-x-1/4 translate-y-1/4 opacity-80">
        <img src="{{ asset('images/blob_02.png') }}" alt=""
            class="absolute -z-10 top-0 right-0 w-64 md:w-[600px] pointer-events-none translate-x-1/4 -translate-y-1/4 opacity-80">

        <div class="max-w-7xl mx-auto px-4 md:px-6 w-full flex flex-col lg:flex-row gap-6 relative z-10">

            {{-- COLONNA SINISTRA: FILTRI --}}
            <div class="w-full lg:w-[300px] flex-shrink-0 vue-island">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">

                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-black text-gray-900">Filtri</h2>
                        <span class="material-symbols-outlined text-gray-400">tune</span>
                    </div>

                    <hr class="border-gray-100 mb-6">

                    <!-- Categorie -->
                    <collapsible class="mb-6 w-full" :default-open="true">
                        <collapsible-trigger
                            class="w-full flex items-center justify-between mb-3 text-sm font-bold text-gray-700 cursor-pointer [&[data-state=open]>span.icon]:rotate-180">
                            <span>Categorie</span>
                            <span
                                class="icon material-symbols-outlined text-gray-400 text-sm transition-transform duration-200">expand_more</span>
                        </collapsible-trigger>
                        <collapsible-content
                            class="data-[state=closed]:animate-collapsible-up data-[state=open]:animate-collapsible-down overflow-hidden">
                            <div class="max-h-40 overflow-y-auto pr-2 custom-scrollbar space-y-3 pt-2 pb-2">
                                @foreach($categories as $id => $name)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" value="{{ $id }}"
                                                class="category-checkbox peer appearance-none w-4 h-4 border-2 border-gray-200 rounded-sm checked:bg-[#08B2B4] checked:border-[#08B2B4] transition-all cursor-pointer">
                                            <span
                                                class="material-symbols-outlined absolute text-white text-[12px] opacity-0 peer-checked:opacity-100 pointer-events-none font-bold">check</span>
                                        </div>
                                        <span
                                            class="text-sm text-gray-500 group-hover:text-gray-800 transition-colors">{{ $name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </collapsible-content>
                    </collapsible>

                    <hr class="border-gray-100 mb-6">

                    <!-- Prezzo -->
                    <collapsible class="mb-6 w-full text" :default-open="true">
                        <collapsible-trigger
                            class="w-full flex items-center justify-between mb-4 text-sm font-bold text-gray-700 cursor-pointer [&[data-state=open]>span.icon]:rotate-180">
                            <span>Prezzo</span>
                            <span
                                class="icon material-symbols-outlined text-gray-400 text-sm transition-transform duration-200">expand_more</span>
                        </collapsible-trigger>
                        <collapsible-content
                            class="data-[state=closed]:animate-collapsible-up data-[state=open]:animate-collapsible-down overflow-hidden w-full flex justify-center p-2">
                            <div class="px-1 mt-4 pb-2 w-full">
                                <!-- Range Slider Interattivo -->
                                <div id="priceSlider" class="relative w-full h-6 mb-6 select-none">
                                    <div class="absolute -translate-y-1/2 left-0 right-0 h-1 bg-gray-200 rounded-full">
                                    </div>
                                    <div id="sliderRange" class="absolute -translate-y-1/2 h-1 bg-[#08B2B4] rounded-full">
                                    </div>
                                    <div id="thumbMin"
                                        class="absolute top-1 -translate-y-1/2 w-5 h-5 bg-white border-2 border-[#08B2B4] rounded-full cursor-pointer shadow-md z-10 hover:scale-110 transition-transform"
                                        s tyle="left: 10%"></div>
                                    <div id="thumbMax"
                                        class="absolute top-1 -translate-y-1/2 w-5 h-5 bg-white border-2 border-[#08B2B4] rounded-full cursor-pointer shadow-md z-10 hover:scale-110 transition-transform"
                                        style="left: 60%"></div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="text-center">
                                        <span class="text-xs text-gray-500 mr-1">€</span>
                                        <input type="text" id="priceMin" value="50"
                                            class="w-14 text-sm font-bold text-gray-800 bg-transparent border-b-2 border-gray-200 focus:border-[#08B2B4] outline-none text-center pb-1">
                                    </div>
                                    <div class="text-center">
                                        <span class="text-xs text-gray-500 mr-1">€</span>
                                        <input type="text" id="priceMax" value="500"
                                            class="w-14 text-sm font-bold text-gray-800 bg-transparent border-b-2 border-gray-200 focus:border-[#08B2B4] outline-none text-center pb-1">
                                    </div>
                                </div>
                            </div>
                        </collapsible-content>
                    </collapsible>

                    <hr class="border-gray-100 mb-6">

                    <!-- Località -->
                    <div>
                        <div class="flex items-center justify-between mb-3 text-sm font-bold text-gray-700">
                            <span>Località</span>
                        </div>
                        <div class="relative group flex justify-center">
                            <input type="text" id="locationInput" placeholder="Cerca.."
                                class="w-full pl-3 pr-8 py-2 text-sm font-medium border border-gray-200 rounded-lg text-gray-700 outline-none focus:border-[#08B2B4]">
                            <span id="clearLocation"
                                class="material-symbols-outlined absolute top-8 -translate-y-1/2 right-3 text-gray-400 text-lg transition-colors hover:text-red-400 cursor-pointer hidden">close</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- COLONNA DESTRA: PRODOTTI --}}
            <div class="w-full lg:flex-1 flex flex-col gap-4">
                <div id="productsContainer" class="flex flex-col gap-4">
                    @forelse($products as $product)
                        @include('frontoffice.partials.cardProdotto', ['product' => $product])
                    @empty
                    @endforelse
                </div>

                <!-- Messaggio vuoto -->
                <div id="noResults"
                    class="w-full text-center py-20 bg-white shadow-sm border border-gray-100 rounded-2xl hidden">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-4">search_off</span>
                    <p class="text-gray-500 font-medium">Nessun annuncio trovato con questi filtri.</p>
                </div>

                <!-- Paginazione JS -->
                <div id="paginationContainer" class="mt-6 flex justify-center items-center gap-2 select-none"></div>
            </div>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #E5E7EB;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #D1D5DB;
        }

        .page-btn {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            border: 1px solid #E5E7EB;
            background: white;
            color: #374151;
        }

        .page-btn:hover {
            border-color: #08B2B4;
            color: #08B2B4;
        }

        .page-btn.active {
            background: #08B2B4;
            color: white;
            border-color: #08B2B4;
        }

        .page-btn.disabled {
            opacity: .4;
            pointer-events: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ============ CONFIGURAZIONE ============
            const ITEMS_PER_PAGE = 8;
            const PRICE_MAX_LIMIT = 500;

            // ============ ELEMENTI DOM ============
            const allCards = Array.from(document.querySelectorAll('.product-card'));
            const productsContainer = document.getElementById('productsContainer');
            const noResults = document.getElementById('noResults');
            const paginationContainer = document.getElementById('paginationContainer');
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
            const priceMinInput = document.getElementById('priceMin');
            const priceMaxInput = document.getElementById('priceMax');
            const locationInput = document.getElementById('locationInput');
            const clearLocation = document.getElementById('clearLocation');

            // Slider elements
            const sliderTrack = document.getElementById('priceSlider');
            const sliderRange = document.getElementById('sliderRange');
            const thumbMin = document.getElementById('thumbMin');
            const thumbMax = document.getElementById('thumbMax');

            let currentPage = 1;
            let filteredCards = [...allCards];

            // ============ FILTRO PRINCIPALE ============
            function applyFilters() {
                // Categorie selezionate
                const selectedCategories = Array.from(categoryCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                // Range prezzo
                const minPrice = parseFloat(priceMinInput.value) || 0;
                const maxPrice = parseFloat(priceMaxInput.value) || PRICE_MAX_LIMIT;

                // Località
                const locationQuery = locationInput.value.toLowerCase().trim();

                // Filtra
                filteredCards = allCards.filter(card => {
                    const cardCategory = card.getAttribute('data-category');
                    const cardPrice = parseFloat(card.getAttribute('data-price')) || 0;
                    const cardLocation = card.getAttribute('data-location') || '';
                    const cardName = card.getAttribute('data-name') || '';

                    // Filtro categoria
                    if (selectedCategories.length > 0 && !selectedCategories.includes(cardCategory)) {
                        return false;
                    }

                    // Filtro prezzo
                    if (cardPrice < minPrice || cardPrice > maxPrice) {
                        return false;
                    }

                    // Filtro località (cerca anche nel titolo)
                    if (locationQuery && !cardLocation.includes(locationQuery) && !cardName.includes(locationQuery)) {
                        return false;
                    }

                    return true;
                });

                currentPage = 1;
                renderPage();
            }

            // ============ PAGINAZIONE ============
            function renderPage() {
                const totalPages = Math.ceil(filteredCards.length / ITEMS_PER_PAGE) || 1;
                if (currentPage > totalPages) currentPage = totalPages;
                const start = (currentPage - 1) * ITEMS_PER_PAGE;
                const end = start + ITEMS_PER_PAGE;

                // Nascondi tutte le card
                allCards.forEach(c => c.style.display = 'none');

                // Mostra solo la pagina corrente
                const pageCards = filteredCards.slice(start, end);
                pageCards.forEach(c => c.style.display = 'flex');

                // Messaggio vuoto
                noResults.classList.toggle('hidden', filteredCards.length > 0);

                // Render paginazione
                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                paginationContainer.innerHTML = '';
                if (totalPages <= 1) return;

                // Freccia precedente
                const prevBtn = createPageBtn('chevron_left', currentPage <= 1);
                prevBtn.addEventListener('click', () => { if (currentPage > 1) { currentPage--; renderPage(); } });
                paginationContainer.appendChild(prevBtn);

                // Numeri di pagina
                const pages = getPageNumbers(currentPage, totalPages);
                pages.forEach(p => {
                    if (p === '...') {
                        const ellipsis = document.createElement('span');
                        ellipsis.textContent = '...';
                        ellipsis.className = 'px-1 text-gray-400 font-bold text-sm';
                        paginationContainer.appendChild(ellipsis);
                    } else {
                        const btn = document.createElement('button');
                        btn.textContent = p;
                        btn.className = `page-btn ${p === currentPage ? 'active' : ''}`;
                        btn.addEventListener('click', () => { currentPage = p; renderPage(); });
                        paginationContainer.appendChild(btn);
                    }
                });

                // Freccia successiva
                const nextBtn = createPageBtn('chevron_right', currentPage >= totalPages);
                nextBtn.addEventListener('click', () => { if (currentPage < totalPages) { currentPage++; renderPage(); } });
                paginationContainer.appendChild(nextBtn);
            }

            function createPageBtn(icon, disabled) {
                const btn = document.createElement('button');
                btn.innerHTML = `<span class="material-symbols-outlined text-base">${icon}</span>`;
                btn.className = `page-btn ${disabled ? 'disabled' : ''}`;
                return btn;
            }

            function getPageNumbers(current, total) {
                if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1);
                const pages = [];
                pages.push(1);
                if (current > 3) pages.push('...');
                for (let i = Math.max(2, current - 1); i <= Math.min(total - 1, current + 1); i++) {
                    pages.push(i);
                }
                if (current < total - 2) pages.push('...');
                pages.push(total);
                return pages;
            }

            // ============ SLIDER PREZZO INTERATTIVO ============
            let dragging = null;
            let sliderMin = 0;
            let sliderMax = PRICE_MAX_LIMIT;

            function updateSliderUI() {
                const trackWidth = sliderTrack.offsetWidth;
                const minPercent = (sliderMin / PRICE_MAX_LIMIT) * 100;
                const maxPercent = (sliderMax / PRICE_MAX_LIMIT) * 100;

                thumbMin.style.left = `calc(${minPercent}% - 10px)`;
                thumbMax.style.left = `calc(${maxPercent}% - 10px)`;
                sliderRange.style.left = `${minPercent}%`;
                sliderRange.style.width = `${maxPercent - minPercent}%`;

                priceMinInput.value = Math.round(sliderMin);
                priceMaxInput.value = Math.round(sliderMax);
            }

            function getSliderValue(clientX) {
                const rect = sliderTrack.getBoundingClientRect();
                let percent = (clientX - rect.left) / rect.width;
                percent = Math.max(0, Math.min(1, percent));
                return Math.round(percent * PRICE_MAX_LIMIT / 10) * 10; // snap a step di 10
            }

            function onPointerDown(e, thumb) {
                e.preventDefault();
                dragging = thumb;
                document.addEventListener('pointermove', onPointerMove);
                document.addEventListener('pointerup', onPointerUp);
            }

            function onPointerMove(e) {
                if (!dragging) return;
                const val = getSliderValue(e.clientX);
                if (dragging === 'min') {
                    sliderMin = Math.min(val, sliderMax - 10);
                } else {
                    sliderMax = Math.max(val, sliderMin + 10);
                }
                updateSliderUI();
            }

            function onPointerUp() {
                dragging = null;
                document.removeEventListener('pointermove', onPointerMove);
                document.removeEventListener('pointerup', onPointerUp);
                applyFilters();
            }

            thumbMin.addEventListener('pointerdown', e => onPointerDown(e, 'min'));
            thumbMax.addEventListener('pointerdown', e => onPointerDown(e, 'max'));

            // Sync input text -> slider
            priceMinInput.addEventListener('change', () => {
                sliderMin = Math.max(0, Math.min(parseInt(priceMinInput.value) || 0, sliderMax - 10));
                updateSliderUI();
                applyFilters();
            });
            priceMaxInput.addEventListener('change', () => {
                sliderMax = Math.min(PRICE_MAX_LIMIT, Math.max(parseInt(priceMaxInput.value) || PRICE_MAX_LIMIT, sliderMin + 10));
                updateSliderUI();
                applyFilters();
            });

            // Init slider
            sliderMin = 0;
            sliderMax = PRICE_MAX_LIMIT;
            updateSliderUI();

            // ============ EVENTI FILTRI ============
            categoryCheckboxes.forEach(cb => cb.addEventListener('change', applyFilters));

            locationInput.addEventListener('input', function () {
                clearLocation.classList.toggle('hidden', this.value.length === 0);
                applyFilters();
            });

            clearLocation.addEventListener('click', function () {
                locationInput.value = '';
                clearLocation.classList.add('hidden');
                applyFilters();
            });

            // ============ INIT ============
            applyFilters();
        });
    </script>
@endsection
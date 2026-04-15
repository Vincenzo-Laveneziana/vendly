@extends('frontoffice.master')

@section('title', 'Esplora Annunci')

@section('content')

    <div class="relative overflow-hidden z-0 min-h-screen bg-[#F3F4F6] py-0 md:py-0">

        {{-- HERO SECTION --}}
        <div class="relative w-full h-[400px] md:h-[500px] flex items-start justify-end bg-cover bg-center overflow-hidden p-8 md:p-12 lg:p-16"
            style="background-image: url('{{ asset('images/explore.jpg') }}')">

            <div class="relative z-10 max-w-4xl text-right mr-10">
                <h1 class="text-3xl md:text-4xl lg:text-5xl text-vendly font-black uppercase drop-shadow-2xl leading-none">
                    {{ __('message.hero_slogan_explore') }}
                </h1>
            </div>
        </div>

        {{-- BANNER CYAN --}}
        <div class="w-full bg-[#08B2B4] py-6 shadow-md">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-white text-base md:text-[32px] text-vendly uppercase" style="color: white">
                    {{ __('message.explore_text') }}
                </p>
            </div>
        </div>

        {{-- TOP BAR: FILTRI --}}
        <div class="bg-white border-b border-gray-200 vue-island">
            <div class="max-w-full mx-auto px-4 md:px-6 py-4 flex flex-wrap items-center justify-center gap-0">

                <!-- Categoria -->
                <div class="flex flex-col gap-2 pr-8 min-w-[280px]">
                    <label class="text-sm font-bold text-gray-800">{{ __('Categoria') }}</label>
                    <div class="relative flex items-center">
                        <select id="categorySelect"
                            class="w-full h-11 pl-4 pr-10 text-[15px] text-gray-700 border border-gray-200 rounded-xl outline-none focus:border-gray-300 appearance-none bg-white transition-all cursor-pointer">
                            <option value="">{{ __('Seleziona una categoria') }}</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ __('categories.' . $name) }}</option>
                            @endforeach
                        </select>
                        <span
                            class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none text-xl">expand_more</span>
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-12 w-[1px] bg-gray-100 hidden lg:block mr-8"></div>

                <!-- Località -->
                <div class="flex flex-col gap-2 pr-8 min-w-[280px]">
                    <label class="text-sm font-bold text-gray-800">{{ __('Località') }}</label>
                    <div class="relative">
                        <input id="locationInput" type="text" placeholder="{{ __('Tutte le città') }}"
                            class="w-full h-11 pl-4 pr-10 text-[15px] border border-gray-200 rounded-xl outline-none focus:border-gray-300 bg-white" />
                        <span id="clearLocation"
                            class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500 cursor-pointer hidden text-xl">close</span>
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-12 w-[1px] bg-gray-100 hidden lg:block mr-8"></div>

                <!-- Prezzo Slider -->
                <div class="flex flex-col gap-2 pr-8 min-w-[240px]">
                    <label class="text-sm font-bold text-gray-800">{{ __('Prezzo') }}</label>
                    <div class="px-2 pt-3 pb-0">
                        <div id="priceSlider" class="relative w-full h-[6px] bg-gray-200 rounded-full mb-3">
                            <div id="sliderRange" class="absolute h-full bg-[#08B2B4] rounded-full"></div>
                            <div id="thumbMin"
                                class="absolute -top-[5px] w-4 h-4 bg-white border-2 border-[#08B2B4] rounded-full cursor-pointer z-10">
                            </div>
                            <div id="thumbMax"
                                class="absolute -top-[5px] w-4 h-4 bg-white border-2 border-[#08B2B4] rounded-full cursor-pointer z-10">
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm font-bold text-gray-900 px-4">
                            <span>{{ __('message.money') }} <span id="priceMinLabel">0</span></span>
                            <span>{{ __('message.money') }} <span id="priceMaxLabel">500</span></span>
                        </div>
                        <input type="hidden" id="priceMin" value="0">
                        <input type="hidden" id="priceMax" value="500">
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-12 w-[1px] bg-gray-100 hidden lg:block mr-10"></div>

                <!-- Ordina Crescente -->
                <div class="flex items-center gap-3 pr-8">
                    <span class="text-sm font-semibold text-gray-900">{{ __('Prezzo crescente') }}</span>
                    <button id="sortAsc"
                        class="w-10 h-10 flex items-center justify-center border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <span class="material-symbols-outlined text-gray-600 text-[20px]">sort</span>
                    </button>
                </div>

                <!-- Divider opzionale -->
                <div class="h-12 w-[1px] bg-gray-100 hidden lg:block mr-8"></div>

                <!-- Ordina Decrescente -->
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-gray-900">{{ __('Prezzo decrescente') }}</span>
                    <button id="sortDesc"
                        class="w-10 h-10 flex items-center justify-center border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <span class="material-symbols-outlined text-gray-600 text-[20px]">sort</span>
                    </button>
                </div>

            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 w-full py-8 md:py-12 relative z-10">

            {{-- PRODOTTI GRID --}}
            <div id="productsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    @include('frontoffice.partials.cardProdotto', ['product' => $product])
                @empty
                @endforelse
            </div>

            <!-- Messaggio vuoto -->
            <div id="noResults"
                class="w-full text-center py-24 bg-white shadow-sm border border-gray-100 rounded-3xl hidden">
                <span class="material-symbols-outlined text-6xl text-gray-200 mb-4">search_off</span>
                <h3 class="text-xl font-black text-gray-900 mb-2">{{ __('Nessun risultato') }}</h3>
                <p class="text-gray-400 font-medium">{{ __('message.no_ads_found_filters') }}</p>
            </div>

            <!-- Paginazione JS -->
            <div id="paginationContainer" class="mt-12 flex justify-center items-center gap-2 select-none"></div>

        </div>
    </div>

    <style>
        .sort-active {
            border-color: #08B2B4 !important;
            background-color: #f0fdfa !important;
        }

        .sort-active span {
            color: #08B2B4 !important;
        }

        .page-btn {
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            border: 1px solid #E5E7EB;
            background: white;
            color: #111827;
            transition: all 0.2s;
        }

        .page-btn.active {
            background: #08B2B4;
            color: white;
            border-color: #08B2B4;
        }

        .page-btn.disabled {
            opacity: 0.3;
            pointer-events: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ITEMS_PER_PAGE = 12;
            const PRICE_MAX_LIMIT = 500;

            const allCards = Array.from(document.querySelectorAll('.product-card'));
            const productsContainer = document.getElementById('productsContainer');
            const noResults = document.getElementById('noResults');
            const paginationContainer = document.getElementById('paginationContainer');

            const categorySelect = document.getElementById('categorySelect');
            const locationInput = document.getElementById('locationInput');
            const priceMinHidden = document.getElementById('priceMin');
            const priceMaxHidden = document.getElementById('priceMax');
            const priceMinLabel = document.getElementById('priceMinLabel');
            const priceMaxLabel = document.getElementById('priceMaxLabel');
            const clearLocation = document.getElementById('clearLocation');

            const sortAscBtn = document.getElementById('sortAsc');
            const sortDescBtn = document.getElementById('sortDesc');

            const sliderTrack = document.getElementById('priceSlider');
            const sliderRange = document.getElementById('sliderRange');
            const thumbMin = document.getElementById('thumbMin');
            const thumbMax = document.getElementById('thumbMax');

            let currentPage = 1;
            let filteredCards = [...allCards];
            let currentSort = null;

            function applyFilters() {
                const selectedCategory = categorySelect.value;
                const minPrice = parseFloat(priceMinHidden.value) || 0;
                const maxPrice = parseFloat(priceMaxHidden.value) || PRICE_MAX_LIMIT;
                const locationQuery = locationInput.value.toLowerCase().trim();

                filteredCards = allCards.filter(card => {
                    const cardCategory = card.getAttribute('data-category');
                    const cardPrice = parseFloat(card.getAttribute('data-price')) || 0;
                    const cardLocation = (card.getAttribute('data-location') || '').toLowerCase();
                    const cardName = (card.getAttribute('data-name') || '').toLowerCase();

                    if (selectedCategory && cardCategory !== selectedCategory) return false;
                    if (cardPrice < minPrice || cardPrice > maxPrice) return false;
                    if (locationQuery && !cardLocation.includes(locationQuery) && !cardName.includes(locationQuery)) return false;

                    return true;
                });

                if (currentSort === 'asc') {
                    filteredCards.sort((a, b) => parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price')));
                } else if (currentSort === 'desc') {
                    filteredCards.sort((a, b) => parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price')));
                }

                currentPage = 1;
                renderPage();
            }

            function renderPage() {
                const totalPages = Math.ceil(filteredCards.length / ITEMS_PER_PAGE) || 1;
                if (currentPage > totalPages) currentPage = totalPages;
                const start = (currentPage - 1) * ITEMS_PER_PAGE;
                const end = start + ITEMS_PER_PAGE;

                // 1. Prendi le card della pagina corrente
                const pageCards = filteredCards.slice(start, end);

                // 2. Nascondi tutto
                allCards.forEach(c => {
                    c.classList.add('hidden');
                    c.style.display = 'none';
                });

                // 3. Re-appendi le card nell'ordine corretto al contenitore e mostrale
                pageCards.forEach(c => {
                    c.classList.remove('hidden');
                    c.style.display = 'flex';
                    productsContainer.appendChild(c);
                });

                noResults.classList.toggle('hidden', filteredCards.length > 0);
                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                paginationContainer.innerHTML = '';
                if (totalPages <= 1) return;

                const prevBtn = createPageBtn('chevron_left', currentPage <= 1);
                prevBtn.onclick = () => { if (currentPage > 1) { currentPage--; renderPage(); window.scrollTo({ top: 0, behavior: 'smooth' }); } };
                paginationContainer.appendChild(prevBtn);

                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    btn.className = `page-btn ${i === currentPage ? 'active' : ''}`;
                    btn.onclick = () => { currentPage = i; renderPage(); window.scrollTo({ top: 0, behavior: 'smooth' }); };
                    paginationContainer.appendChild(btn);
                }

                const nextBtn = createPageBtn('chevron_right', currentPage >= totalPages);
                nextBtn.onclick = () => { if (currentPage < totalPages) { currentPage++; renderPage(); window.scrollTo({ top: 0, behavior: 'smooth' }); } };
                paginationContainer.appendChild(nextBtn);
            }

            function createPageBtn(icon, disabled) {
                const btn = document.createElement('button');
                btn.innerHTML = `<span class="material-symbols-outlined">${icon}</span>`;
                btn.className = `page-btn ${disabled ? 'disabled' : ''}`;
                return btn;
            }

            let dragging = null;
            let sliderMin = 0;
            let sliderMax = PRICE_MAX_LIMIT;

            function updateSliderUI() {
                const trackWidth = sliderTrack.offsetWidth;
                const minPercent = (sliderMin / PRICE_MAX_LIMIT) * 100;
                const maxPercent = (sliderMax / PRICE_MAX_LIMIT) * 100;

                thumbMin.style.left = `calc(${minPercent}% - 8px)`;
                thumbMax.style.left = `calc(${maxPercent}% - 8px)`;
                sliderRange.style.left = `${minPercent}%`;
                sliderRange.style.width = `${maxPercent - minPercent}%`;

                priceMinLabel.textContent = Math.round(sliderMin);
                priceMaxLabel.textContent = Math.round(sliderMax);
                priceMinHidden.value = Math.round(sliderMin);
                priceMaxHidden.value = Math.round(sliderMax);
            }

            function getSliderValue(clientX) {
                const rect = sliderTrack.getBoundingClientRect();
                let percent = (clientX - rect.left) / rect.width;
                percent = Math.max(0, Math.min(1, percent));
                return Math.round(percent * PRICE_MAX_LIMIT / 5) * 5;
            }

            function onPointerMove(e) {
                if (!dragging) return;
                const val = getSliderValue(e.clientX);
                if (dragging === 'min') sliderMin = Math.min(val, sliderMax - 5);
                else sliderMax = Math.max(val, sliderMin + 5);
                updateSliderUI();
            }

            function onPointerUp() {
                if (dragging) {
                    dragging = null;
                    applyFilters();
                }
                document.removeEventListener('pointermove', onPointerMove);
                document.removeEventListener('pointerup', onPointerUp);
            }

            thumbMin.onpointerdown = e => { dragging = 'min'; document.addEventListener('pointermove', onPointerMove); document.addEventListener('pointerup', onPointerUp); };
            thumbMax.onpointerdown = e => { dragging = 'max'; document.addEventListener('pointermove', onPointerMove); document.addEventListener('pointerup', onPointerUp); };

            categorySelect.onchange = applyFilters;
            locationInput.oninput = function () {
                clearLocation.classList.toggle('hidden', this.value.length === 0);
                applyFilters();
            };
            clearLocation.onclick = () => { locationInput.value = ''; clearLocation.classList.add('hidden'); applyFilters(); };

            sortAscBtn.onclick = () => {
                currentSort = (currentSort === 'asc' ? null : 'asc');
                sortAscBtn.classList.toggle('sort-active', currentSort === 'asc');
                sortDescBtn.classList.remove('sort-active');
                applyFilters();
            };

            sortDescBtn.onclick = () => {
                currentSort = (currentSort === 'desc' ? null : 'desc');
                sortDescBtn.classList.toggle('sort-active', currentSort === 'desc');
                sortAscBtn.classList.remove('sort-active');
                applyFilters();
            };

            updateSliderUI();
            applyFilters();
        });
    </script>
@endsection
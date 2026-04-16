@extends('frontoffice.master')

@section('title', 'Esplora Annunci')

@section('content')

    <div class="relative overflow-hidden z-0 min-h-screen bg-[#F3F4F6] py-0 md:py-0">

        {{-- HERO SECTION --}}
        <div class="relative w-full h-[400px] md:h-[500px] flex items-start justify-end bg-cover bg-center overflow-hidden p-8 md:p-12 lg:p-16"
            style="background-image: url('{{ asset('images/explore.webp') }}')">

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
        <div class="bg-white border-b border-gray-200 vue-island relative z-20 shadow-sm md:shadow-none">
            <div
                class="max-w-full mx-auto px-4 md:px-6 py-4 flex flex-col lg:flex-row lg:flex-wrap items-stretch lg:items-center justify-start lg:justify-center gap-5 lg:gap-0">

                <!-- Categoria -->
                <div class="flex flex-col gap-2 w-full lg:w-auto min-w-[220px] xl:min-w-[280px] lg:pr-8">
                    <label class="text-sm font-semibold text-gray-800 lg:font-normal">{{ __('message.category') }}</label>
                    <div class="relative flex items-center">
                        <select id="categorySelect"
                            class="w-full h-11 pl-4 pr-10 text-[15px] text-gray-700 border border-gray-200 rounded-xl outline-none focus:border-vendly focus:ring-4 focus:ring-vendly/10 appearance-none bg-white transition-all cursor-pointer shadow-sm">
                            <option value="">{{ __('message.choose_category') }}</option>
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
                <div class="flex flex-col gap-2 w-full lg:w-auto min-w-[220px] xl:min-w-[280px] lg:pr-8">
                    <label class="text-sm font-semibold text-gray-800 lg:font-normal">{{ __('message.location') }}</label>
                    <div class="relative">
                        <div class="vue-island">
                            <ui-input id="locationInput" type="text" placeholder="{{ __('message.all_cities') }}"
                                class="pr-10" />
                        </div>
                        <span id="clearLocation"
                            class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500 cursor-pointer hidden text-xl z-20">close</span>
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-12 w-[1px] bg-gray-100 hidden lg:block mr-8"></div>

                <!-- Prezzo Slider -->
                <div class="flex flex-col gap-2 w-full lg:w-auto min-w-[240px] xl:min-w-[280px] lg:pr-8">
                    <label
                        class="text-sm font-semibold text-gray-800 lg:font-normal">{{ __('message.price_filter') }}</label>
                    <div class="px-2 pt-3 pb-0">
                        <div class="vue-island">
                            <ui-slider :model-value="[0, 500]" :max="500" :step="5" class="py-4"
                                @update:model-value="val => { window.updatePriceRange(val[0], val[1]) }" />
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-900 px-2 font-medium">
                            <span>{{ __('message.money') }} <span id="priceMinLabel">0</span></span>
                            <span>{{ __('message.money') }} <span id="priceMaxLabel">500</span></span>
                        </div>
                        <input type="hidden" id="priceMin" value="0">
                        <input type="hidden" id="priceMax" value="500">
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-12 w-[1px] bg-gray-100 hidden lg:block mr-8"></div>
                <!-- Ordina Container -->
                <div class="flex flex-row items-center gap-4 w-full lg:w-auto md:w-auto lg:pr-0 vue-island">
                    <ui-button id="sortAsc" variant="outline" size="sm"
                        class="flex-1 lg:flex-none uppercase text-[11px] font-bold h-11 px-4 gap-2">
                        <span class="material-symbols-outlined text-gray-600 text-[20px]">arrow_upward</span>
                        {{ __('message.price_ascending') }}
                    </ui-button>

                    <ui-button id="sortDesc" variant="outline" size="sm"
                        class="flex-1 lg:flex-none uppercase text-[11px] font-bold h-11 px-4 gap-2">
                        <span class="material-symbols-outlined text-gray-600 text-[20px]">arrow_downward</span>
                        {{ __('message.price_descending') }}
                    </ui-button>
                </div>

            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 w-full py-8 md:py-12 relative z-10">

            <!-- Riassunto Filtri -->
            <div id="filtersSummaryContainer" class="hidden mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-semibold text-gray-800">{{ __('message.filters') }}</h3>
                    <a href="/esplora"
                        class="text-sm text-vendly font-semibold hover:underline flex items-center gap-1 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                        {{ __('message.reset_filters') }}
                    </a>
                </div>
                <div id="activeFiltersSummary" class="flex flex-wrap gap-2"></div>
            </div>

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
                <h3 class="text-xl font-black text-gray-900 mb-2">{{ __('message.no_ads_found') }}</h3>
                <p class="text-gray-400 font-medium">{{ __('message.no_ads_found_filters') }}</p>
                <div class="mt-6">
                    <a href="/esplora"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-bold transition-all">
                        <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                        {{ __('message.reset_filters') }}
                    </a>
                </div>
            </div>

            <!-- Paginazione JS -->
            <!-- Paginazione JS -->
            <div id="paginationContainer" class="mt-12 flex justify-center items-center gap-2 select-none vue-island"></div>

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

            window.removeFilter = function (type) {
                if (type === 'query') {
                    window.location.href = '{{ route("Frontoffice.ricerca") }}';
                } else if (type === 'category') {
                    categorySelect.value = '';
                    applyFilters();
                } else if (type === 'location') {
                    locationInput.value = '';
                    if (clearLocation) clearLocation.classList.add('hidden');
                    applyFilters();
                } else if (type === 'price') {
                    sliderMin = 0;
                    sliderMax = PRICE_MAX_LIMIT;
                    updateSliderUI();
                    applyFilters();
                } else if (type === 'sort') {
                    currentSort = null;
                    sortAscBtn.classList.remove('sort-active');
                    sortDescBtn.classList.remove('sort-active');
                    applyFilters();
                }
            };

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

                updateSummary();
                currentPage = 1;
                renderPage();
            }

            function updateSummary() {
                const summaryContainer = document.getElementById('filtersSummaryContainer');
                const activeContainer = document.getElementById('activeFiltersSummary');
                if (!summaryContainer || !activeContainer) return;

                const urlParams = new URLSearchParams(window.location.search);
                const query = urlParams.get('query');

                let summaryHTML = '';

                if (query) {
                    summaryHTML += `<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 rounded-full text-[13px] text-gray-700 shadow-sm">
                                                            <span class="material-symbols-outlined text-[16px] text-gray-400">search</span> 
                                                            <b>${query}</b>
                                                            <button onclick="window.removeFilter('query')" class="flex items-center justify-center ml-1 text-red-500 hover:text-red-700 transition-colors active:scale-90">
                                                                <span class="material-symbols-outlined text-[16px] font-bold">close</span>
                                                            </button>
                                                        </span>`;
                }

                if (categorySelect.value) {
                    const categoryText = categorySelect.options[categorySelect.selectedIndex].text;
                    summaryHTML += `<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 rounded-full text-[13px] text-gray-700 shadow-sm">
                                                            <span class="material-symbols-outlined text-[16px] text-gray-700">category</span> 
                                                            <b>${categoryText}</b>
                                                            <button onclick="window.removeFilter('category')" class="flex items-center justify-center ml-1 text-red-500 hover:text-red-700 transition-colors active:scale-90">
                                                                <span class="material-symbols-outlined text-[16px] font-bold">close</span>
                                                            </button>
                                                        </span>`;
                }

                if (locationInput.value.trim()) {
                    summaryHTML += `<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 rounded-full text-[13px] text-gray-700 shadow-sm">
                                                            <span class="material-symbols-outlined text-[16px] text-gray-700">location_on</span> 
                                                            <b>${locationInput.value}</b>
                                                            <button onclick="window.removeFilter('location')" class="flex items-center justify-center ml-1 text-red-500 hover:text-red-700 transition-colors active:scale-90">
                                                                <span class="material-symbols-outlined text-[16px] font-bold">close</span>
                                                            </button>
                                                        </span>`;
                }

                if (parseFloat(priceMinHidden.value) > 0 || parseFloat(priceMaxHidden.value) < PRICE_MAX_LIMIT) {
                    summaryHTML += `<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 rounded-full text-[13px] text-gray-700 shadow-sm">
                                                            <span class="material-symbols-outlined text-[16px] text-gray-700">payments</span> 
                                                            <b>€${priceMinHidden.value} - €${priceMaxHidden.value}</b>
                                                            <button onclick="window.removeFilter('price')" class="flex items-center justify-center ml-1 text-red-500 hover:text-red-700 transition-colors active:scale-90">
                                                                <span class="material-symbols-outlined text-[16px] font-bold">close</span>
                                                            </button>
                                                        </span>`;
                }

                if (currentSort === 'asc') {
                    summaryHTML += `<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 rounded-full text-[13px] text-gray-700 shadow-sm">
                                                            <span class="material-symbols-outlined text-[16px] text-gray-500">arrow_upward</span> 
                                                            <b>{{ __('message.price_ascending') }}</b>
                                                            <button onclick="window.removeFilter('sort')" class="flex items-center justify-center ml-1 text-red-500 hover:text-red-700 transition-colors active:scale-90">
                                                                <span class="material-symbols-outlined text-[16px] font-bold">close</span>
                                                            </button>
                                                        </span>`;
                } else if (currentSort === 'desc') {
                    summaryHTML += `<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 rounded-full text-[13px] text-gray-700 shadow-sm">
                                                            <span class="material-symbols-outlined text-[16px] text-gray-500">arrow_downward</span> 
                                                            <b>{{ __('message.price_descending') }}</b>
                                                            <button onclick="window.removeFilter('sort')" class="flex items-center justify-center ml-1 text-red-500 hover:text-red-700 transition-colors active:scale-90">
                                                                <span class="material-symbols-outlined text-[16px] font-bold">close</span>
                                                            </button>
                                                        </span>`;
                }

                if (summaryHTML === '') {
                    summaryContainer.classList.add('hidden');
                    activeContainer.innerHTML = '';
                } else {
                    activeContainer.innerHTML = summaryHTML;
                    summaryContainer.classList.remove('hidden');
                }
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

                paginationContainer.innerHTML = `
                                <ui-pagination :total="${filteredCards.length}" :items-per-page="${ITEMS_PER_PAGE}" :default-page="${currentPage}"
                                    @update:page="p => { window.onPageChange(p) }">
                                    <ui-pagination-content>
                                        <ui-pagination-prev />
                                        <ui-pagination-item v-for="p in ${totalPages}" :key="p">
                                            <ui-pagination-link :is-active="p === ${currentPage}" @click="window.onPageChange(p)">
                                                \${p}
                                            </ui-pagination-link>
                                        </ui-pagination-item>
                                        <ui-pagination-next />
                                    </ui-pagination-content>
                                </ui-pagination>
                            `;
            }

            window.onPageChange = function (p) {
                currentPage = p;
                renderPage();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };

            let dragging = null;
            let sliderMin = 0;
            let sliderMax = PRICE_MAX_LIMIT;

            window.updatePriceRange = function (min, max) {
                priceMinHidden.value = Math.round(min);
                priceMaxHidden.value = Math.round(max);
                priceMinLabel.textContent = Math.round(min);
                priceMaxLabel.textContent = Math.round(max);
                applyFilters();
            }

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
            applyFilters();
        });
    </script>
@endsection
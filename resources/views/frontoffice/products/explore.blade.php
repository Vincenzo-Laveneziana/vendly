@extends('master')

@section('title', 'Esplora Annunci')

@section('content')

    <div class="relative overflow-hidden z-0 min-h-screen bg-[#F8F9FA] py-0 md:py-0">

        {{-- NEW UNIFIED HERO BANNER --}}
        <div class="relative w-full bg-[#08B2B4] overflow-hidden">
            <div
                class="relative max-w-[1400px] mx-auto px-4 md:px-12 py-10 md:py-20 flex flex-row items-center justify-center gap-6 md:gap-24">
                <!-- Circle Image -->
                <div class="relative flex-shrink-0">
                    <div
                        class="w-28 h-28 md:w-60 md:h-60 rounded-full bg-white overflow-hidden border-[4px] md:border-[8px] border-white/20 shadow-2xl">
                        <img src="{{ asset('images/explore.webp') }}" alt="Inspiration" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Text Content -->
                <div class="text-left max-w-3xl md:max-w-full">
                    <h1 class="text-vendly text-md md:text-4xl lg:text-[42px] font-black uppercase" style="color:white">
                        {{ __('message.hero_slogan_explore') }}
                        {{ __('message.explore_text') }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- FILTERS SECTION --}}
        <div class="bg-white border-b border-gray-100 relative z-20">
            <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
                <!-- Hidden Inputs (Moved outside collapsible to be always accessible) -->
                <input type="hidden" id="categorySelect" value="">
                <input type="hidden" id="sortSelect" value="">
                <input type="hidden" id="priceMin" value="0">
                <input type="hidden" id="priceMax" value="1000">

                <div class="vue-island">
                    <collapsible>
                        <!-- Search Bar + Tune Button (Trigger) - Hidden on Desktop -->
                        <div class="flex md:hidden items-center gap-3 mb-0">
                            <div class="relative flex-1">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                                <input type="text" id="mobileSearchInput" placeholder="Cerca prodotti..."
                                    class="w-full h-12 pl-10 pr-4 bg-gray-50 border-none rounded-lg text-sm outline-none focus:ring-0">
                            </div>
                            <collapsible-trigger as-child>
                                <button
                                    class="w-12 h-12 flex items-center justify-center border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-all">
                                    <span class="material-symbols-outlined">tune</span>
                                </button>
                            </collapsible-trigger>
                        </div>

                        <!-- Expandable Filters - Always visible on md+ -->
                        <collapsible-content force-mount
                            class="overflow-hidden md:!block data-[state=closed]:hidden data-[state=open]:animate-collapsible-down">
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-0 md:pt-0 pt-8">

                                <!-- Categoria -->
                                <div class="flex flex-col gap-2 w-full md:flex-1 md:pr-6">
                                    <label class="text-sm font-bold text-gray-900">{{ __('message.category') }}</label>
                                    <ui-dropdown-menu>
                                        <ui-dropdown-menu-trigger as-child>
                                            <ui-button variant="outline"
                                                class="w-full justify-between font-normal h-11 border-gray-200 rounded-lg text-sm text-gray-600 bg-white hover:bg-gray-50 transition-all">
                                                <span id="categoryLabel">{{ __('message.choose_category') }}</span>
                                                <span class="material-symbols-outlined text-gray-400">expand_more</span>
                                            </ui-button>
                                        </ui-dropdown-menu-trigger>
                                        <ui-dropdown-menu-content
                                            class="bg-white border border-gray-100 shadow-xl rounded-lg z-[100]"
                                            style="width: var(--reka-dropdown-menu-trigger-width);">
                                            <ui-dropdown-menu-item
                                                @click="window.setCategory('', '{{ __('message.choose_category') }}')"
                                                class="px-4 py-2.5 text-sm hover:bg-[#08B2B4]/5 hover:text-[#08B2B4] cursor-pointer">
                                                {{ __('message.choose_category') }}
                                            </ui-dropdown-menu-item>
                                            @foreach($categories as $id => $name)
                                                <ui-dropdown-menu-item
                                                    @click="window.setCategory('{{ $id }}', '{{ __('categories.' . $name) }}')"
                                                    class="px-4 py-2.5 text-sm hover:bg-[#08B2B4]/5 hover:text-[#08B2B4] cursor-pointer">
                                                    {{ __('categories.' . $name) }}
                                                </ui-dropdown-menu-item>
                                            @endforeach
                                        </ui-dropdown-menu-content>
                                    </ui-dropdown-menu>
                                </div>

                                <div class="hidden md:block w-[1px] h-10 bg-gray-100 mx-6"></div>

                                <!-- Località -->
                                <div class="flex flex-col gap-2 w-full md:flex-1 md:pr-6">
                                    <label class="text-sm font-bold text-gray-900">{{ __('message.location') }}</label>
                                    <div class="relative">
                                        <input type="text" id="locationInput" placeholder="{{ __('message.all_cities') }}"
                                            class="w-full h-11 pl-4 pr-10 text-sm text-gray-600 border border-gray-200 rounded-lg outline-none focus:border-vendly focus:ring-1 focus:ring-vendly/20">
                                        <span id="clearLocation"
                                            class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500 cursor-pointer hidden">close</span>
                                    </div>
                                </div>

                                <div class="hidden md:block w-[1px] h-10 bg-gray-100 mx-6"></div>

                                <!-- Ordina per -->
                                <div class="flex flex-col gap-2 w-full md:flex-1 md:pr-6">
                                    <label class="text-sm font-bold text-gray-900">Ordina per</label>
                                    <ui-dropdown-menu>
                                        <ui-dropdown-menu-trigger as-child>
                                            <ui-button variant="outline"
                                                class="w-full justify-between font-normal h-11 border-gray-200 rounded-lg text-sm text-gray-600 bg-white hover:bg-gray-50 transition-all">
                                                <span id="sortLabel">Scegli un filtro</span>
                                                <span class="material-symbols-outlined text-gray-400">expand_more</span>
                                            </ui-button>
                                        </ui-dropdown-menu-trigger>
                                        <ui-dropdown-menu-content
                                            class="bg-white border border-gray-100 shadow-xl rounded-lg z-[100]"
                                            style="width: var(--reka-dropdown-menu-trigger-width);">
                                            <ui-dropdown-menu-item @click="window.setSort('', 'Scegli un filtro')"
                                                class="px-4 py-2.5 text-sm hover:bg-[#08B2B4]/5 hover:text-[#08B2B4] cursor-pointer">
                                                Scegli un filtro
                                            </ui-dropdown-menu-item>
                                            <ui-dropdown-menu-item
                                                @click="window.setSort('asc', '{{ __('message.price_ascending') }}')"
                                                class="px-4 py-2.5 text-sm hover:bg-[#08B2B4]/5 hover:text-[#08B2B4] cursor-pointer">
                                                {{ __('message.price_ascending') }}
                                            </ui-dropdown-menu-item>
                                            <ui-dropdown-menu-item
                                                @click="window.setSort('desc', '{{ __('message.price_descending') }}')"
                                                class="px-4 py-2.5 text-sm hover:bg-[#08B2B4]/5 hover:text-[#08B2B4] cursor-pointer">
                                                {{ __('message.price_descending') }}
                                            </ui-dropdown-menu-item>
                                        </ui-dropdown-menu-content>
                                    </ui-dropdown-menu>
                                </div>

                                <div class="hidden md:block w-[1px] h-10 bg-gray-100 mx-6"></div>

                                <!-- Prezzo -->
                                <div class="flex flex-col gap-2 w-full md:flex-1">
                                    <label class="text-sm font-bold text-gray-900">{{ __('message.price_filter') }}</label>
                                    <div class="px-2">
                                        <div style="--primary: oklch(0.65 0.12 192);">
                                            <ui-slider :model-value="window.sliderState.priceRange" :max="1000" :min="0"
                                                :step="10" class="py-3"
                                                @update:model-value="val => { window.sliderState.priceRange = val; window.updatePriceRange(val[0], val[1]) }" />
                                        </div>
                                        <div class="flex items-center justify-between text-xs font-bold text-gray-900 mt-1">
                                            <span>€ <span id="priceMinLabel">0</span></span>
                                            <span>€ <span id="priceMaxLabel">1000</span></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </collapsible-content>
                    </collapsible>
                </div>
            </div>

            <!-- Active Filters Summary Bar -->
            <div id="filtersSummaryContainer" class="hidden bg-white border-t border-gray-100">
                <div
                    class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div id="activeFiltersSummary" class="flex flex-wrap gap-2">
                        <!-- Chips injected here -->
                    </div>
                    <button onclick="window.resetAllFilters()"
                        class="flex items-center gap-2 text-vendly font-bold uppercase text-xs tracking-wider hover:opacity-80 transition-all">
                        <span class="material-symbols-outlined text-lg">restart_alt</span>
                        RESET FILTRI
                    </button>
                </div>
            </div>
        </div>

        {{-- PRODUCTS SECTION --}}
        <div class="max-w-7xl mx-auto px-4 md:px-6 w-full py-8 md:py-12">

            <div id="productsContainer" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @forelse($products as $product)
                    @include('frontoffice.partials.cardProdotto', ['product' => $product])
                @empty
                @endforelse
            </div>

            <!-- Messaggio vuoto -->
            <div id="noResults"
                class="w-full text-center py-24 bg-white shadow-sm border border-gray-100 rounded-3xl hidden">
                <span class="material-symbols-outlined text-6xl text-gray-200 mb-4">search_off</span>
                <h3 class="text-xl font-black text-gray-900 mb-2">{{ __('message.no_sale_found') }}</h3>
                <p class="text-gray-400 font-medium">{{ __('message.no_sale_found_filters') }}</p>
                <div class="mt-6">
                    <button onclick="window.resetAllFilters()"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-bold transition-all">
                        <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                        {{ __('message.reset_filters') }}
                    </button>
                </div>
            </div>

            <div class="py-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ITEMS_PER_PAGE = 12;
            const PRICE_MAX_LIMIT = 1000;

            const allCards = Array.from(document.querySelectorAll('.product-card'));
            const productsContainer = document.getElementById('productsContainer');
            const noResults = document.getElementById('noResults');

            const categorySelect = document.getElementById('categorySelect');
            const locationInput = document.getElementById('locationInput');
            const sortSelect = document.getElementById('sortSelect');
            const priceMinHidden = document.getElementById('priceMin');
            const priceMaxHidden = document.getElementById('priceMax');
            const priceMinLabel = document.getElementById('priceMinLabel');
            const priceMaxLabel = document.getElementById('priceMaxLabel');
            const clearLocation = document.getElementById('clearLocation');
            const mobileSearchInput = document.getElementById('mobileSearchInput');

            let filteredCards = [...allCards];

            window.setCategory = function (id, label) {
                categorySelect.value = id;
                categorySelect.setAttribute('data-label', label);
                document.getElementById('categoryLabel').textContent = label;
                applyFilters();
            };

            window.setSort = function (id, label) {
                sortSelect.value = id;
                sortSelect.setAttribute('data-label', label);
                document.getElementById('sortLabel').textContent = label;
                applyFilters();
            };

            window.resetAllFilters = function () {
                window.setCategory('', '{{ __('message.choose_category') }}');
                locationInput.value = '';
                window.setSort('', 'Scegli un filtro');

                if (mobileSearchInput) mobileSearchInput.value = '';
                window.sliderState.priceRange = [0, PRICE_MAX_LIMIT];
                window.updatePriceRange(0, PRICE_MAX_LIMIT);
                applyFilters();
            };

            window.removeFilter = function (type) {
                if (type === 'query') {
                    window.location.href = '{{ route("Frontoffice.ricerca") }}';
                } else if (type === 'category') {
                    window.setCategory('', '{{ __('message.choose_category') }}');
                } else if (type === 'location') {
                    locationInput.value = '';
                    if (clearLocation) clearLocation.classList.add('hidden');
                } else if (type === 'price') {
                    window.sliderState.priceRange = [0, PRICE_MAX_LIMIT];
                    window.updatePriceRange(0, PRICE_MAX_LIMIT);
                } else if (type === 'sort') {
                    window.setSort('', 'Scegli un filtro');
                }
                applyFilters();
            };

            function applyFilters() {
                const selectedCategory = categorySelect.value;
                const minPrice = parseFloat(priceMinHidden.value) || 0;
                const maxPrice = parseFloat(priceMaxHidden.value) || PRICE_MAX_LIMIT;
                const locationQuery = locationInput.value.toLowerCase().trim();
                const mobileQuery = mobileSearchInput ? mobileSearchInput.value.toLowerCase().trim() : '';
                const currentSort = sortSelect.value;

                filteredCards = allCards.filter(card => {
                    const cardCategory = card.getAttribute('data-category');
                    const cardPrice = parseFloat(card.getAttribute('data-price')) || 0;
                    const cardLocation = (card.getAttribute('data-location') || '').toLowerCase();
                    const cardName = (card.getAttribute('data-name') || '').toLowerCase();

                    if (selectedCategory && cardCategory !== selectedCategory) return false;
                    if (cardPrice < minPrice || cardPrice > maxPrice) return false;
                    if (locationQuery && !cardLocation.includes(locationQuery) && !cardName.includes(locationQuery)) return false;
                    if (mobileQuery && !cardName.includes(mobileQuery)) return false;

                    return true;
                });

                if (currentSort === 'asc') {
                    filteredCards.sort((a, b) => parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price')));
                } else if (currentSort === 'desc') {
                    filteredCards.sort((a, b) => parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price')));
                }

                updateSummary();
                renderResults();
            }

            function renderResults() {
                allCards.forEach(card => card.classList.add('hidden'));

                if (filteredCards.length === 0) {
                    productsContainer.classList.add('hidden');
                    noResults.classList.remove('hidden');
                } else {
                    productsContainer.classList.remove('hidden');
                    noResults.classList.add('hidden');
                    filteredCards.forEach(card => {
                        productsContainer.appendChild(card);
                        card.classList.remove('hidden');
                    });
                }
            }

            function updateSummary() {
                const summaryContainer = document.getElementById('filtersSummaryContainer');
                const activeContainer = document.getElementById('activeFiltersSummary');
                if (!summaryContainer || !activeContainer) return;

                const urlParams = new URLSearchParams(window.location.search);
                const query = urlParams.get('query');

                let summaryHTML = '';

                if (query) {
                    summaryHTML += createChip('search', query, 'query');
                }

                if (categorySelect.value) {
                    const categoryText = categorySelect.getAttribute('data-label') || categorySelect.value;
                    summaryHTML += createChip('category', categoryText, 'category');
                }

                if (locationInput.value.trim()) {
                    summaryHTML += createChip('location_on', locationInput.value, 'location');
                }

                if (parseFloat(priceMinHidden.value) > 0 || parseFloat(priceMaxHidden.value) < PRICE_MAX_LIMIT) {
                    summaryHTML += createChip('payments', `{{__('message.from')}} ${priceMinHidden.value}€ {{__('message.to')}} ${priceMaxHidden.value}€`, 'price');
                }

                if (sortSelect.value) {
                    const sortText = sortSelect.getAttribute('data-label') || sortSelect.value;
                    summaryHTML += createChip(sortSelect.value === 'asc' ? 'arrow_upward' : 'arrow_downward', sortText, 'sort');
                }

                if (summaryHTML === '') {
                    summaryContainer.classList.add('hidden');
                    activeContainer.innerHTML = '';
                } else {
                    activeContainer.innerHTML = summaryHTML;
                    summaryContainer.classList.remove('hidden');
                }
            }

            function createChip(icon, text, type) {
                return `
                                                                                                                                                                                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white border border-vendly rounded-full text-[13px] text-green font-bold">
                                                                                                                                                                                        <span class="material-symbols-outlined text-[18px]">${icon}</span>
                                                                                                                                                                                        <span>${text}</span>
                                                                                                                                                                                        <button onclick="window.removeFilter('${type}')" class="flex items-center justify-center ml-1 hover:opacity-70 transition-all">
                                                                                                                                                                                            <span class="material-symbols-outlined text-[16px] font-bold">close</span>
                                                                                                                                                                                        </button>
                                                                                                                                                                                    </div>`;
            }

            window.updatePriceRange = function (min, max) {
                if (priceMinHidden) priceMinHidden.value = Math.round(min);
                if (priceMaxHidden) priceMaxHidden.value = Math.round(max);
                if (priceMinLabel) priceMinLabel.textContent = Math.round(min);
                if (priceMaxLabel) priceMaxLabel.textContent = Math.round(max);
                applyFilters();
            }

            locationInput.oninput = function () {
                clearLocation.classList.toggle('hidden', this.value.length === 0);
                applyFilters();
            };
            if (mobileSearchInput) mobileSearchInput.oninput = applyFilters;
            clearLocation.onclick = () => { locationInput.value = ''; clearLocation.classList.add('hidden'); applyFilters(); };

            applyFilters();
        });
    </script>
@endsection
@extends('master')

@section('title', 'Profilo')

@section('content')
    <!-- Profile Navigation Bar -->
    @include('backoffice.profile.partials.navBar')

    <div class="min-h-screen bg-gray-50 py-12" style="font-family: 'Satoshi-Regular', sans-serif;">

        <div class="max-w-7xl mx-auto my-6 px-4 md:px-8 pb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ __('message.your_orders') }}
                </h2>
            </div>

            <!-- Filter Bar -->
            <div class="mb-10">
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-100 p-2 flex flex-col md:flex-row items-center gap-2">
                    <!-- Search -->
                    <div
                        class="flex-grow flex items-center gap-3 px-5 py-2.5 bg-gray-50/50 rounded-xl border border-gray-100/50 focus-within:border-primary/30 focus-within:bg-white transition-all w-full md:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-gray-400">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                        <input type="text" id="orderSearch" placeholder="{{ __('message.search_order') }}"
                            class="bg-transparent border-none focus:ring-0 text-[15px] text-gray-600 w-full placeholder:text-gray-400 p-0">
                    </div>

                    <div class="hidden md:block h-8 w-[1px] bg-gray-100 mx-2"></div>

                    <!-- Date Filter -->
                    <div class="relative w-full md:w-auto" id="dateDropdownContainer">
                        <button type="button" id="dateFilterBtn"
                            class="flex items-center justify-between gap-8 px-5 py-2.5 hover:bg-gray-50 rounded-xl transition-all w-full md:w-auto border border-transparent hover:border-gray-100">
                            <span id="currentDateLabel"
                                class="text-[15px] font-medium text-gray-600">{{ __('message.order_date') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-400">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" x2="16" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="2" y2="6" />
                                <line x1="3" x2="21" y1="10" y2="10" />
                            </svg>
                        </button>
                        <div id="dateDropdown"
                            class="hidden absolute top-full right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg z-50 p-2 overflow-hidden">
                            <div class="flex flex-col">
                                <button type="button" data-value=""
                                    class="date-filter-option px-4 py-2 text-left text-sm hover:bg-gray-50 rounded-lg text-gray-600">{{ __('message.all_time') }}</button>
                                <button type="button" data-value="today"
                                    class="date-filter-option px-4 py-2 text-left text-sm hover:bg-gray-50 rounded-lg text-gray-600">{{ __('message.last_24_hours') }}</button>
                                <button type="button" data-value="week"
                                    class="date-filter-option px-4 py-2 text-left text-sm hover:bg-gray-50 rounded-lg text-gray-600">{{ __('message.last_7_days') }}</button>
                                <button type="button" data-value="month"
                                    class="date-filter-option px-4 py-2 text-left text-sm hover:bg-gray-50 rounded-lg text-gray-600">{{ __('message.last_30_days') }}</button>
                                <button type="button" data-value="year"
                                    class="date-filter-option px-4 py-2 text-left text-sm hover:bg-gray-50 rounded-lg text-gray-600">{{ __('message.last_year') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="hidden md:block h-8 w-[1px] bg-gray-100 mx-2"></div>

                    <!-- Status Filter -->
                    <button type="button"
                        class="flex items-center justify-between gap-8 px-5 py-2.5 hover:bg-gray-50 rounded-xl transition-all w-full md:w-auto border border-transparent hover:border-gray-100 opacity-60 cursor-not-allowed">
                        <span class="text-[15px] font-medium text-gray-600">{{ __('message.shipping_status') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-gray-400">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="ordersContainer" class="grid grid-cols-1 gap-6">

                @forelse($orders as $order)
                    @include('backoffice.profile.partials.orderCard', ['order' => $order])
                @empty
                    <div class="col-span-full text-center py-20 bg-gray-100/50 rounded-lg">
                        <p class="text-gray-500">{{ __('message.no_sale_found_general') }}</p>
                    </div>
                @endforelse
            </div>
            <div id="paginationLinks" class="py-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('orderSearch');
                const dateFilterBtn = document.getElementById('dateFilterBtn');
                const dateDropdown = document.getElementById('dateDropdown');
                const dateFilterOptions = document.querySelectorAll('.date-filter-option');
                const currentDateLabel = document.getElementById('currentDateLabel');
                const ordersContainer = document.getElementById('ordersContainer');
                const originalLabel = currentDateLabel.textContent;

                let currentDateFilter = '';

                // Toggle Dropdown
                dateFilterBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dateDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', () => {
                    dateDropdown.classList.add('hidden');
                });

                function filterOrders() {
                    const searchTerm = searchInput.value.toLowerCase().trim();
                    const now = new Date();
                    const orderCards = document.querySelectorAll('.order-card');
                    let visibleCount = 0;

                    orderCards.forEach(card => {
                        const title = card.querySelector('.order-title').textContent.toLowerCase();
                        const orderId = card.querySelector('.order-id').textContent.toLowerCase();
                        const createdAtStr = card.getAttribute('data-created-at');
                        const createdAt = new Date(createdAtStr);

                        // Ricerca dinamica sul titolo e sul numero d'ordine
                        let matchesSearch = title.includes(searchTerm) || orderId.includes(searchTerm);
                        let matchesDate = true;

                        if (currentDateFilter) {
                            const diffTime = Math.abs(now - createdAt);
                            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

                            switch (currentDateFilter) {
                                case 'today':
                                    matchesDate = createdAt.toDateString() === now.toDateString();
                                    break;
                                case 'week':
                                    matchesDate = diffDays <= 7;
                                    break;
                                case 'month':
                                    matchesDate = diffDays <= 30;
                                    break;
                                case 'year':
                                    matchesDate = diffDays <= 365;
                                    break;
                            }
                        }

                        // Mostra/Nascondi l'elemento vue-island che contiene la card
                        const island = card.closest('.vue-island');
                        if (matchesSearch && matchesDate) {
                            island.style.display = 'block';
                            visibleCount++;
                        } else {
                            island.style.display = 'none';
                        }
                    });

                    // Gestione messaggio "Nessun risultato"
                    let noResults = document.getElementById('noResultsJS');
                    if (visibleCount === 0) {
                        if (!noResults) {
                            noResults = document.createElement('div');
                            noResults.id = 'noResultsJS';
                            noResults.className = 'col-span-full text-center py-20 bg-gray-100/50 rounded-lg w-full';
                            noResults.innerHTML = `<p class="text-gray-500">{{ __('message.no_sale_found_general') }}</p>`;
                            ordersContainer.appendChild(noResults);
                        }
                    } else if (noResults) {
                        noResults.remove();
                    }
                }

                // Evento input per ricerca "lettera per lettera"
                searchInput.addEventListener('input', filterOrders);

                dateFilterOptions.forEach(option => {
                    option.addEventListener('click', function () {
                        currentDateFilter = this.getAttribute('data-value');
                        currentDateLabel.textContent = currentDateFilter ? this.textContent :
                            originalLabel;

                        // Highlight active option
                        dateFilterOptions.forEach(opt => opt.classList.remove('text-primary',
                            'font-bold',
                            'bg-primary/5'));
                        if (currentDateFilter) {
                            this.classList.add('text-primary', 'font-bold', 'bg-primary/5');
                        }

                        filterOrders();
                        dateDropdown.classList.add('hidden');
                    });
                });
            });
        </script>
    @endpush
@endsection
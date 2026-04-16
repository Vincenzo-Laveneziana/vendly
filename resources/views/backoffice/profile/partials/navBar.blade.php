<!-- Profile Navigation Bar -->
<div class="w-full bg-white/95 backdrop-blur-md border-b border-gray-100 top-16 md:top-20 z-40">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-center overflow-x-auto no-scrollbar h-16 md:h-20">
            @php
                $navItems = [
                    ['route' => 'Backoffice.profile', 'label' => 'message.my_profile'],
                    ['route' => 'Backoffice.favorites', 'label' => 'message.my_favorites'],
                    ['route' => 'Backoffice.ads', 'label' => 'message.my_ads'],
                    ['route' => '#', 'label' => 'message.my_orders'],
                    ['route' => 'Backoffice.createChat', 'label' => 'message.my_chats'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php
                    $isActive = ($item['route'] !== '#') && request()->routeIs($item['route']);
                    $url = ($item['route'] !== '#' && Route::has($item['route'])) ? route($item['route']) : '#';
                @endphp
                <a href="{{ $url }}"
                    class="flex-1 min-w-[max-content] h-full flex items-center justify-center transition-all relative group px-4">
                    <div
                        class="px-5 py-2 rounded-xl transition-all whitespace-nowrap {{ $isActive ? 'bg-[#08B2B4] text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 font-medium' }}">
                        {{ __($item['label']) }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
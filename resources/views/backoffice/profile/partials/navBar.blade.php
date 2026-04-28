<!-- Profile Navigation Bar -->
<div class="w-full bg-white/95 backdrop-blur-md border-b border-gray-100 top-16 md:top-20 z-40">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-center overflow-x-auto no-scrollbar h-16 md:h-20">

            <a href={{route("Backoffice.profile")}}
                class="flex-1 min-w-[max-content] h-full flex items-center justify-center transition-all relative group px-4">
                <div
                    class="px-5 py-2 rounded-xl transition-all whitespace-nowrap {{ request()->routeIs('Backoffice.profile') ? 'bg-[#08B2B4] text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 font-medium' }}">
                    {{ __('message.my_profile') }}
                </div>
            </a>

            <a href="{{ route('Backoffice.sale') }}"
                class="flex-1 min-w-[max-content] h-full flex items-center justify-center transition-all relative group px-4">
                <div
                    class="px-5 py-2 rounded-xl transition-all whitespace-nowrap {{ request()->routeIs('Backoffice.sale') ? 'bg-[#08B2B4] text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 font-medium' }}">
                    {{ __('message.my_sale') }}
                </div>
            </a>

            <a href="{{ route('Backoffice.favorites') }}"
                class="flex-1 min-w-[max-content] h-full flex items-center justify-center transition-all relative group px-4">
                <div
                    class="px-5 py-2 rounded-xl transition-all whitespace-nowrap {{ request()->routeIs('Backoffice.favorites') ? 'bg-[#08B2B4] text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 font-medium' }}">
                    {{ __('message.my_favorites') }}
                </div>
            </a>

            <a href="{{ route('Backoffice.orders') }}"
                class="flex-1 min-w-[max-content] h-full flex items-center justify-center transition-all relative group px-4">
                <div
                    class="px-5 py-2 rounded-xl transition-all whitespace-nowrap {{ request()->routeIs('Backoffice.orders') ? 'bg-[#08B2B4] text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 font-medium' }}">
                    {{ __('message.my_orders') }}
                </div>
            </a>

            <a href="{{ route('Backoffice.chat.index') }}"
                class="flex-1 min-w-[max-content] h-full flex items-center justify-center transition-all relative group px-4">
                <div
                    class="px-5 py-2 rounded-xl transition-all whitespace-nowrap {{ request()->routeIs('Backoffice.chat.*') ? 'bg-[#08B2B4] text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 font-medium' }}">
                    {{ __('message.my_chat') }}
                </div>
            </a>


        </div>
    </div>
</div>
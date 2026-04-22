@extends('master')

@section('title', __('message.order_confirmed'))

@section('content')
    <div class="relative overflow-hidden z-0 min-h-screen bg-gray-50/50 flex items-center justify-center py-20 px-4">
        <!-- Background Decorations -->
        <img src="{{ asset('images/blob_02.webp') }}" alt=""
            class="absolute -z-10 bottom-10 -left-64 w-96 pointer-events-none rotate-[15deg] opacity-50">
        <img src="{{ asset('images/blob_02.webp') }}" alt=""
            class="absolute -z-10 top-10 -right-64 w-96 pointer-events-none -rotate-[20deg] opacity-50">

        <div class="w-full max-w-2xl animate-in fade-in zoom-in duration-500">
            <div
                class="bg-white rounded-[40px] border border-gray-100 p-8 md:p-16 shadow-2xl shadow-gray-200/50 text-center relative overflow-hidden">
                <!-- Success Sparkles -->
                <div
                    class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#08B2B4]/0 via-[#08B2B4] to-[#08B2B4]/0">
                </div>

                <!-- Success Icon -->
                <div class="relative mb-10 inline-block">
                    <div class="w-24 h-24 rounded-full bg-[#08B2B4]/10 flex items-center justify-center animate-bounce">
                        <span class="material-symbols-outlined text-[48px] text-[#08B2B4] font-black">check_circle</span>
                    </div>
                    <div
                        class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-white shadow-lg flex items-center justify-center animate-pulse">
                        <span class="material-symbols-outlined text-[16px] text-[#08B2B4]">celebration</span>
                    </div>
                </div>

                <!-- Header Text -->
                <div class="space-y-3 mb-12">
                    <h1 class="text-4xl font-black text-gray-900 tracking-tight lowercase first-letter:uppercase">
                        {{ __('message.order_confirmed') }}
                    </h1>
                    <p class="text-gray-400 font-medium text-lg">
                        {{ __('message.thank_you_for_order') }}, {{ Auth::user()->name }}!
                    </p>
                </div>

                <!-- Order Preview Card -->
                <div
                    class="bg-gray-50/50 rounded-[32px] border border-gray-100 p-6 md:p-8 mb-12 flex flex-col md:flex-row items-center gap-8 text-left">
                    <div
                        class="w-32 h-32 rounded-2xl bg-white border border-gray-100 overflow-hidden flex-shrink-0 shadow-sm relative group">
                        @if ($order->product->images && $order->product->images->isNotEmpty())
                            <img src="{{ Storage::url($order->product->images->first()->path) }}"
                                alt="{{ $order->product->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-200">
                                <span class="material-symbols-outlined text-[32px]">image</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow space-y-4 w-full">
                        <div>
                            <p class="text-[10px] text-[#08B2B4] font-black uppercase tracking-widest mb-1">
                                {{ $order->product->category_name }}
                            </p>
                            <h2 class="text-xl font-black text-gray-900 line-clamp-1 tracking-tight">
                                {{ $order->product->title }}
                            </h2>
                        </div>
                        <div class="grid grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">
                                    {{ __('message.order_number') }}
                                </p>
                                <p class="text-[13px] font-bold text-gray-900 tracking-tight">{{ $order->order_number }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">
                                    {{ __('message.estimated_delivery') }}
                                </p>
                                <p class="text-[13px] font-bold text-[#08B2B4] tracking-tight">2-4 {{ __('message.days') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Message -->
                <p class="text-[13px] text-gray-400 font-medium mb-12 max-w-md mx-auto leading-relaxed">
                    {{ __('message.order_received_msg') }}
                    {{ __('message.check_email_confirmation') }}
                </p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('Frontoffice.home') }}"
                        class="w-full sm:w-auto px-10 h-14 rounded-2xl bg-[#08B2B4] text-white text-[13px] font-black uppercase tracking-widest flex items-center justify-center gap-3 shadow-xl shadow-[#08B2B4]/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                        {{ __('message.continue_shopping') }}
                    </a>
                    <a href="{{ route('Backoffice.orders') }}"
                        class="w-full sm:w-auto px-10 h-14 rounded-2xl bg-white border border-gray-100 text-gray-400 text-[13px] font-black uppercase tracking-widest flex items-center justify-center gap-3 hover:bg-gray-50 transition-all">
                        <span class="material-symbols-outlined text-[20px]">history</span>
                        {{ __('message.my_orders') }}
                    </a>
                </div>
            </div>

            <!-- Footer Help -->
            <div class="mt-8 text-center">
                <p class="text-[13px] text-gray-400 font-medium">
                    {{ __('message.need_help') }}
                    <a href="#"
                        class="text-[#08B2B4] font-black uppercase text-[11px] tracking-widest ml-2 hover:underline">
                        {{ __('message.customer_service') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
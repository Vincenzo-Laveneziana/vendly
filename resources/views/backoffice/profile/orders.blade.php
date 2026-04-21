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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($orders as $order)
                    @include('frontoffice.partials.cardProdotto', ['product' => $order->product])
                @empty
                    <div class="col-span-full text-center py-20 bg-gray-100/50 rounded-[2rem]">
                        <p class="text-gray-500">{{ __('message.no_sale_found_general') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
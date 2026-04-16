@section('content')
    <!-- Decorative Blobs -->
    <img src="{{ asset('images/blob_02.webp') }}" alt=""
        class="fixed bottom-0 -left-64 w-[32rem] pointer-events-none rotate-[15deg] opacity-20 -z-0 select-none">
    <img src="{{ asset('images/blob_02.webp') }}" alt=""
        class="fixed top-32 -right-64 w-[32rem] pointer-events-none -rotate-[20deg] opacity-20 -z-0 select-none">

    <div class="h-[calc(100vh-80px)] w-full flex bg-transparent md:p-6 md:gap-6 overflow-hidden relative z-10">

        <!-- COLONNA SINISTRA: Sidebar -->
        <div id="chat-sidebar"
            class="flex w-full md:w-80 flex-col bg-vendly rounded-[2rem] shadow-xl h-full overflow-hidden shrink-0">
            <!-- Search Bar in Sidebar -->
            <div class="p-6 pb-2 shrink-0">
                <div
                    class="relative flex items-center bg-white/95 rounded-2xl shadow-inner border border-white/20 px-3 group focus-within:ring-2 focus-within:ring-white/20 transition-all">
                    <span
                        class="material-symbols-outlined text-gray-400 text-lg transition-colors group-focus-within:text-green flex-shrink-0">search</span>
                    <input type="text" placeholder="{{ __('message.search_chat') }}"
                        class="w-full pl-2 pr-4 py-2 bg-transparent border-none focus:outline-none focus:ring-0 text-sm">
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-3 no-scrollbar">
                @if (isset($conversations) && $conversations->count() > 0)
                    @foreach ($conversations as $chat)
                        @php
                            $otherPerson = $chat->buyer_id == auth()->id() ? $chat->seller : $chat->buyer;
                        @endphp

                        <a href="{{ route('Backoffice.createChat', ['idProdotto' => $chat->product_id, 'idConversazione' => $chat->id]) }}"
                            class="chat-item-btn block w-full p-4 bg-white rounded-2xl shadow-sm transition-all hover:shadow-md hover:scale-[1.02] active:scale-95">

                            <div class="flex gap-4 items-center">
                                <!-- Product Image Small -->
                                <div class="w-12 h-12 rounded-xl border border-gray-100 overflow-hidden flex-shrink-0 bg-gray-50">
                                    @if($chat->product && $chat->product->images->isNotEmpty())
                                        <img src="{{ Storage::url($chat->product->images->first()->path) }}"
                                            class="w-full h-full object-cover" alt="">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <span class="material-symbols-outlined text-xl">image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-bold text-gray-900 text-sm truncate">
                                        {{ $chat->product->title ?? __('message.product_removed') }}
                                    </h4>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ $otherPerson->name ?? __('message.user_placeholder') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-center">
                        <p class="text-sm text-white/80">{{ __('message.no_conversations') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- COLONNA DESTRA: Finestra Chat (Stato Vuoto) -->
        <div id="chat-window"
            class="hidden md:flex w-full md:flex-1 flex-col h-full bg-white/90 backdrop-blur-sm rounded-[2rem] shadow-xl overflow-hidden border border-white/20 items-center justify-center">

            <!-- SCHERMATA VUOTA (Empty State) -->
            <div class="text-center opacity-40 flex flex-col items-center p-6 scale-110">
                <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mb-8 shadow-inner">
                    <span class="material-symbols-outlined text-5xl text-gray-300">forum</span>
                </div>

                <h3 class="text-2xl font-black text-gray-800 mb-3 tracking-tight">{{ __('message.your_conversations') }}
                </h3>
                <p class="text-sm text-gray-500 max-w-xs mx-auto font-medium">
                    {{ __('message.select_chat_instruction') }}
                </p>
            </div>
        </div>
    </div>
@endsection
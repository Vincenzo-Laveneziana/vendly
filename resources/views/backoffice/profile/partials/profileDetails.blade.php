<div x-data="{ openModal: false }" class="relative min-h-screen bg-transparent py-6 md:py-12"
    style="font-family: 'Satoshi-Regular', sans-serif;">
    <!-- Blob decorativi di sfondo -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
        <img src="{{ asset('images/blob_02.webp') }}" alt=""
            class="absolute top-[-10%] -left-32 w-64 md:w-[700px] rotate-[15deg] opacity-40 blur-3xl">
        <img src="{{ asset('images/blob_02.webp') }}" alt=""
            class="absolute bottom-[-10%] -right-32 w-64 md:w-[700px] -rotate-[20deg] opacity-40 blur-3xl">
    </div>

    <div class="max-w-6xl mx-auto px-4 md:px-6 space-y-6 md:space-y-8">
        <!-- Sezione 1: Header Profilo -->
        <div
            class="bg-white rounded-[2rem] md:rounded-[40px] shadow-sm border border-gray-100 p-6 md:p-12 overflow-hidden">
            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                <!-- Immagine Profilo -->
                <div class="relative group">
                    <div
                        class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-gray-50 shadow-inner">
                        <img src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name . ' ' . auth()->user()->surname) . '&color=7F9CF5&background=EBF4FF' }}"
                            alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Info Base -->
                <div class="flex-grow text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 tracking-tight mb-2">
                        {{ auth()->user()->name }} {{ auth()->user()->surname }}
                    </h1>
                    <p class="text-[13px] text-gray-400 font-semibold uppercase mb-3">
                        {{ __('message.seller_since') }} <span
                            class="text-gray-900 font-normal ml-1">{{ auth()->user()->created_at ? auth()->user()->created_at->translatedFormat('d F Y') : __('message.not_specified') }}</span>
                    </p>
                </div>

                <!-- Stats -->
                <div class="w-full md:w-auto border-t md:border-t-0 md:border-l border-gray-100 pt-8 md:pt-0 md:pl-12">
                    <div class="space-y-5 min-w-[220px]">
                        <div class="flex justify-between items-center">
                            <span
                                class="text-[14px] text-gray-500 font-semibold">{{ __('message.products_uploaded') }}</span>
                            <span class="text-xl font-normal text-gray-900">{{ $productsCount }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span
                                class="text-[14px] text-gray-500 font-semibold">{{ __('message.products_sold') }}</span>
                            <span class="text-xl font-normal text-gray-900">{{ $soldProductCount }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span
                                class="text-[14px] text-gray-500 font-semibold">{{ __('message.products_online') }}</span>
                            <span class="text-xl font-normal text-gray-900">{{ $pendingProductCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sezione 2: Informazioni Personali -->
        <div class="bg-white rounded-[2rem] md:rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 md:px-12 md:py-8 border-b border-gray-50 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">{{ __('message.personal_info') }}</h2>
                <button @click="openModal = true"
                    class="inline-flex items-center gap-2 bg-[#08B2B4] hover:bg-[#079fa1] text-white font-semibold text-[11px] uppercase tracking-wider py-2.5 px-6 rounded-xl transition-all shadow-sm active:scale-95">
                    <span class="material-symbols-outlined text-[16px]">edit</span>
                    {{ __('message.edit') }}
                </button>
            </div>
            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-10 gap-x-12">
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.name') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">{{ auth()->user()->name }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.surname') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">{{ auth()->user()->surname }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.date_of_birth') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">
                            {{ auth()->user()->date_of_birth ? auth()->user()->date_of_birth->translatedFormat('d F Y') : __('message.not_specified') }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.email') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.phone') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">
                            {{ auth()->user()->phone ?? __('message.not_specified') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sezione 3: Dati di Residenza -->
        <div class="bg-white rounded-[2rem] md:rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 md:px-12 md:py-8 border-b border-gray-50 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">{{ __('message.residence_data') }}</h2>
            </div>
            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-10 gap-x-12">
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.city') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">
                            {{ auth()->user()->address['city'] ?? __('message.not_specified') }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.zip_code') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">
                            {{ auth()->user()->address['zip'] ?? __('message.not_specified') }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-[11px] text-gray-400 uppercase font-semibold tracking-[0.1em] mb-2">{{ __('message.street') }}</label>
                        <p class="text-base font-normal text-gray-900 tracking-tight">
                            @if(isset(auth()->user()->address))
                                {{ auth()->user()->address['street'] ?? __('message.not_specified') }}
                            @else
                                {{ __('message.not_specified') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifica (Alpine.js) -->
    <div x-show="openModal" class="fixed inset-0 z-[70] flex items-center justify-center p-3 sm:p-6" x-cloak
        x-transition.opacity>
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md" @click="openModal = false"></div>
        <div class="relative bg-white rounded-[2rem] md:rounded-[3rem] shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto px-5 py-8 md:p-12"
            @click.stop>
            <div class="flex justify-between items-center mb-8 md:mb-10">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">{{ __('message.edit_profile') }}
                    </h1>
                    <p class="text-gray-400 text-[13px] mt-1">
                        {{ __('message.update_info') }}
                    </p>
                </div>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-900 transition-colors">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
            </div>

            <form action="{{ route('Auth.updateUser', auth()->user()) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    <!-- Nome/Cognome -->
                    <div class="space-y-6 md:space-y-8">
                        <h3 class="text-xs font-semibold text-[#08B2B4] uppercase tracking-[0.2em] pt-2">
                            {{ __('message.personal_info') }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="flex flex-col">
                                <label
                                    class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.name') }}</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}"
                                    class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                            </div>
                            <div class="flex flex-col">
                                <label
                                    class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.surname') }}</label>
                                <input type="text" name="surname" value="{{ auth()->user()->surname }}"
                                    class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="flex flex-col">
                                <label
                                    class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.date_of_birth') }}</label>
                                <input type="date" name="date_of_birth"
                                    value="{{ auth()->user()->date_of_birth ? auth()->user()->date_of_birth->format('Y-m-d') : '' }}"
                                    class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                            </div>
                            <div class="flex flex-col">
                                <label
                                    class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.phone') }}</label>
                                <input type="text" name="phone" value="{{ auth()->user()->phone }}"
                                    class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label
                                class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.email') }}</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}"
                                class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                        </div>
                    </div>

                    <!-- Residenza -->
                    <div class="space-y-6 md:space-y-8">
                        <h3 class="text-xs font-semibold text-[#08B2B4] uppercase tracking-[0.2em] pt-2">
                            {{ __('message.residence_data') }}
                        </h3>
                        <div class="flex flex-col">
                            <label
                                class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.street') }}</label>
                            <input type="text" name="address[street]"
                                value="{{ auth()->user()->address['street'] ?? '' }}"
                                class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="flex flex-col">
                                <label
                                    class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.city') }}</label>
                                <input type="text" name="address[city]"
                                    value="{{ auth()->user()->address['city'] ?? '' }}"
                                    class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                            </div>
                            <div class="flex flex-col">
                                <label
                                    class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.zip_code') }}</label>
                                <input type="text" name="address[zip]"
                                    value="{{ auth()->user()->address['zip'] ?? '' }}"
                                    class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label
                                class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.old_password') }}</label>
                            <input type="password" name="old_password"
                                class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm"
                                placeholder="{{ __('message.oldpassword_text') }}">
                        </div>
                        <div class="flex flex-col">
                            <label
                                class="text-[10px] font-semibold uppercase text-gray-400 mb-2 ml-1 tracking-widest">{{ __('message.new_password') }}</label>
                            <input type="password" name="new_password"
                                class="w-full px-5 py-3.5 md:py-4 rounded-2xl bg-gray-50 border border-gray-100 text-gray-900 font-normal focus:outline-none focus:border-[#08B2B4] transition text-sm"
                                placeholder="{{ __('message.newpassword_text') }}">
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex flex-col md:flex-row gap-5">
                    <button type="button" @click="openModal = false"
                        class="order-2 md:order-1 flex-1 py-4 text-gray-400 font-semibold uppercase tracking-widest text-[11px] hover:text-gray-900 transition-colors">{{ __('message.cancel') }}</button>
                    <button type="submit"
                        class="order-1 md:order-2 flex-[2] bg-gray-900 text-white font-semibold uppercase tracking-widest text-[11px] py-4 rounded-2xl hover:bg-black transition-all shadow-lg active:scale-95">{{ __('message.save_changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
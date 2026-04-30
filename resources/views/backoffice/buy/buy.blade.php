@extends('master')

@section('title', __('message.buy_product') . ' - ' . $product->title)

@section('content')
    <div class="relative overflow-hidden z-0 min-h-screen bg-gray-50/50 py-12">
        <!-- Background Decorations -->
        <img src="{{ asset('images/blob_02.webp') }}" alt=""
            class="absolute -z-10 bottom-10 -left-64 w-96 pointer-events-none rotate-[15deg] opacity-50">
        <img src="{{ asset('images/blob_02.webp') }}" alt=""
            class="absolute -z-10 top-10 -right-64 w-96 pointer-events-none -rotate-[20deg] opacity-50">

        <div class="max-w-[1400px] mx-auto px-4 md:px-10">

            <!-- Back Button - Adjusted Spacing -->
            <a href="{{ route('Frontoffice.product', $product->id) }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-[#08B2B4] text-white rounded-xl font-black text-[12px] uppercase tracking-wider mb-6 hover:bg-[#079fa1] transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                {{ __('message.back') }}
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-start lg:mt-8" x-data="purchasePage">
                <!-- Left: Content Flow -->
                <div class="lg:col-span-8 space-y-6 order-2 lg:order-1">
                    <!-- Progress Bar -->
                    <div class="bg-white rounded-lg border border-gray-100 p-8 shadow-sm mb-6">
                        <div class="flex items-center justify-center max-w-sm mx-auto">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300"
                                    :class="step >= 1 ? 'bg-[#08B2B4] text-white shadow-lg shadow-[#08B2B4]/20' : 'bg-gray-100 text-gray-300'">
                                    <span class="material-symbols-outlined text-[20px]">person</span>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-widest"
                                    :class="step >= 1 ? 'text-gray-900' : 'text-gray-400'">{{ __('message.personal_data') }}</span>
                            </div>
                            <div class="flex-grow h-[1px] mx-4 bg-gray-100 relative">
                                <div class="absolute inset-0 bg-[#08B2B4] transition-all duration-500"
                                    :style="'width: ' + (step > 1 ? '100%' : '0%')"></div>
                            </div>
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300"
                                    :class="step >= 2 ? 'bg-[#08B2B4] text-white shadow-lg shadow-[#08B2B4]/20' : 'bg-gray-100 text-gray-300'">
                                    <span class="material-symbols-outlined text-[20px]">credit_card</span>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-widest"
                                    :class="step >= 2 ? 'text-gray-900' : 'text-gray-400'">{{ __('message.payment_method') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Dati Personali -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="bg-white rounded-lg border border-gray-100 p-8 md:p-12 shadow-sm space-y-10">
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 mb-8 ml-1">{{ __('message.shipping_data') }}</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.name') }}</label>
                                    <input type="text" x-model="shipping.firstName" placeholder="Mario"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] focus:ring-0 outline-none transition-all font-medium text-gray-900 placeholder:text-gray-300">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.surname') }}</label>
                                    <input type="text" x-model="shipping.lastName" placeholder="Rossi"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] focus:ring-0 outline-none transition-all font-medium text-gray-900 placeholder:text-gray-300">
                                </div>
                                <div class="space-y-2 lg:col-span-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.street') }}</label>
                                    <input type="text" x-model="shipping.street" placeholder="Via Roma, 12"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] focus:ring-0 outline-none transition-all font-medium text-gray-900 placeholder:text-gray-300">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.city') }}</label>
                                    <input type="text" x-model="shipping.city" placeholder="Mesagne (BR)"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] focus:ring-0 outline-none transition-all font-medium text-gray-900 placeholder:text-gray-300">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.zip') }}</label>
                                    <input type="text" x-model="shipping.zip" placeholder="72023"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] focus:ring-0 outline-none transition-all font-medium text-gray-900 placeholder:text-gray-300">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.email') }}</label>
                                    <input type="email" x-model="shipping.email" placeholder="mariorossi@example.com"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] focus:ring-0 outline-none transition-all font-medium text-gray-900 placeholder:text-gray-300">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.phone') }}</label>
                                    <input type="tel" x-model="shipping.phone" placeholder="347 81 12 489"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] focus:ring-0 outline-none transition-all font-medium text-gray-900 placeholder:text-gray-300">
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-gray-50">
                            <p class="text-[11px] font-bold text-gray-400 mb-6 ml-1">{{ __('message.billing_data') }}</p>
                            <div class="flex items-center gap-3 mb-8 cursor-pointer group"
                                @click="billing.sameAsShipping = !billing.sameAsShipping">
                                <div class="w-5 h-5 rounded-md border transition-all flex items-center justify-center"
                                    :class="billing.sameAsShipping ? 'bg-[#08B2B4] border-[#08B2B4]' : 'border-gray-200 group-hover:border-[#08B2B4]/50'">
                                    <span x-show="billing.sameAsShipping"
                                        class="material-symbols-outlined text-white text-[16px] font-bold">check</span>
                                </div>
                                <span
                                    class="text-[12px] font-bold text-gray-500">{{ __('message.same_billing_address') }}</span>
                            </div>

                            <template x-if="!billing.sameAsShipping">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8 animate-in fade-in duration-300">
                                    <div class="space-y-2">
                                        <label
                                            class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.name') }}</label>
                                        <input type="text" x-model="billing.firstName"
                                            class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.surname') }}</label>
                                        <input type="text" x-model="billing.lastName"
                                            class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none">
                                    </div>
                                    <div class="space-y-2 lg:col-span-2">
                                        <label
                                            class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.street') }}</label>
                                        <input type="text" x-model="billing.street"
                                            class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.city') }}</label>
                                        <input type="text" x-model="billing.city"
                                            class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.zip') }}</label>
                                        <input type="text" x-model="billing.zip"
                                            class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none">
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button @click="nextStep()" :disabled="!isShippingValid()"
                                :class="isShippingValid() ? 'bg-[#08B2B4] text-white shadow-lg shadow-[#08B2B4]/20 hover:scale-[1.02]' : 'bg-gray-100 text-gray-300 cursor-not-allowed'"
                                class="px-10 h-12 rounded-xl text-[12px] font-black uppercase tracking-widest transition-all">
                                Continua
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Metodo di Pagamento -->
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="bg-white rounded-lg border border-gray-100 p-8 md:p-12 shadow-sm space-y-10">
                        <div>
                            <div class="flex items-center justify-between mb-8">
                                <p class="text-[11px] font-bold text-gray-400 ml-1">
                                    {{ __('message.select_payment_method') }}
                                </p>
                                <button @click="goBack()"
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-[#08B2B4] transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[14px]">arrow_back</span>
                                    {{ __('message.back') }}
                                </button>
                            </div>

                            <div class="space-y-4">
                                <label
                                    class="flex items-center justify-between p-4 rounded-xl border transition-all cursor-pointer group"
                                    :class="paymentMethod === 'cash' ? 'border-[#08B2B4] bg-[#08B2B4]/5' : 'border-gray-100 hover:border-gray-200'">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full border flex items-center justify-center transition-all"
                                            :class="paymentMethod === 'cash' ? 'border-[#08B2B4]' : 'border-gray-200'">
                                            <div x-show="paymentMethod === 'cash'"
                                                class="w-3 h-3 rounded-full bg-[#08B2B4]"></div>
                                        </div>
                                        <span
                                            class="text-[13px] font-bold text-gray-700">{{ __('message.cash_on_delivery') }}</span>
                                        <input type="radio" value="cash" x-model="paymentMethod" class="hidden">
                                    </div>
                                    <span class="material-symbols-outlined text-gray-400 text-[22px]">payments</span>
                                </label>

                                <label
                                    class="flex items-center justify-between p-4 rounded-xl border transition-all cursor-pointer group"
                                    :class="paymentMethod === 'apple' ? 'border-[#08B2B4] bg-[#08B2B4]/5' : 'border-gray-100 hover:border-gray-200'">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full border flex items-center justify-center transition-all"
                                            :class="paymentMethod === 'apple' ? 'border-[#08B2B4]' : 'border-gray-200'">
                                            <div x-show="paymentMethod === 'apple'"
                                                class="w-3 h-3 rounded-full bg-[#08B2B4]"></div>
                                        </div>
                                        <span
                                            class="text-[13px] font-bold text-gray-700">{{ __('message.apple_pay') }}</span>
                                        <input type="radio" value="apple" x-model="paymentMethod" class="hidden">
                                    </div>
                                    <div class="h-6 flex items-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b0/Apple_Pay_logo.svg"
                                            alt="Apple Pay" class="h-5 transition-all"
                                            :class="paymentMethod === 'apple' ? 'opacity-100' : 'opacity-40 group-hover:opacity-60'">
                                    </div>
                                </label>

                                <label
                                    class="flex items-center justify-between p-4 rounded-xl border transition-all cursor-pointer group"
                                    :class="paymentMethod === 'google' ? 'border-[#08B2B4] bg-[#08B2B4]/5' : 'border-gray-100 hover:border-gray-200'">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full border flex items-center justify-center transition-all"
                                            :class="paymentMethod === 'google' ? 'border-[#08B2B4]' : 'border-gray-200'">
                                            <div x-show="paymentMethod === 'google'"
                                                class="w-3 h-3 rounded-full bg-[#08B2B4]"></div>
                                        </div>
                                        <span
                                            class="text-[13px] font-bold text-gray-700">{{ __('message.google_pay') }}</span>
                                        <input type="radio" value="google" x-model="paymentMethod" class="hidden">
                                    </div>
                                    <div class="h-6 flex items-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Google_Pay_Logo_%282020%29.svg"
                                            alt="Google Pay" class="h-5 transition-all"
                                            :class="paymentMethod === 'google' ? 'opacity-100' : 'opacity-40 group-hover:opacity-60'">
                                    </div>
                                </label>

                                <label
                                    class="flex items-center justify-between p-4 rounded-xl border transition-all cursor-pointer group"
                                    :class="paymentMethod === 'card' ? 'border-[#08B2B4] bg-[#08B2B4]/5' : 'border-gray-100 hover:border-gray-200'">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full border flex items-center justify-center transition-all"
                                            :class="paymentMethod === 'card' ? 'border-[#08B2B4]' : 'border-gray-200'">
                                            <div x-show="paymentMethod === 'card'"
                                                class="w-3 h-3 rounded-full bg-[#08B2B4]"></div>
                                        </div>
                                        <span
                                            class="text-[13px] font-bold text-gray-700">{{ __('message.credit_debit_card') }}</span>
                                        <input type="radio" value="card" x-model="paymentMethod" class="hidden">
                                    </div>
                                    <span
                                        class="material-symbols-outlined text-gray-400 text-[22px] group-hover:text-gray-600 transition-colors"
                                        :class="paymentMethod === 'card' ? 'text-[#08B2B4]' : ''">credit_card</span>
                                </label>
                            </div>
                        </div>

                        <!-- Integrated Card Form -->
                        <div x-show="paymentMethod === 'card'" x-transition
                            class="pt-8 border-t border-gray-50 space-y-8 animate-in slide-in-from-top-2 duration-300">
                            <!-- Cards List Selection -->
                            <div x-show="cards.length > 0" class="space-y-4">
                                <p class="text-[11px] font-bold text-gray-400 ml-1">{{ __('message.saved_card') }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-for="(card, index) in cards" :key="index">
                                        <div @click="selectCard(index)"
                                            :class="selectedCardIndex === index ? 'border-[#08B2B4] bg-[#08B2B4]/5' : 'border-gray-100 hover:border-gray-200'"
                                            class="p-4 rounded-xl border flex items-center justify-between cursor-pointer transition-all group">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-[#08B2B4]">
                                                    <span class="material-symbols-outlined text-[18px]">payments</span>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-[12px] font-bold text-gray-900 truncate"
                                                        x-text="'**** ' + card.number.slice(-4)"></p>
                                                    <p class="text-[10px] text-gray-400" x-text="card.expiry"></p>
                                                </div>
                                            </div>
                                            <div
                                                class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button @click.stop="openDeleteModal(index)"
                                                    class="p-1.5 rounded-md hover:bg-red-50 text-gray-400 hover:text-red-500">
                                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                    <div @click="selectedCardIndex = null; cardForm = { number: '', expiry: '', cvv: '', name: '' }"
                                        class="p-4 rounded-xl border-2 border-dashed border-gray-100 hover:border-[#08B2B4]/30 hover:bg-gray-50 flex items-center justify-center gap-2 cursor-pointer transition-all group">
                                        <span
                                            class="material-symbols-outlined text-[18px] text-gray-300 group-hover:text-[#08B2B4]">add</span>
                                        <span
                                            class="text-[11px] font-black uppercase tracking-widest text-gray-300 group-hover:text-[#08B2B4]">{{ __('message.new_card') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.cardholder') }}</label>
                                    <input type="text" x-model="cardForm.name" placeholder="MARIO ROSSI"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none transition-all font-bold text-gray-900 uppercase">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.expiry_date') }}</label>
                                    <input type="text" x-model="cardForm.expiry" @input="formatExpiry($event)"
                                        placeholder="08/27" maxlength="5"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none transition-all font-bold text-gray-900 text-center">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.card_number') }}</label>
                                    <input type="text" x-model="cardForm.number" @input="formatCardNumber($event)"
                                        placeholder="1234 **** **** 5678" maxlength="19"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none transition-all font-bold text-gray-900">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[11px] font-black text-gray-900 ml-1">{{ __('message.cvv') }}</label>
                                    <input type="text" x-model="cardForm.cvv" placeholder="***" maxlength="3"
                                        class="w-full h-12 px-5 rounded-xl bg-white border border-gray-100 focus:border-[#08B2B4] outline-none transition-all font-bold text-gray-900 text-center">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button @click="submitPurchase()"
                                class="px-10 h-12 rounded-xl bg-[#08B2B4] text-white text-[12px] font-black uppercase tracking-widest transition-all shadow-lg shadow-[#08B2B4]/20 hover:scale-[1.02] active:scale-[0.98]">
                                {{ __('message.proceed_to_payment') }}
                            </button>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div x-show="showDeleteModal" x-cloak
                        class="fixed inset-0 z-[1001] flex items-center justify-center p-4" style="display: none;">
                        <div x-show="showDeleteModal" @click="showDeleteModal = false"
                            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm">
                        </div>
                        <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            class="bg-white rounded-lg shadow-2xl w-full max-w-sm overflow-hidden relative p-8 md:p-10 z-10 text-center">
                            <div
                                class="w-20 h-20 rounded-full bg-red-50 flex items-center justify-center text-red-500 mx-auto mb-6">
                                <span class="material-symbols-outlined text-[40px]">delete_forever</span>
                            </div>
                            <h3 class="text-xl font-black text-gray-900 mb-2">{{ __('message.confirm_deletion') }}</h3>
                            <p class="text-sm text-gray-500 font-medium mb-8 leading-relaxed">
                                {{ __('message.delete_confirmation_msg') }}
                            </p>
                            <div class="flex gap-4">
                                <button @click="showDeleteModal = false"
                                    class="flex-1 h-14 rounded-2xl border-2 border-gray-100 text-gray-400 text-[13px] font-black uppercase tracking-wider hover:bg-gray-50 transition-all">{{ __('message.cancel') }}</button>
                                <button @click="confirmDelete()"
                                    class="flex-1 h-14 rounded-2xl bg-red-500 text-white text-[13px] font-black uppercase tracking-wider shadow-lg shadow-red-500/20 hover:bg-red-600 transition-all">{{ __('message.delete') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Summary Sidebar -->
                <div class="lg:col-span-4 space-y-6 order-1 lg:order-2">
                    <div
                        class="bg-white rounded-lg border border-gray-100 p-8 shadow-2xl shadow-gray-200/50 relative overflow-hidden sticky top-8">
                        <!-- header -->
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.2em]">
                                {{ __('message.order_summary') }}
                            </h3>
                            <div class="w-8 h-8 rounded-lg bg-[#08B2B4]/5 flex items-center justify-center text-[#08B2B4]">
                                <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                            </div>
                        </div>

                        <!-- Product Preview Box -->
                        <div
                            class="p-4 rounded-lg bg-gray-50/50 border border-gray-100 mb-10 flex items-center gap-4 group transition-all duration-300 hover:bg-white hover:shadow-xl hover:shadow-gray-100/50">
                            <div
                                class="w-[72px] h-[72px] rounded-2xl bg-white border border-gray-100 overflow-hidden flex-shrink-0">
                                @if($product->images && $product->images->isNotEmpty())
                                    <img src="{{ Storage::url($product->images->first()->path) }}" alt="{{ $product->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-200">
                                        <span class="material-symbols-outlined text-[24px]">image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow min-w-0">
                                <p class="text-[9px] text-[#08B2B4] font-black uppercase tracking-widest mb-1.5">
                                    {{ $product->category_name }}
                                </p>
                                <h4 class="text-[13px] font-black text-gray-900 truncate leading-tight tracking-tight">
                                    {{ $product->title }}
                                </h4>
                            </div>
                        </div>

                        <!-- Cost Breakdown -->
                        <div class="space-y-6 mb-10">
                            <div class="flex items-center justify-between">
                                <span class="text-[14px] text-gray-400 font-bold">{{ __('message.subtotal') }}</span>
                                <span class="text-[14px] text-gray-900 font-bold">{{ __('message.money') }}
                                    {{ number_format($product->price, 2, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[14px] text-gray-400 font-bold">{{ __('message.shipping') }}</span>
                                <div class="flex items-center gap-2 text-[#08B2B4]">
                                    <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                                    <span
                                        class="text-[12px] font-black uppercase tracking-widest">{{ __('message.free') }}</span>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-50 flex items-end justify-between transition-all">
                                <span class="text-[15px] text-gray-900 font-black mb-1">{{ __('message.total') }}</span>
                                <div class="text-right">
                                    <span class="text-[34px] font-black text-gray-900 tracking-tight leading-none">
                                        {{ __('message.money') }} {{ number_format($product->price, 2, ',', '.') }}
                                    </span>
                                    <p class="text-[9px] text-[#08B2B4] font-black uppercase tracking-[0.15em] mt-1.5">
                                        {{ __('message.vat_included') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Protection Footer -->
                        <div class="mt-8 pt-8 border-t border-gray-50">
                            <div
                                class="flex items-center gap-4 p-5 rounded-lg bg-gray-50/50 border border-gray-100 group transition-all hover:bg-[#08B2B4]/5 hover:border-[#08B2B4]/10">
                                <div
                                    class="w-11 h-11 rounded-2xl bg-[#08B2B4]/10 flex items-center justify-center text-[#08B2B4] group-hover:scale-110 transition-transform shadow-sm">
                                    <span class="material-symbols-outlined text-[20px]">shield</span>
                                </div>
                                <div class="flex-grow">
                                    <p class="text-[10px] font-black text-gray-900 uppercase tracking-widest">
                                        {{ __('message.vendly_protection') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('purchasePage', () => ({
                step: 1,
                showDeleteModal: false,
                deleteIndex: null,
                cards: [],
                selectedCardIndex: null,

                shipping: {
                    firstName: '',
                    lastName: '',
                    street: '',
                    city: '',
                    zip: '',
                    email: '',
                    phone: ''
                },

                billing: {
                    sameAsShipping: true,
                    firstName: '',
                    lastName: '',
                    street: '',
                    city: '',
                    zip: ''
                },

                paymentMethod: 'card',
                cardForm: {
                    number: '',
                    expiry: '',
                    cvv: '',
                    name: ''
                },

                init() {
                    const saved = localStorage.getItem('vendly_payment_methods');
                    if (saved) {
                        try {
                            this.cards = JSON.parse(saved);
                        } catch (e) {
                            console.error('Error loading card data', e);
                            this.cards = [];
                        }
                    }
                    // Non selezioniamo nessuna carta di base come richiesto
                    this.selectedCardIndex = null;

                    const savedShipping = localStorage.getItem('vendly_shipping_data');
                    if (savedShipping) {
                        this.shipping = JSON.parse(savedShipping);
                    }
                },

                nextStep() {
                    if (this.step === 1 && this.isShippingValid()) {
                        localStorage.setItem('vendly_shipping_data', JSON.stringify(this.shipping));
                        this.step = 2;
                    }
                },

                goBack() {
                    if (this.step > 1) this.step--;
                },

                isShippingValid() {
                    return this.shipping.firstName && this.shipping.lastName &&
                        this.shipping.street && this.shipping.city && this.shipping.zip &&
                        this.shipping.email && this.shipping.phone;
                },

                openDeleteModal(index) {
                    this.deleteIndex = index;
                    this.showDeleteModal = true;
                },

                confirmDelete() {
                    if (this.deleteIndex !== null) {
                        this.cards.splice(this.deleteIndex, 1);
                        if (this.selectedCardIndex >= this.cards.length) {
                            this.selectedCardIndex = null;
                        }
                        this.saveToLocal();
                        this.showDeleteModal = false;
                        this.deleteIndex = null;
                    }
                },

                selectCard(index) {
                    this.selectedCardIndex = index;
                    const card = this.cards[index];
                    // Mostriamo il numero mascherato per sicurezza
                    const last4 = card.number.replace(/\s/g, '').slice(-4);
                    this.cardForm = {
                        number: '**** **** **** ' + last4,
                        expiry: card.expiry,
                        cvv: '***',
                        name: card.name
                    };
                },

                saveToLocal() {
                    localStorage.setItem('vendly_payment_methods', JSON.stringify(this.cards));
                },

                formatCardNumber(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    let formatted = value.match(/.{1,4}/g)?.join(' ') || '';
                    this.cardForm.number = formatted.substring(0, 19);
                },

                formatExpiry(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 2) {
                        value = value.substring(0, 2) + '/' + value.substring(2, 4);
                    }
                    this.cardForm.expiry = value;
                },

                isFormValid() {
                    return this.cardForm.number && this.cardForm.number.length >= 16 &&
                        this.cardForm.expiry && this.cardForm.cvv && this.cardForm.name;
                },

                async submitPurchase() {
                    let cardToSubmit = { ...this.cardForm };

                    // Se è una carta selezionata e il numero è ancora mascherato, recuperiamo quello reale
                    if (this.selectedCardIndex !== null && this.cardForm.number.includes('*')) {
                        cardToSubmit = { ...this.cards[this.selectedCardIndex] };
                    }

                    const data = {
                        shipping: this.shipping,
                        billing: this.billing.sameAsShipping ? this.shipping : this.billing,
                        paymentMethod: this.paymentMethod,
                        card: this.paymentMethod === 'card' ? cardToSubmit : null,
                    };

                    const response = await fetch('{{ route('Backoffice.processBuy', $product->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (response.ok && result.success && result.redirect) {
                        window.location.href = result.redirect;
                    } else {
                        // Gestione errori (inclusi 422 di validazione)
                        let errorMessage = '{{ __('message.error_checkout') }}';

                        if (result.errors) {
                            // Prendi il primo errore di validazione
                            errorMessage = Object.values(result.errors)[0][0];
                        } else if (result.message) {
                            errorMessage = result.message;
                        }

                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                message: errorMessage,
                                type: 'error'
                            }
                        }));
                    }
                }
            }))
        });
    </script>
@endpush
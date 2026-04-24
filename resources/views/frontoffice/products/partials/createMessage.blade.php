<div class=" bg-[#088d8f] rounded-[2rem] max-w-6xl mx-auto px-4 md:px-6 overflow-hidden shadow-2xl">
    <div class="px-8 py-10 md:px-8 md:py-12 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-8">

        <!-- Left Side: Text -->
        <div class="flex-1 text-center md:text-left">
            <h2 class="text-2xl md:text-5xl font-black text-white uppercase tracking-tight leading-none mb-4">
                {{ __('message.interested') }}
            </h2>
            <p class="text-l md:text-xl font-bold text-white/90">
                {{ __('message.contact_seller_subtitle') }}
            </p>
        </div>

        <!-- Right Side: Form Card -->
        <div class="w-full max-w-xl">
            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xl">
                <form id="contactSellerForm" onsubmit="window.initiateChat(event)" class="space-y-6">
                    <div class="space-y-2">
                        <label for="messageContent" class="text-sm font-bold text-gray-900 uppercase tracking-wider">
                            {{ __('message.message_label') ?? 'Messaggio' }}
                        </label>
                        <textarea id="messageContent" rows="4"
                            class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-600 outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition-all resize-none"
                            placeholder="Scrivi qui il tuo messaggio." required></textarea>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="bg-vendly text-white px-10 py-3 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-[#079fa1] active:scale-95 transition-all shadow-lg shadow-vendly/20">
                            {{ __('message.send') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    window.initiateChat = function(event) {
        event.preventDefault();
        const message = document.getElementById('messageContent').value;
        const productId = "{{ $product->id ?? '' }}";
        
        if (!message.trim()) return;

        // Reindirizza alla rotta createChat: /chat/{idProdotto}/{idConversazione?}/{message?}
        const url = "{{ route('Backoffice.createChat') }}/" + productId + "/null/" + encodeURIComponent(message);
        window.location.href = url;
    }
</script>
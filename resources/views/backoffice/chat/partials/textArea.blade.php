<!-- AREA MESSAGGI -->
<div id="messages-container" class="flex-1 p-6 md:p-8 overflow-y-auto bg-transparent flex flex-col no-scrollbar">
    @if (isset($messages) && $messages->count() > 0)
        @foreach ($messages as $message)
            @if ($message->sender_id == auth()->id())
                {{-- MESSAGGIO INVIATO (A DESTRA) - Stile Capsule Bianco/Bordo Teal --}}
                <div class="flex justify-end mb-6 w-full animate-in fade-in slide-in-from-right-4 duration-300">
                    <div
                        class="bg-white border-2 border-vendly text-[#08B2B4] px-6 py-3 rounded-lg shadow-lg max-w-[85%] md:max-w-[70%]">
                        <p class="text-sm md:text-base font-normal leading-relaxed break-words">{{ $message->content }}</p>
                    </div>
                </div>
            @else
                {{-- MESSAGGIO RICEVUTO (A SINISTRA) - Stile Capsule Teal --}}
                <div class="flex justify-start mb-6 w-full animate-in fade-in slide-in-from-left-4 duration-300">
                    <div
                        class="bg-vendly text-white px-6 py-3 rounded-lg shadow-lg shadow-vendly/20 max-w-[85%] md:max-w-[70%]">
                        <p class="text-sm md:text-base font-normal leading-relaxed break-words">{{ $message->content }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        {{-- STATO VUOTO --}}
        <div class="flex-1 flex flex-col items-center justify-center opacity-40">
            <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">chat_bubble</span>
            <p class="text-gray-500 text-sm font-medium tracking-tight">{{ __('message.start_conversation') }}</p>
        </div>
    @endif
</div>

<!-- Form invio messaggio - Stile Capsule centrato -->
<div class="p-6 md:p-8 pt-2 shrink-0">
    <form id="chat-form" action="{{ route('Backoffice.chat.send') }}" method="POST"
        class="relative max-w-4xl mx-auto flex items-center">
        @csrf

        <input type="hidden" id="conversation_id" name="conversation_id" value="{{ $conversation->id }}">
        <input type="hidden" id="sender_id" name="sender_id" value="{{ auth()->id() }}">

        <div class="relative w-full group flex items-center">
            <textarea id="message-input" name="content" rows="1" placeholder="{{ __('message.write_message') }}"
                required
                class="w-full pl-6 pr-14 py-3 bg-white border border-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-vendly/20 focus:border-vendly transition-all text-sm md:text-base font-normal shadow-md resize-none overflow-hidden"
                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>

            <button type="submit"
                class="absolute right-2 w-10 h-10 flex items-center justify-center bg-transparent text-green hover:bg-gray-50 rounded-full transition-all active:scale-90">
                <span class="material-symbols-outlined text-[24px]">send</span>
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const conversationId = {{ $conversation->id }};
        const currentUserId = {{ auth()->id() }};
        const messagesContainer = document.getElementById('messages-container');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');

        // Scroll automatico all'avvio
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // --- 1. ASCOLTO LIVE CON REVERB ---
        if (typeof window.Echo !== 'undefined' && conversationId) {
            window.Echo.private(`chat.${conversationId}`)
                .listen('.message.sent', (e) => {
                    if (e.message.sender_id != currentUserId) {
                        appendMessage(e.message, false);
                    }
                });
        }

        // --- 2. INVIO MESSAGGIO ---
        if (chatForm && messageInput) {
            
            // Gestione tasto Enter
            messageInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    chatForm.requestSubmit();
                }
            });

            chatForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const content = messageInput.value.trim();
                if (!content) return;

                // Aggiunta ottimistica (messaggio subito a schermo)
                appendMessage({
                    content: content,
                    sender_id: currentUserId,
                    created_at: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
                }, true);

                // Reset campo e focus
                messageInput.value = '';
                messageInput.style.height = '';
                messageInput.focus();

                // AJAX
                fetch(chatForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        content: content,
                        conversation_id: conversationId,
                        sender_id: currentUserId
                    })
                })
                .then(res => {
                    if (!res.ok) throw new Error('Errore server');
                    return res.json();
                })
                .then(data => {
                    console.log('Messaggio inviato:', data);
                })
                .catch(err => {
                    console.error('Errore invio:', err);
                });
            });
        }

        function appendMessage(message, isMe) {
            if (!messagesContainer) return;

            const align = isMe ? 'justify-end' : 'justify-start';
            const bg = isMe ? 'bg-white border-2 border-vendly text-[#08B2B4]' : 'bg-vendly text-white shadow-vendly/20';
            const animation = isMe ? 'slide-in-from-right-4' : 'slide-in-from-left-4';

            const html = `
                <div class="flex ${align} mb-6 w-full animate-in fade-in ${animation} duration-300">
                    <div class="${bg} px-6 py-3 rounded-lg shadow-lg max-w-[85%] md:max-w-[70%]">
                        <p class="text-sm md:text-base font-normal leading-relaxed break-words">${message.content}</p>
                    </div>
                </div>
            `;

            messagesContainer.insertAdjacentHTML('beforeend', html);
            messagesContainer.scrollTo({ top: messagesContainer.scrollHeight, behavior: 'smooth' });
        }
    });
</script>
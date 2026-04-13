<!-- AREA MESSAGGI -->
<div id="messages-container" class="flex-1 p-4 overflow-y-auto bg-gray-50 flex flex-col">
    @if (isset($messages) && $messages->count() > 0)
        @foreach ($messages as $message)
            @if ($message->sender_id == auth()->id())
                {{-- MESSAGGIO INVIATO (A DESTRA) --}}
                <div class="flex justify-end mb-4 w-full">
                    <div class="bg-blue-600 text-white px-4 py-2 rounded-2xl rounded-tr-none max-w-[85%] md:max-w-[70%] shadow-sm">
                        <p class="text-sm leading-relaxed break-words">{{ $message->content }}</p>
                        <span class="text-[10px] text-blue-200 block text-right mt-1">
                            {{ $message->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>
            @else
                {{-- MESSAGGIO RICEVUTO (A SINISTRA) --}}
                <div class="flex justify-start mb-4 w-full">
                    <div
                        class="bg-white border border-gray-200 text-gray-800 px-4 py-2 rounded-2xl rounded-tl-none max-w-[85%] md:max-w-[70%] shadow-sm">
                        <p class="text-sm leading-relaxed break-words">{{ $message->content }}</p>
                        <span class="text-[10px] text-gray-400 block mt-1">
                            {{ $message->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        {{-- STATO VUOTO --}}
        <div class="flex-1 flex flex-col items-center justify-center opacity-70">
            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <p class="text-gray-500 text-sm font-medium">Inizia la conversazione!</p>
            <p class="text-gray-400 text-xs mt-1">Chiedi informazioni su questo articolo.</p>
        </div>
    @endif
</div>

<!-- Form invio messaggio -->
<div class="p-3 border-t border-gray-200 bg-white shrink-0">
    <form id="chat-form" action="{{ route('Backoffice.sendMessage') }}" method="POST" class="flex gap-2 items-end">
        @csrf

        <input type="hidden" id="conversation_id" name="conversation_id" value="{{ $conversation->id }}">
        <input type="hidden" id="sender_id" name="sender_id" value="{{ auth()->id() }}">

        <textarea id="message-input" name="content" rows="1" placeholder="Scrivi un messaggio..." required
            class="flex-1 max-h-24 px-4 py-2.5 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none overflow-hidden"
            oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white p-2.5 md:px-6 rounded-full md:rounded-2xl font-medium transition duration-200 flex items-center justify-center shadow-sm h-[42px]">
            <span class="hidden md:inline">Invia</span>
            <svg class="w-5 h-5 md:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
        </button>
    </form>
</div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Variabili globali
        const conversationId = {{ $conversation->id }};
        const currentUserId = {{ auth()->id() }};
        const messagesContainer = document.getElementById('messages-container');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');

        // Scroll automatico all'avvio
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // 2. ASCOLTO LIVE CON REVERB (Laravel Echo)
        if (typeof window.Echo !== 'undefined' && conversationId) {

            console.log('📡 Sottoscrizione al canale privato: chat.' + conversationId);

            // Usiamo leave() invece di leaveAll() per pulire solo questo canale specifico se necessario
            window.Echo.leave(`chat.${conversationId}`);

            window.Echo.private(`chat.${conversationId}`)
                .listen('.message.sent', (e) => {
                    console.log("📩 Messaggio ricevuto live:", e);
                    // Aggiungiamo al DOM solo se il mittente non è l'utente corrente
                    if (e.message.sender_id != currentUserId) {
                        appendMessage(e.message, false);
                    }
                })
                .error((error) => {
                    console.error('❌ Errore connessione Reverb:', error);
                });
        } else {
            console.warn('⚠️ Laravel Echo non è inizializzato o manca conversationId.');
        }

        // 3. INVIO MESSAGGIO
        if (chatForm) {
            // Invio con tasto Enter
            messageInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    chatForm.dispatchEvent(new Event('submit'));
                }
            });

            chatForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const content = messageInput.value.trim();
                if (!content) return;

                // Aggiunta ottimistica (nostro messaggio a schermo subito)
                const myData = {
                    content: content,
                    sender_id: currentUserId,
                    created_at: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
                };
                appendMessage(myData, true);

                // Reset input
                messageInput.value = '';
                messageInput.style.height = '';

                // Chiamata AJAX al server
                const url = chatForm.getAttribute('action');
                const token = document.querySelector('input[name="_token"]').value;

                fetch(url, {
                    method: 'POST',
                    keepalive: true, // Impedisce al browser di terminare la richiesta prematuramente
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        content: content,
                        conversation_id: conversationId,
                        sender_id: currentUserId
                    })
                })
                    .then(async response => {
                        // Verifichiamo se la risposta è ok (status 200-299)
                        if (!response.ok) {
                            const errorData = await response.json().catch(() => ({}));
                            throw new Error(errorData.message || `Errore Server: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('✅ Messaggio inviato con successo:', data);
                    })
                    .catch(error => {
                        // Se qui leggi ancora "NetworkError", Zen sta bloccando la porta 8080
                        console.error('❌ Errore dettagliato:', error.name, error.message);

                        if (error.message.includes('fetch')) {
                            console.warn('⚠️ Zen Browser ha bloccato la risposta. Controlla se hai estensioni anti-tracciamento attive.');
                        }
                    });
            });
        }

        // 4. FUNZIONE HELPER PER AGGIUNGERE MESSAGGI AL DOM
        function appendMessage(message, isMe) {
            if (!messagesContainer) return;

            const align = isMe ? 'justify-end' : 'justify-start';
            const bg = isMe ? 'bg-blue-600 text-white' : 'bg-white border border-gray-200 text-gray-800';
            const rounded = isMe ? 'rounded-tr-none' : 'rounded-tl-none';
            const timeColor = isMe ? 'text-blue-200' : 'text-gray-400';

            const html = `
                <div class="flex ${align} mb-4 w-full">
                    <div class="${bg} px-4 py-2 rounded-2xl ${rounded} max-w-[85%] md:max-w-[70%] shadow-sm">
                        <p class="text-sm leading-relaxed break-words">${message.content}</p>
                        <span class="text-[10px] ${timeColor} block ${isMe ? 'text-right' : ''} mt-1">
                            ${message.created_at}
                        </span>
                    </div>
                </div>
            `;

            messagesContainer.insertAdjacentHTML('beforeend', html);

            // Scroll fluido verso il basso
            messagesContainer.scrollTo({
                top: messagesContainer.scrollHeight,
                behavior: 'smooth'
            });
        }
    });
</script>
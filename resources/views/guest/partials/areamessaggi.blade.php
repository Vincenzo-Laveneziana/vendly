<!-- AREA MESSAGGI -->
            <div id="messages-container" class="flex-1 p-4 overflow-y-auto bg-gray-50">
                @if (isset($messages) && $messages->count() > 0)
                    @foreach ($messages as $message)
                        @if ($message->user_id === auth()->id())
                            <div class="flex justify-end mb-4">
                                <div class="bg-blue-600 text-white px-4 py-2 rounded-2xl rounded-tr-none max-w-[85%] md:max-w-[70%] shadow-sm">
                                    <p class="text-sm leading-relaxed">{{ $message->content }}</p>
                                    <span class="text-[10px] text-blue-200 block text-right mt-1">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-start mb-4">
                                <div class="bg-white border border-gray-200 text-gray-800 px-4 py-2 rounded-2xl rounded-tl-none max-w-[85%] md:max-w-[70%] shadow-sm">
                                    <p class="text-sm leading-relaxed">{{ $message->content }}</p>
                                    <span class="text-[10px] text-gray-400 block mt-1">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="h-full flex flex-col items-center justify-center opacity-70">
                        <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="text-gray-500 text-sm font-medium">Inizia la conversazione!</p>
                        <p class="text-gray-400 text-xs mt-1">Chiedi informazioni su questo articolo.</p>
                    </div>
                @endif
            </div>

            <!-- Form invio messaggio -->
            <div class="p-3 border-t border-gray-200 bg-white shrink-0">
                <form id="chat-form" action="{{ route('inviaMessaggio') }}" method="POST" class="flex gap-2 items-end">
                    @csrf
                    
                    <input type="hidden" id="conversation_id" name="conversation_id" value="{{ $conversation->id }}">
                    <input type="hidden" id="sender_id" name="sender_id" value="{{ auth()->id() }}">

                    <textarea id="message-input" name="content" rows="1" placeholder="Scrivi un messaggio..." required
                            class="flex-1 max-h-24 px-4 py-2.5 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none overflow-hidden"
                            oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                    
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-2.5 md:px-6 rounded-full md:rounded-2xl font-medium transition duration-200 flex items-center justify-center shadow-sm h-[42px]">
                        <span class="hidden md:inline">Invia</span>
                        <svg class="w-5 h-5 md:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>
</div>
            
        </div>

        <script>
            const conversationId = {{ $conversation->id }};
            const messagesContainer = document.querySelector('.overflow-y-auto'); 
            const chatForm = document.getElementById('chat-form');
            const messageInput = document.getElementById('message-input');
            const messagesContainer = document.getElementById('messages-container');
            const convId = document.getElementById('conversation_id').value;
            const sendId = document.getElementById('sender_id').value;
            const url = chatForm.getAttribute('action');
            const token = document.querySelector('input[name="_token"]').value;

            if (chatForm) {
                // Gestione invio col tasto "Invio" (senza shift)
                messageInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault(); // Evita di andare a capo
                        chatForm.dispatchEvent(new Event('submit')); // Lancia il submit
                    }
                });

                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // FERMA il ricaricamento della pagina!

                    const content = messageInput.value.trim();
                    if (!content) return;

                    // 1. Aggiungiamo subito il messaggio alla UI (Aggiornamento ottimistico)
                    const timeNow = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    const myMessageHtml = `
                        <div class="flex justify-end mb-4">
                            <div class="bg-blue-600 text-white px-4 py-2 rounded-2xl rounded-tr-none max-w-[85%] md:max-w-[70%] shadow-sm">
                                <p class="text-sm leading-relaxed">${content}</p>
                                <span class="text-[10px] text-blue-200 block text-right mt-1">${timeNow}</span>
                            </div>
                        </div>
                    `;
                    messagesContainer.insertAdjacentHTML('beforeend', myMessageHtml);

                    // Scrolliamo giù
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;

                    // Svuotiamo l'input e resettiamo l'altezza
                    messageInput.value = '';
                    messageInput.style.height = ''; 

                    // 2. Inviamo i dati al server in background
                    const url = chatForm.getAttribute('action');
                    const token = document.querySelector('input[name="_token"]').value;

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        // AGGIUNTI I PARAMETRI QUI SOTTO:
                        body: JSON.stringify({ 
                            content: content,
                            conversation_id: convId,
                            sender_id: sendId 
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            console.error("Errore nel salvataggio");
                            // In un'app reale qui potresti mostrare un messaggino "Invio fallito"
                        }
                    })
                    .catch(error => {
                        console.error("Errore di rete:", error);
                    });
                });
            }

            function fetchMessages() {
                fetch(`/chat/${conversationId}/messages`)
                    .then(response => response.json())
                    .then(data => {
                    })
                    .catch(error => console.error('Errore nel polling:', error));
            }

            // Avvia il polling ogni 5000 millisecondi (5 secondi)
            setInterval(fetchMessages, 5000);
        </script>
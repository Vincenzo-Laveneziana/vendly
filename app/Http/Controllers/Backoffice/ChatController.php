<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;

class ChatController extends Controller
{
    /**
     * Mostra la pagina chat (solo sidebar, nessuna conversazione selezionata).
     */
    public function index()
    {
        return view('backoffice.chat.privateChat', [
            'product' => null,
            'seller' => null,
            'conversation' => null,
            'messages' => collect(),
            'buyer' => auth()->user(),
            'conversations' => $this->getUserConversations(),
            'titoloProdotto' => 'chat',
        ]);
    }

    /**
     * Mostra una conversazione specifica.
     */
    public function show(Conversation $conversation)
    {
        $conversation->load(['product', 'seller', 'buyer']);

        $messages = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('backoffice.chat.privateChat', [
            'product' => $conversation->product,
            'seller' => $conversation->seller,
            'conversation' => $conversation,
            'messages' => $messages,
            'buyer' => auth()->user(),
            'conversations' => $this->getUserConversations(),
            'titoloProdotto' => $conversation->product?->title ?? 'chat',
        ]);
    }

    /**
     * Crea (o trova) una conversazione partendo da un prodotto e invia il primo messaggio.
     */
    public function store(Product $product, string $message)
    {
        $seller = $product->user;
        $user = auth()->user();

        if ($user->id === $seller->id) {
            return redirect()->back()->with('error', 'message.error_chat_self');
        }

        $conversation = Conversation::firstOrCreate([
            'product_id' => $product->id,
            'buyer_id' => $user->id,
            'seller_id' => $seller->id,
        ]);

        Message::create([
            'content' => $message,
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
        ]);

        return redirect()->route('Backoffice.chat.show', $conversation);
    }

    /**
     * Invia un nuovo messaggio in una conversazione esistente (AJAX).
     */
    public function sendMessage(MessageRequest $request)
    {
        $message = Message::create($request->validated());

        $message->load('conversation');

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => [
                'content' => $message->content,
            ],
        ]);
    }

    /**
     * Recupera tutti i messaggi di una conversazione (API JSON).
     */
    public function getMessages(Conversation $conversation)
    {
        $messages = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Recupera le conversazioni dell'utente loggato per la sidebar.
     */
    private function getUserConversations()
    {
        return Conversation::where('buyer_id', auth()->id())
            ->orWhere('seller_id', auth()->id())
            ->with(['product', 'seller', 'buyer'])
            ->orderBy('updated_at', 'desc')
            ->get();
    }
}

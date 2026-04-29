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

    public function show($idProdotto = null, $idConversazione = null, $message = null)
    {
        // 1. Variabili sempre presenti (Sidebar e Utente Loggato)
        $conversations = $this->getUserConversations();
        $buyer = auth()->user();

        // 2. Inizializziamo a null le variabili della finestra chat
        $product = null;
        $seller = null;
        $conversation = null;
        $messages = collect(); // Collezione vuota invece di null per evitare errori nei cicli foreach

        // 3. Logica di recupero se i parametri sono presenti
        if ($idConversazione && $idConversazione !== 'null') {
            // Caso: Chat specifica aperta dalla sidebar
            $conversation = Conversation::with(['product', 'seller', 'buyer'])->find($idConversazione);

            if ($conversation) {
                $product = $conversation->product;
                $seller = $conversation->seller;
                $messages = Message::where('conversation_id', $conversation->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        } elseif ($idProdotto) {
            // Caso: Cliccato "Contatta" da un prodotto (senza avere ancora una conversazione) chiama la funzione create()
            $productModel = Product::findOrFail($idProdotto);
            return $this->create($productModel, $message);
        }

        $titoloProdotto = 'chat';

        if ($product) {
            $titoloProdotto = $product->title;
        }

        // Passiamo tutto alla vista. Se non c'è una chat attiva, 
        // le variabili saranno null (o una collezione vuota) ma "esistenti".
        return view('backoffice.chat.privateChat', compact(
            'product',
            'seller',
            'conversation',
            'messages',
            'buyer',
            'conversations',
            'titoloProdotto'
        ));
    }

    /**
     * Funzione per la lista sidebar
     */
    private function getUserConversations()
    {
        return Conversation::where('buyer_id', auth()->id())
            ->orWhere('seller_id', auth()->id())
            ->with(['product', 'seller', 'buyer'])
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    /**
     * Funzione per creare/trovare una chat da un prodotto
     */
    private function create(Product $product, $message)
    {
        $seller = $product->user;
        $user = auth()->user();

        if ($user->id === $seller->id) {
            return redirect()->back()->with('error', 'message.error_chat_self');
        }

        $conversation = Conversation::firstOrCreate([
            'product_id' => $product->id,
            'buyer_id' => $user->id,
            'seller_id' => $seller->id
        ]);

        $newMessage = new Message();
        $newMessage->content = $message;
        $newMessage->conversation_id = $conversation->id;
        $newMessage->sender_id = $user->id;
        $newMessage->save();

        return redirect()->route('Backoffice.createChat', [
            'idProdotto' => $product->id,
            'idConversazione' => $conversation->id
        ]);
    }

    public function sendMessage(MessageRequest $request)
    {
        $message = Message::create($request->validated());

        // Forza il caricamento delle relazioni se le usi nell'evento
        $message->load('conversation');

        // Lancia l'evento
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => [
                'content' => $message->content,
            ]
        ]);
    }

    public function getMessages(Conversation $conversation)
    {
        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }
}

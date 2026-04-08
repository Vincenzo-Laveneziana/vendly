<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Conversation;
use App\Models\Message;
use App\Http\Requests\MessageRequest;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;

class ChatController extends Controller
{
    public function showChat($idProdotto = null, $idConversazione = null)
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
        if ($idConversazione) {
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
            // Caso: Cliccato "Contatta" da un prodotto (senza avere ancora una conversazione)
            return $this->initiateNewConversation($idProdotto);
        }

        // Passiamo tutto alla vista. Se non c'è una chat attiva, 
        // le variabili saranno null (o una collezione vuota) ma "esistenti".
        return view('guest.pages.chatPrivata', compact(
            'product', 
            'seller', 
            'conversation', 
            'messages', 
            'buyer', 
            'conversations'
        ));
    }

    /**
     * Funzione di supporto per la lista sidebar
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
     * Funzione di supporto per creare/trovare una chat da un prodotto
     */
    private function initiateNewConversation($productId)
    {
        $product = Product::with('user')->findOrFail($productId);
        $seller = $product->user;
        $user = auth()->user();

        if ($user->id === $seller->id) {
            return redirect()->back()->with('error', 'Non puoi avviare una conversazione con te stesso.');
        }

        $conversation = Conversation::firstOrCreate([
            'product_id' => $product->id,
            'buyer_id'   => $user->id,
            'seller_id'  => $seller->id
        ]);

        return redirect()->route('chat', [
            'idProdotto' => $product->id, 
            'idConversazione' => $conversation->id
        ]);
    }

    private function loadExistingConversation(Conversation $conversation, $conversations)
    {
        $product = $conversation->product;
        $seller = $conversation->seller;
        
        $messages = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('guest.pages.chatPrivata', compact('product', 'seller', 'conversation', 'messages', 'buyer'));
    }

    public function sendMessage(MessageRequest $request)
    {
        $message = Message::create($request->validated());

        // Forza il caricamento delle relazioni se le usi nell'evento
        $message->load('conversation');

        // Lancia l'evento
        broadcast(new \App\Events\MessageSent($message))->toOthers();

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function getMessages(Conversation $conversation)
    {
        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }
}

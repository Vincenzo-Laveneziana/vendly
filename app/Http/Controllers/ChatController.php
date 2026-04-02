<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Conversation;
use App\Models\Message;
use App\Http\Requests\MessageRequest;
use App\Models\User;

class ChatController extends Controller
{
   public function showChat($ProductId, Conversation $conversation)
    {
        if($conversation!== null){
            $product = Product::with(['user', 'images'])->findOrFail($ProductId);
            $seller = $product->user;
            if($seller == auth()->user()){
                $buyer = User::findOrFail($conversation->buyer_id);
            } 

           // Trova o crea la conversazione
            $conversation = Conversation::firstOrCreate([
                'product_id' => $ProductId, 
                'buyer_id'   => $buyer->id, 
                'seller_id'  => $seller->id
            ]);
        } else {
            $buyer = auth()->user();
        }
        

        // 1. OTTIMIZZAZIONE: Facciamo un'unica query per prodotto, utente(venditore) e immagini
        $product = Product::with(['user', 'images'])->findOrFail($ProductId);
        $seller = $product->user;

        // Controllo sicurezza
        if ($buyer->id === $seller->id) {
            return redirect()->back()->with('error', 'Non puoi avviare una conversazione con te stesso.');
        }

        // Trova o crea la conversazione
        $conversation = Conversation::firstOrCreate([
            'product_id' => $ProductId, 
            'buyer_id'   => $buyer->id, 
            'seller_id'  => $seller->id
        ]);

        // Recupera i messaggi ordinati dal più vecchio al più nuovo (per la vista chat)
        $messages = Message::where('conversation_id', $conversation->id)
                        ->orderBy('created_at', 'asc')
                        ->get();

        // 2. CORREZIONE RELAZIONI: Uso 'product' invece di 'post' e carico gli utenti
        // 3. ORDINAMENTO: Aggiunto orderBy per mostrare le chat più recenti in alto
        $conversations = Conversation::with(['product', 'buyer', 'seller'])
            ->where(function ($query) use ($buyer) {
                $query->where('buyer_id', $buyer->id)
                    ->orWhere('seller_id', $buyer->id);
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('guest.pages.chatPrivata', compact('product', 'seller', 'conversation', 'messages', 'buyer', 'conversations'));
    }

    public function sendMessage(MessageRequest $request)
    {
        $savedMessage = Message::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $savedMessage
            ]);
        }

        $conversation = Conversation::findOrFail($request->conversation_id);
        $seller = User::findOrFail($conversation->seller_id);
        $buyer = User::findOrFail($conversation->buyer_id);
        $product = Product::with('images')->findOrFail($conversation->product_id);
       
        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'asc')->get();


        return view('guest.pages.chatPrivata', compact('product', 'seller', 'conversation', 'messages', 'buyer'));
    }

    public function getMessages(Conversation $conversation)
    {
        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }
}

<?php

namespace App\Http\Controllers\Backoffice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create(CreateProductRequest $request)
    {
        // 1. Validazione (Se fallisce, Laravel invierà automaticamente un errore 422 JSON)
        $data = $request->validated();

        $value = true;
        $messaggio = "message.product_created";

        // 2. Creazione Prodotto
        $data['user_id'] = Auth::id();
        $product = Product::create($data);

        if (!$product) {
            $value = false;
            $messaggio = "message.error_while_upload";
        } else {
            // 3. Gestione Immagini
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('products', 'public');

                        $product->images()->create([
                            'path' => $path,
                            'alt_text' => $product->title,
                        ]);
                    }
                }
            }
        }

        // Flasiamo in sessione per il Toast nella pagina successiva
        session()->flash('success', $value);
        session()->flash('message', $messaggio);

        return response()->json([
            'success' => $value,
            'message' => $messaggio,
        ], 200);
    }

    public function addFavorite(Product $product)
    {
        $user = auth()->user();
        $isFavorite = $user->favorites()->where('product_id', $product->id)->exists();

        if ($isFavorite) {
            $user->favorites()->detach($product->id);
            $message = __('message.remove_favorite');
        } else {
            $user->favorites()->attach($product->id);
            $message = __('message.add_favorite');
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'isFavorite' => !$isFavorite
        ], 200);
    }

    // VISUALIZZA PAGINA DI ACQUISTO E GLI PASSO IL PRODOTTO
    public function showBuy(Product $product)
    {
        return view('backoffice.buy.buy', compact('product'));
    }

    // ACQUISTO DI UN PRODOTTO

    public function buy(Request $request, Product $product)
    {
        // Validazione dei dati
        $request->validate([
            'shipping.firstName' => 'required|string|max:50',
            'shipping.lastName' => 'required|string|max:50',
            'shipping.street' => 'required|string|max:100',
            'shipping.city' => 'required|string|max:50',
            'shipping.zip' => 'required|string|max:20',
            'shipping.email' => 'required|email',
            'shipping.phone' => 'required|string|max:20',

            'billing.firstName' => 'required|string|max:50',
            'billing.lastName' => 'required|string|max:50',
            'billing.street' => 'required|string|max:100',
            'billing.city' => 'required|string|max:50',
            'billing.zip' => 'required|string|max:20',

            'paymentMethod' => 'required|in:cash,apple,google,card',

            // Validazione condizionale per la carta
            'card.number' => 'required_if:paymentMethod,card',
            'card.expiry' => 'required_if:paymentMethod,card',
            'card.cvv' => 'required_if:paymentMethod,card',
            'card.name' => 'required_if:paymentMethod,card',
        ]);

        // Recuperiamo l'ultimo numero d'ordine in modo sicuro
        $latestOrder = Order::latest('id')->first();
        $nextNumber = 1;

        if ($latestOrder) {
            $parts = explode('-', $latestOrder->order_number);
            $nextNumber = (int) end($parts) + 1;
        }

        $order_number = 'VDL-' . date('Y') . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Controllo prodotto già venduto
        if ($product->sold_at) {
            return response()->json([
                'success' => false,
                'message' => __('message.error_checkout'),
            ]);
        }

        // 1. Creazione Ordine
        $order = new Order();
        $order->order_number = $order_number;
        $order->product_id = $product->id;
        $order->user_id = auth()->id();
        $saved = $order->save();

        if (!$saved) {
            return response()->json([
                'success' => false,
                'message' => __('message.error_checkout'),
            ]);
        }

        // 2. Aggiornamento Prodotto (solo se ordine creato correttamente)
        $product->sold_at = now();
        $saved = $product->save();

        if (!$saved) {
            $order->delete();
            return response()->json([
                'success' => false,
                'message' => __('message.error_checkout'),
            ]);
        }


        return response()->json([
            'success' => true,
            'redirect' => route('Backoffice.confirmBuy', $order),
        ]);
    }
}

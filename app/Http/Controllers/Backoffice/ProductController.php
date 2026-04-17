<?php

namespace App\Http\Controllers\Backoffice;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class ProductController extends Controller
{
    public function create(CreateProductRequest $request)
    {
        // 1. Validazione (Se fallisce, Laravel invierà automaticamente un errore 422 JSON)
        $data = $request->validated();

        $value = true;
        $messaggio = "Prodotto creato con successo";

        // 2. Creazione Prodotto
        $data['user_id'] = Auth::id();
        $product = Product::create($data);

        if (!$product) {
            $value = false;
            $messaggio = "Errore durante la creazione del prodotto";
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
            $message = 'Prodotto rimosso dai preferiti!';
        } else {
            $user->favorites()->attach($product->id);
            $message = 'Prodotto aggiunto ai preferiti!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'isFavorite' => !$isFavorite
        ], 200);
    }

}

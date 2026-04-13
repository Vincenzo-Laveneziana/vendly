<?php

namespace App\Http\Controllers\Backoffice;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(CreateProductRequest $request)
    {
        // 1. Validazione (Se fallisce, Laravel invierà automaticamente un errore 422 JSON)
        $data = $request->validated();

        try {
            // 2. Creazione Prodotto
            $data['user_id'] = Auth::id();
            $product = Product::create($data);

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

            return response()->json([
                'success' => true,
                'message' => 'Prodotto creato con successo!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore durante il salvataggio: ' . $e->getMessage()
            ], 500);
        }
    }

}

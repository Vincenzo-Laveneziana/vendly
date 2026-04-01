<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $save = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                // VERIFICA SE IL FILE È VALIDO E SE ESISTE ANCORA

                if ($file && $file->isValid()) {
                    $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('products'), $filename);
                    
                    $save->images()->create([
                        'path' => 'products/' . $filename,
                        'alt_text' => $save->title,
                    ]);
                }
            }
        }

        return redirect()->route('home')->with('success', 'Annuncio creato!');
    }

    public function show()
    {
        $products = Product::with('images')->latest()->simplePaginate(4);
        
        return view('guest.pages.home', compact('products'));
    }

    public function showAll()
    {
        // Recupera tutti i post con le immagini, ordinati per data di creazione
        $products = Product::with('images')->latest()->get();

        $categories = Product::getCategoriesFromJson();
        
        return view('guest.pages.esplora', compact('products','categories'));
    }

    public function showProduct()
    {
        $product = Product::with('images')->findOrFail(request('id'));

        $user = $product->user;

        $products = Product::with('images')->latest()->simplePaginate(4);
        
        return view('guest.pages.prodotto', compact('product', 'user', 'products'));
    }
}

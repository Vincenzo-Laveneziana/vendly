<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $save = Product::create($data);

        

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('products', 'public');
                    
                    $save->images()->create([
                        'path' => $path, // Salverà una stringa tipo "products/nomefile.jpg"
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

    public function showUserProducts()
    {
        // Recupera tutti i post con le immagini, ordinati per data di creazione
        $products = Product::with('images')->where('user_id', Auth::id())->latest()->get();
        
        return view('guest.pages.profilo', compact('products'));
    }
}

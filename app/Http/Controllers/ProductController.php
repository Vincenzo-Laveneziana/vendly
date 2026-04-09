<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
                        'path' => $path,
                        'alt_text' => $save->title,
                    ]);
                }
            }
        }

        return redirect()->route('profilo')->with('status', 'Utente aggiornato con successo.');
    }

    public function show()
    {
        $products = Product::with('images')->latest()->simplePaginate(6);

        return view('guest.pages.home', compact('products'));
    }

    public function showAll()
    {
        // Recupera tutti i post con le immagini, ordinati per data di creazione
        $products = Product::with('images')->latest()->get();

        $categories = Product::getCategoriesFromJson();

        return view('guest.pages.esplora', compact('products', 'categories'));
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

    public function filtri(Request $request)
    {
        $category = $request->query('category');
        $sort = $request->query('sort');
        $search = $request->query('search');

        $products = Product::with('images')->get();

        $products = $products
            ->when($category, fn($c) => $c->where('category', $category))
            ->when($search, fn($c) => $c->filter(
                fn($p) => str_contains(strtolower($p->title), strtolower($search))
            ))
            ->when($sort === 'price_asc', fn($c) => $c->sortBy('price'))
            ->when($sort === 'price_desc', fn($c) => $c->sortByDesc('price'))
            ->when(!$sort, fn($c) => $c->sortByDesc('created_at'))
            ->values();

        $categories = Product::getCategoriesFromJson();

        return view('guest.pages.esplora', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        $search = $request->query('query');

        $products = Product::with('images')->where('title', 'like', "%$search%")->get();

        $categories = Product::getCategoriesFromJson();

        return view('guest.pages.esplora', compact('products', 'categories'));
    }

}

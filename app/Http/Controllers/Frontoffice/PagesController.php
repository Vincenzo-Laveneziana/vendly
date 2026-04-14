<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function index(Product $products)
    {
        $products = $products->latest()->simplePaginate(6);

        return view('frontoffice.home', compact('products'));
    }

    public function show(Product $product)
    {
        // Recupera tutti i post con le immagini, ordinati per data di creazione
        $products = $product->latest()->get();

        $categories = Product::categories();

        return view('frontoffice.products.explore', compact('products', 'categories'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $user = $product->user;

        $products = $product->latest()->simplePaginate(3);

        return view('frontoffice.products.product', compact('product', 'user', 'products'));
    }

    public function search(Request $request)
    {
        $search = $request->query('query');

        $products = Product::with('images')->where('title', 'like', "%$search%")->get();

        $categories = Product::categories();

        return view('frontoffice.products.explore', compact('products', 'categories'));
    }
}

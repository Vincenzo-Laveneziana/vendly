<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function index()
    {
        $products = Product::latest()->whereNull('sold_at')->simplePaginate(8);

        return view('frontoffice.home', compact('products'));
    }

    public function show()
    {
        // Recupera tutti i post con le immagini, ordinati per data di creazione e non venduti
        $products = Product::latest()->whereNull('sold_at')->paginate(12);

        $categories = Product::categories();

        return view('frontoffice.products.explore', compact('products', 'categories'));
    }

    public function product(Product $product)
    {
        $user = $product->user;

        $products = Product::latest()->whereNull('sold_at')->where('id', '!=', $product->id)->simplePaginate(4);

        return view('frontoffice.products.product', compact('product', 'user', 'products'));
    }

    public function search(Request $request)
    {
        $search = $request->query('query');

        $products = Product::with('images')
            ->whereNull('sold_at')
            ->where('title', 'like', "%$search%")
            ->paginate(12);

        $categories = Product::categories();

        return view('frontoffice.products.explore', compact('products', 'categories'));
    }
}

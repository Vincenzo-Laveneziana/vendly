<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function createPost(CreatePostRequest $request)
    {
        $request->validated();

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Salva il file direttamente in public/posts/
                $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('posts'), $filename);
                $path = 'posts/' . $filename;

                // Salva nel database usando la relazione
                $post->images()->create([
                    'path' => $path,
                    'alt_text' => $post->title,
                ]);
            }
        }

        return redirect()->route('home')->with('success', 'Annuncio creato con successo!');

    }

    public function show()
    {
        $posts = Post::with('images')->latest()->simplePaginate(4);
        
        return view('guest.pages.home', compact('posts'));
    }

    public function showAll()
    {
        // Recupera tutti i post con le immagini, ordinati per data di creazione
        $posts = Post::with('images')->latest()->get();

        $categories = Post::getCategoriesFromJson();
        
        return view('guest.pages.esplora', compact('posts','categories'));
    }

    public function showProduct()
    {
        $post = Post::with('images')->findOrFail(request('id'));

        $user = $post->user;

        $posts = Post::with('images')->latest()->simplePaginate(4);
        
        return view('guest.pages.prodotto', compact('post', 'user', 'posts'));
    }
}

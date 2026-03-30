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
        
        // Aggiungi image_url incluso nella serializzazione
        $posts->getCollection()->transform(function ($post) {
            $post->images->each(function ($image) {
                // Forza la valutazione dell'accessor nell'array di attributi
                $image->setAttribute('image_url', $image->image_url);
            });
            return $post;
        });
        
        return view('guest.pages.home', compact('posts'));
    }
}

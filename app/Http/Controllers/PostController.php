<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use GuzzleHttp\Promise\Create;

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
                // Salva il file nella cartella 'posts' dentro storage/app/public
                $path = $file->store('posts', 'public');

                // Salva nel database usando la relazione
                $post->images()->create([
                    'path' => $path,
                    'alt_text' => $post->title, // Usiamo il titolo come alt text di default
                ]);
            }
        }

        return redirect()->route('home')->with('success', 'Annuncio creato con successo!');

    }
}

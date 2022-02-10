<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    // Post Archive
    public function index() {

        // tutti i post
        // $post = Post::all();

        // con paginazione
        $posts = Post::paginate(3);

        return response()->json($posts);
    }

    // POST DETAIL

    public function show($slug) {
        // prendere post by slug senza categorie e tags
        // $post = Post::where('slug', $slug)->first();

        // prendere post by slug con categorie e tags
         $post = Post::where('slug', $slug)->with('category', 'tags')->first();
            
        // ritorno dati in json
        return response()->json($post);
    }
}
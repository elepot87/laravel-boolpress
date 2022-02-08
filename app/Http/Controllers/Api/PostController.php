<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    // Post Archive
    public function index() {

        $post = Post::all();

        return response()->json($post);
    }
}
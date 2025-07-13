<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        return view('home');
    }

    public function blog(){
        return view('blog', ['posts' => Post::all()->sortByDesc('created_at')]);
    }

    public function blogview(Request $request, string $slug){
        $post = Post::where('slug', $slug)->first();
        if(!$post) abort(404);

        return view('blogview', ['post' => $post]);
    }

    public function faq(){
        return view('faq');
    }
}

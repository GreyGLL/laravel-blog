<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function show($postUrl)
    {
        $postLang = \DB::table("post_language")
            ->where("url", $postUrl)->first();
        $post = Post::find($postLang->post_id);
        return view('posts.show')->with('post', $post);
    }
}

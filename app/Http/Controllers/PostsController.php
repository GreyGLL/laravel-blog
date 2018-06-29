<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Language;

class PostsController extends Controller
{
    public function show($postUrl)
    {
        $languages = Language::all();
        $url = [];
        foreach ($languages as $language) {
            $url[$language->code] = $language->code."/".__("routes.posts")."/".$postUrl;
        }

        $postLang = \DB::table("post_language")
            ->where("url", $postUrl)->first();
        $post = Post::find($postLang->post_id);
        return view('posts.show')->with('post', $post)->with('url', $url);
    }
}

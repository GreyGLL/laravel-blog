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

        $postLang = \DB::table("post_language")
        ->where("url", $postUrl)->first();

        $post = Post::find($postLang->post_id);

        $urls = $post->languages()->get();

         $languageUrls = [];
         foreach ($languages as $language) {
             $postRoute = "";
             if ($language->code == "es") {
                $postRoute = "articulos";
             } else {
                $postRoute = "posts";
             }
             $languageUrls[$language->code] = $language->code."/".$postRoute."/".$urls->where('code',$language->code)->first()->getOriginal('pivot_url');
         }

        return view('posts.show', compact(['post', 'languageUrls']));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index')->with('posts',$posts);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required']);

        Post::create(['title' => $request->title]);

        $post = Post::create($request->only('title') );

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact(['categories', 'tags','post']));

    }

    public function update(Post $post, Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'extract' => 'required',
            'tags' => 'required']);

        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->content = $request->content;
        $post->extract = $request->extract;
        $post->published_at = $request->has('published_at') ? Carbon::parse($request->published_at) : null;
        $post->category_id = Category::find( $category = $request->category) ? $category
        : Category::create(['name' => $category])->id;
        $post->save();

        $tags = [];

        foreach ($request->tags as $tag)
        {
            $tags[] = Tag::find($tag) ? $tag :Tag::create(['name' => $tag])->id;
        }

        $post->tags()->sync($tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicación ha sido guardada');
    }
}
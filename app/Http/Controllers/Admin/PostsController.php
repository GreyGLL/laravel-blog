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

    // public function create()
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();

    //     return view('admin.posts.create')->with('categories',$categories)->with('tags',$tags);
    // }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required']);

        $post = Post::create([
            'title' => $request->title,
            'url' => str_slug($request->title),
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit')->with('categories',$categories)->with('tags',$tags)->with('post',$Post);
    }

    public function update(Post $post, Request $request)
    {
        // validación
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'category' => 'required',
            'extract' => 'required',
            'tags' => 'required'
        ]);
        // return Post::create($request->all());
        $post->title = $request->title;
        $post->url = str_slug($request->title);
        $post->subtitle = $request->subtitle;
        $post->content = $request->content;
        $post->extract = $request->extract;
        $post->published_at = $request->has('published_at') ? Carbon::parse($request->published_at) : null;
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicación ha sido guardada');
        // return $request->all();
    }
}



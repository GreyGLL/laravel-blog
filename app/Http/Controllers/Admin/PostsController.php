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

     public function create()
     {

        $categories = Category::all();
        $tags = Tag::all();

       return view('admin.posts.create', compact(['categories', 'tags']));
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->content = $request->content;
        $post->extract = $request->extract;
        $post->published_at = Carbon::parse($request->published_at);
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->attach($request->tags);

        return back()->with('flash', 'Tu publicación ha sido creada');
    }

    //     $this->validate($request, ['title' => 'required']);

    //     $post = Post::create(
    //         $request->only('title')
    //     );

    //     return redirect()->route('admin.posts.edit', $post);
    // }

    // public function edit(Post $post)
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();

    //     return view('admin.posts.edit')->with('categories',$categories)->with('tags',$tags)->with('post',$post);
    // }

    // public function update(Post $post, Request $request)
    // {
    //     // validación
    //     $this->validate($request, [
    //         'title' => 'required',
    //         'body'  => 'required',
    //         'category' => 'required',
    //         'extract' => 'required',
    //         'tags' => 'required'
    //     ]);
    //     // return Post::create($request->all());
    //     $post->title = $request->title;
    //     $post->subtitle = $request->subtitle;
    //     $post->content = $request->content;
    //     $post->extract = $request->extract;
    //     $post->published_at = $request->has('published_at') ? Carbon::parse($request->published_at) : null;
    //     $post->category_id = Category::find($cat = $request->category)
    //                             ? $cat
    //                             : Category::create(['name' => $cat])->id;
    //     $post->save();

    //     $tags = [];

    //     foreach ($request->tags as $tag)
    //     {
    //         $tags[] = Tag::find($tag)
    //                     ? $tag
    //                     : Tag::create(['name' => $tag])->id;
    //     }

    //     $post->tags()->sync($tags);

    //     return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicación ha sido guardada');
    //     // return $request->all();
    // }
}



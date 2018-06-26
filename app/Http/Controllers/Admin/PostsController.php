<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Language;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index')->with('posts', $posts);
    }

    public function create(Request $request)
    {
        // Acceder a idiomas disponibles en la tabla language

        $languages = Language::all();
        if ($request->lang_id) {
            $lang_id = $request->lang_id;
        } else {
            $lang_id = 1;
        } // hacer un if
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact(['categories', 'tags', 'lang_id', 'languages'])); // Pasarlos a la vista

    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, ['title' => 'required']);

    //     Post::create(['title' => $request->title]);

    //     $post = Post::create($request->only('title') );

    //     return redirect()->route('admin.posts.edit', $post);
    // }

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

    public function store(Request $request)
    {

        //dd($request->all());
        // try {
        //     $request->validate([
        //         'title' => 'required',
        //         'content' => 'required',
        //         'category' => 'required',
        //         'extract' => 'required',
        //         'tags' => 'required',
        //         'image' => 'required|image|max:2048']);
        // } catch (\Exception $e) {
        //     echo $e->getMessage();
        //     exit();
        // }

        //dd($request->all());
        $lang_id = $request->lang_id;

        //dd($lang_id);

        $published_at = $request->has('published_at') ? Carbon::parse($request->published_at) : null;
        if (Category::find($request->category)) {
            $category_id = $request->category;
        } else {
            $category_id = Category::create(['name' => $category])->id;
        }

        $post = Post::create(['published_at' => $published_at, 'category_id' => $category_id ]);


        $post->languages()->syncWithoutDetaching([
            $lang_id => ['title' => $request->title, 'subtitle' => $request->subtitle, 'content' => $request->content, 'extract' => $request->extract],
        ]);

        $tags = [];

        foreach ($request->tags as $tag)
        {
            $tags[] = Tag::find($tag) ? $tag :Tag::create(['name' => $tag])->id;
        }

        $post->tags()->sync($tags);

        // $image = request()->file('image')->store('public');

        // Image::create([
        //     'url' => Storage::url($image),
        //     'post_id' => $post->id
        // ]);

        return redirect()->route('admin.posts.create', $post)->with('flash', 'Tu publicación ha sido creada');
    }
}
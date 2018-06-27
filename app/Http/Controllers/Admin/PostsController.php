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
        }
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
        $languages = Language::all();

        return view('admin.posts.edit', compact(['categories', 'tags','post','languages']));

    }

    public function update(Post $post, Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'extract' => 'required',
            'tags' => 'required']);

            if ($request->lang_id) {
                $lang_id = $request->lang_id;
            } else {
                $lang_id = 1;
            }

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
        $languages = Language::all();
        //dd($request->all());

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
        //$lang_id = $request->lang_id;
           // dd($request->all());
        //dd($lang_id);
        foreach ($languages as $id => $language) {
            $categoryLang = 'category-' . $language->code;
            if (Category::find($request->category)) {
                $category_id = $request->category;
            } else {
                $category_id = Category::create([
                'url' => str_slug($request->$categoryLang),
                'name' => $request->$categoryLang->name])->id;
            }
        }

        $published_at = $request->has('published_at') ? Carbon::parse($request->published_at) : null;
        $post = Post::create(['published_at' => $published_at, 'category_id' => $category_id ]);
        foreach ($languages as $id => $language) {
            $titleLang = 'title-' . $language->code;
            $subtitleLang = 'subtitle-' . $language->code;
            $contentLang = 'title-' . $language->code;
            $extractLang = 'title-' . $language->code;


            $url = str_slug($request->$titleLang);
            $post->languages()->syncWithoutDetaching([
                $language->id => ['title' => $request->$titleLang, 'subtitle' => $request->$subtitleLang, 'content' => $request->$contentLang, 'extract' => $request->$extractLang, 'url' => $url],
            ]);

        }

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
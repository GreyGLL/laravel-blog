<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), [
            'image' => 'required|image|max:2048'
        ]);

        $image = request()->file('image')->store('public');

        Image::create([
            'url' => Storage::url($image),
            'post_id' => $post->id
        ]);
    }

    public function destroy(Image $image)
    {
        $image->delete();

        $imagePath = str_replace('storage', 'public', $image->url);

        Storage::delete($imagePath);

        $post = Post::find($image->post_id);

        return redirect(route('admin.posts.edit', $post->url))->with('flash', 'Foto eliminada');
    }
}

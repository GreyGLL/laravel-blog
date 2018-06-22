<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts;

        return view('welcome', [
            'title' => "Publicaciones con la categoria {$category->name}",
            'posts' => $category->posts()->paginate(5)
        ]);
    }
}

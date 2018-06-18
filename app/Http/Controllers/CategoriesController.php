<?php

use App\Category;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts;

        return view('welcome', [
            'title' => "Publicaciones de la cataegoria {$category->name}",
            'posts' => $category->posts()->paginate(5)
        ]);
    }
}

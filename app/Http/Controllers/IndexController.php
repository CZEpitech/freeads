<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class IndexController extends Controller
{
    public function showIndex()
    {
        $categories = Category::all();
        $posts = Article::all();
        return view('all_post', compact('posts', 'categories'));
    }
}

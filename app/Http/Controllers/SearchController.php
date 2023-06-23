<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;


class SearchController extends Controller
{

    public function show(Request $request)
    {
        $searchTerm = $request->input('q');
        $category = $request->input('category');
        $categories = Category::all();

        $postsQuery = Article::query();

        if ($category) {
            $postsQuery->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        if ($searchTerm) {
            $postsQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('categories', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });

            $searchTerms = $request->session()->get('searchTerms', []);
            $searchTerms[] = $searchTerm;
            $request->session()->put('searchTerms', $searchTerms);

            $cookieName = 'searchTerms';
            $cookieValue = json_encode($searchTerms);
            $cookieExpiration = 60 * 24 * 7; // 1 week
            setcookie($cookieName, $cookieValue, time() + $cookieExpiration, '/');
        }

        $posts = $postsQuery->get();

        return view('all_post', compact('categories', 'posts', 'searchTerm', 'category'));
    }

    public function suggestArticles()
    {
        $searchTerms = [];
        $categories = Category::all();
        if (session('searchTerms')) {
            $searchTerms = session('searchTerms');
        } elseif (isset($_COOKIE['searchTerms'])) {
            $searchTerms = json_decode($_COOKIE['searchTerms'], true);
        }

        $posts = [];

        foreach ($searchTerms as $term) {
            $results = Article::where('title', 'like', '%' . $term . '%')->get();

            if ($results->count() > 0) {
                $posts = array_merge($posts, $results->all());
            }
        }

        return view('all_post', compact('posts', 'categories'));
    }
}

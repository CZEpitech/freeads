<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller

{

    public function showPost()
    {
        $categories = Category::all();

        return view('post', compact('categories'));
    }
    public function showAllPost()
    {
        $categories = Category::all();
        $posts = Article::all();
        return view('all_post', compact('posts', 'categories'));
    }

    public function showPopularePost()
    {
        $categories = Category::all();
        $posts = Article::where('views', '>', 0)->orderByDesc('views')->get();
        return view('all_post', compact('posts', 'categories'));
    }



    public function showSinglePost($article)
    {
        $categories = Category::all();
        $post = Article::with('images')->find($article);
        $post->increment('views');
        return view('single_post', compact('post', 'categories'));
    }


    public function showMyPost()
    {
        $categories = Category::all();
        $user_id = auth()->id();
        $posts = Article::where('user_id', $user_id)->get();
        $post_count = $posts->count();
        return view('all_post', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'int'],
            'images.*' => ['image'],
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->price = $request->input('price');
        $article->user_id = auth()->user()->id;
        $article->description = $request->input('description');

        $article->save();
        $categories = $request->input('categories');
        $article->categories()->attach($categories);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = $file->store('images');
                $image = new Images();
                $image->filename = $filename;
                $image->article_id = $article->id;
                $image->save();
            }
        }




        Mail::send('emails_post', ['title' => $article->title, 'description' => $article->description, 'user' => auth()->user()->name, 'date' => now(), 'price' => $article->price], function ($message) use ($article) {
            $message->to(auth()->user()->email);
            $message->subject('Your article has been posted !');
        });

        return view('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($article)
    {
        $article = Article::find($article);
        $categories = Category::all();
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('edit_article', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {


        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'categories' => ['required'],
        ]);

        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->price = $request->input('price');

        if ($request->hasFile('images')) {
            $article->images()->delete();
            foreach ($request->file('images') as $file) {
                $filename = $file->store('images');
                $image = new Images();
                $image->filename = $filename;
                $image->article_id = $article->id;
                $image->save();
            }
        }

        $article->save();

        $categories = $request->input('categories');
        $article->categories()->sync($categories);
        return redirect()->route('posts');
    }

    public function destroy($article)
    {
        $article = Article::find($article);

        if ($article->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $article->images()->delete();

        $article->delete();

        return redirect()->back()->with('success', 'Article deleted successfully.');
    }
}

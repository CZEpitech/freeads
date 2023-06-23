<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class LoginController extends Controller
{
    public function showLoginForm()
    {

        return view('login');
    }
    public function login(Request $request)
    {
        // Validate the user's input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (auth()->attempt($request->only('email', 'password'))) {
            // Authentication was successful
            $user = auth()->user();
            if ($user->confirmed == 1) {
                session(['user' => $user]);
                $categories = Category::all();
                $posts = Article::all();
                return view('all_post', compact('posts', 'categories'));
            } elseif ($user->confirmed == 3) {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Your account has been desactivated.',
                ]);
            } else {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Your account has not been verified.',
                ]);
            }
        } else {
            // Authentication failed
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $categories = Category::all();
        $posts = Article::all();
        return view('all_post', compact('posts', 'categories'));
    }
}

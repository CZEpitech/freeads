<?php

use Illuminate\Support\Facades\Route;

//Créer la route pour Index

Route::get('/', 'App\Http\Controllers\IndexController@showIndex')->name('home');
//Créer la route pour Register
Route::post('/register', 'App\Http\Controllers\UserController@store')->name('users.store');
Route::get('/register', 'App\Http\Controllers\UserController@showRegister')->name('register');
//Créer la route pour Users & Faire fonctionner l'action -> Success
Route::get('/user', 'App\Http\Controllers\UserController@show');
//Créer la route pour les emails
Route::get('/confirmation', 'App\Http\Controllers\ConfirmationController@confirm')->name('confirmation');
//Créer la route user
Route::get('/user', 'App\Http\Controllers\UserController@show')->name('user')->middleware('auth');
//Créer la route user.index
Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users')->middleware('auth');
//Créer la route de connexion
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm');
//Créer la route de deconnexion
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout')->middleware('auth');
//Créer la route d'edition de profil
Route::get('/edit', 'App\Http\Controllers\UserController@edit')->name('edit')->middleware('auth');
Route::put('/users/{user}', 'App\Http\Controllers\UserController@update')->name('users.update')->middleware('auth');
//Créer la route pour supprimer un compte
Route::put('/delete/{user}', 'App\Http\Controllers\UserController@disableAccount')->name('users.destroy')->middleware('auth');
//Créer la route pour poster des articles
Route::post('/add', 'App\Http\Controllers\PostController@store')->name('articles.store')->middleware('auth');
Route::get('/add', 'App\Http\Controllers\PostController@showPost')->name('addArticle')->middleware('auth');
//Créer la route pour afficher tout les articles
Route::get('/posts', 'App\Http\Controllers\PostController@showAllPost')->name('posts')->middleware('auth');
//Créer la route pour afficher tout les articles populaire
Route::get('/populare', 'App\Http\Controllers\PostController@showPopularePost')->name('populare')->middleware('auth');
//Créer la route pour les images
Route::get('/images/{filename}', 'App\Http\Controllers\ImageController@showImage');
//Créer la route pour afficher mes articles
Route::get('/myposts', 'App\Http\Controllers\PostController@showMyPost')->name('my_posts')->middleware('auth');
// Créer la route pour édite ses posts
Route::get('/posts/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('edit_post')->middleware('auth');
Route::put('/posts/{post}', 'App\Http\Controllers\PostController@update')->name('update_post')->middleware('auth');
// Créer la route pour supprimer ses posts
Route::delete('/posts/delete/{post}', 'App\Http\Controllers\PostController@destroy')->name('delete_post')->middleware('auth');
//Créer la route pour éditer ses posts
Route::put('/posts/{article}/edit', 'App\Http\Controllers\PostController@update')->name('articles.update')->middleware('auth');
//Créer la route pour afficher les articles
Route::get('/post/{article}', 'App\Http\Controllers\PostController@showSinglePost')->name('show_post');
//Créer la route pour afficher les catégories
Route::get('/category/{slug}', 'App\Http\Controllers\CategoryController@show')->name('category.show');
//Créer la route pour le search
Route::get('/search', 'App\Http\Controllers\SearchController@show')->name('search');
//Créer la route pour le matching
Route::get('/recommended', 'App\Http\Controllers\SearchController@suggestArticles')->name('recommended');
//Créer la route pour l'envoi des messages

//Créer la route pour afficher le formulaire d'envoi de message
Route::get('/messages', 'App\Http\Controllers\MessageController@show')->name('messages.index');
//Créer la route pour envoyer le formulaire
Route::post('/messages', 'App\Http\Controllers\MessageController@create')->name('messages.store');
//Créer la route pour afficher le formulaire d'envoi de message
Route::get('/messages/all', 'App\Http\Controllers\MessageController@index')->name('messages.show');

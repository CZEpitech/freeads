<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name'];


    public function posts()
    {
        return $this->hasMany(Article::class);
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category', 'category_id', 'article_id');
    }
}

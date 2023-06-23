<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Images extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'filename',
        'article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

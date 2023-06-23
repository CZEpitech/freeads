<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable

{

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    use HasFactory, Notifiable;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function unreadMessagesCount()
    {
        return $this->messages()->where('read_at', null)->count();
    }
    public function PostCount()
    {
        return Article::where('user_id', auth()->id())->count();
    }
}

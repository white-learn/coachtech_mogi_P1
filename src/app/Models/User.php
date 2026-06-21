<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
    ];

    public function sellItems()
    {
        return $this->hasMany(Item::class, 'sell_user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function likeItems()
    {
        return $this->belongsToMany(Item::class, 'like_items');
    }

    public function buyItems()
    {
        return $this->belongsToMany(Item::class, 'buy_items');
    }
}
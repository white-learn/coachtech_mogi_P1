<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_photo',
        'value',
        'item_plain',
        'brand_name',
        'condition_id',
        'sell_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sell_user_id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories');
    }

    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'like_items');
    }

    public function buyUsers()
    {
        return $this->belongsToMany(User::class, 'buy_items');
    }
}
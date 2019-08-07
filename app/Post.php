<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'image'];

    //Relations

    //Many to one
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Many to one
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

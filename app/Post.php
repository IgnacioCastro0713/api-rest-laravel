<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['user_id', 'category_id', 'title', 'content', 'image'];

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

    //static methods

    public static function getPostByCategory($id)
    {
        return self::where('category_id', $id)->get();
    }

    public static function getPostByUser($id)
    {
        return self::where('user_id', $id)->get();
    }

}

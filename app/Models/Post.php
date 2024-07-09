<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title', 'content', 'slug','active','image_post'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    // method to delete all comments related to a post
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {

            Cache::forget("posts");
          //  dd("data inserted with success");
       // dd("while deleting");
           // $post->comments()->delete();
        });
    }

}

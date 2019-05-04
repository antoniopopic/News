<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'body', /* 'slug', */ 'user_id', 'cover_image'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}



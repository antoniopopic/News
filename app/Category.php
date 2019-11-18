<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){
        return $this->belongsToMany(Post::class)->latest();
    }
    public function getRouteKeyName(){
        return 'name';
    }
}

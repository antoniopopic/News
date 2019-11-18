<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['username', 'description'];
    
    public function users(){
        return $this->belongsToMany(User::class, 'user_role');
    }
}

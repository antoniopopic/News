<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'password_confirmation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasRole($role){
        if ($this->roles()->where('username', $role)->first()) {
            return true;
        }
        return false;
    }

    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function authorizeRoles($roles){
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401);
        }
        return $this->hasRole($roles) || abort(401);
    }
}

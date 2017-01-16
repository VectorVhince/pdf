<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role', 'position'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Date
    public function postsUser(){
        return $this->hasMany('\App\Posts', 'user_id');
    }

    public function userNotifs(){
        return $this->hasMany('\App\Notification', 'user_id');
    }

}

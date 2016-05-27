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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $append = [
        'jml_follow',
        'jml_unfollow'
    ];

    public function getFullName(){
        return $this->firstname . ' ' . $this->lastname;
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function groups(){
        return $this->hasMany('App\Group');
    }

    public function userFollows(){
        return $this->hasMany('App\userFollow');
    }

    public function follow(){
        $result = userFollow::where('friend_id','=',$this->id)->where('follow','=',1)->get();
        return $result->count();
    }

    public function unfollow(){
        $result = userFollow::where('friend_id','=',$this->id)->where('follow','=',0)->get();
        return $result->count();
    }

}

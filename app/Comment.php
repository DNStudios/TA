<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The Table from your request.
     *
     * @var array
     */
    protected $table = 'comments';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'text', 'email', 'isDeleted', 'post_id','user_id'
    ];

    public function posts(){
    	return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsToMany('App\user');
    }

    public function isDeleted($query){
    	return $query->where('isDeleted', 0);
    }
}

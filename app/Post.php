<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
     * The Table from your request.
     *
     * @var array
     */
    protected $table = 'posts';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','body','image','isDeleted','user_id'
    ];

    // public $timestamps = false;

    public function user(){
    	return $this->belongsTo('App\User');
    }

}

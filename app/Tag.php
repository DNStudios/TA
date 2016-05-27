<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The Table from your request.
     *
     * @var array
     */
    protected $table = 'tags';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name','isDeleted','post_id'
    ];

    public function posts(){
    	return $this->belongsTo('App\Post');
    }

    public function getCreatedAtAttribute($value){
        $value = date('U', strtotime($value));
        return $value * 1000;
    }

    public function getUpdatedAtAttribute($value){
        $value = date('U', strtotime($value));
        return $value * 1000;
    }
}

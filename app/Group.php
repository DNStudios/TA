<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The Table from your request.
     *
     * @var array
     */
    protected $table = 'groups';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name','privileges','user_id','isDeleted','created_at','updated_at'
    ];

    public function user(){
<<<<<<< HEAD
    	return $this->belongsTo('App\User');
=======
    	return $this->belongsToMany('App\User');
>>>>>>> c4327df9b8736d3c8a842d758d030bde4ced110f
    }
}

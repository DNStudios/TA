<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The Table from your request.
     *
     * @var array
     */
    protected $table = 'categories';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name','isDeleted','post_id'
    ];

    public function posts(){
        return $this->belongsTo("App\Post");
    }

    public function user(){
        return $this->belongsTo("App\user");
    }

    public function isDeleted($query){
        return $query->where('isDeleted', 0);
    }
}

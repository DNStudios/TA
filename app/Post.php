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

    protected $appends = [
        'jml_like',
        'jml_dislike'
    ];

    public function getJmlLikeAttribute(){
        $result = Like::Where('post_id','=',$this->id)->where('like','=',1)->get();
        return $result->count();
    }

    public function getJmlDisLikeAttribute(){
        $result = Like::Where('post_id','=',$this->id)->where('like','=',0)->get();
        return $result->count();
    }

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function tags(){
        return $this->hasMany('App\Tag');
    }

    public function scopeActive($query){
        return $query->where('active', 0);
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

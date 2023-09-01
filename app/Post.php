<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'title', 'content', 'user_id', 'post_cat_id'
    ];
    function user(){
        return $this->belongsTo('App\User');
    }
    function post_cat(){
        return $this->belongsTo('App\Post_cat');
    }
}

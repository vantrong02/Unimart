<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_cat extends Model
{
    //
    protected $fillable = [
        'name', 'user_id',
    ];
    function user(){
        return $this->belongsTo('App\User');
    }
}

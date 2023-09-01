<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_cat extends Model
{
    //
    protected $fillable = [
        'name', 'user_id', 'parent_id', 'url'
    ];
    function product(){
        return $this->hasMany('App\Product');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
}

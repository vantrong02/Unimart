<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'name', 'thumbnail', 'description', 'content', 'product_cat_id', 'user_id', 'price', 'status'];
    function product_cat(){
        return $this->belongsTo('App\Product_cat');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
}

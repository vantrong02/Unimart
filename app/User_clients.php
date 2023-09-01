<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_clients extends Model
{
    //
    protected $fillable = [
        'fullname', 'email', 'password', 'gender', 'phone', 'address', 'city', 'username',
    ];
}

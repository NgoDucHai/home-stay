<?php

namespace App\AdminApi\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = ['description', 'name', 'age'];
}
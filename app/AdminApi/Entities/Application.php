<?php

namespace App\AdminApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = ['state', 'message'];
}
<?php

namespace App\AdminApi\Controllers;


use App\AdminApi\Entities\User;

class UserController extends RestController
{
    protected function getModelClass()
    {
        return User::class;
    }

}
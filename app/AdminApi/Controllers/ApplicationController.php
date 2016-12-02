<?php

namespace App\AdminApi\Controllers;

use App\AdminApi\Entities\Application;

class ApplicationController extends RestController
{
    protected function getModelClass()
    {
        return Application::class;
    }
}
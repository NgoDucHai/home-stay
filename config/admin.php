<?php

return [
    'prefix' => 'admin',
    'resources' => [
        'apartment'     => App\AdminApi\Controllers\ApartmentController::class,
        'application'   => App\AdminApi\Controllers\ApplicationController::class,
        'user'          => App\AdminApi\Controllers\UserController::class,
        'review'        => App\AdminApi\Controllers\ReviewController::class
    ]
];
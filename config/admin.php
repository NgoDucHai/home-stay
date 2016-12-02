<?php

return [
    'accounts' => [
        'haingo6394@gmail.com',
        'hai00@gmail.com'
    ],
    'prefix' => 'admin',
    'resources' => [
        'apartment'     => App\AdminApi\Controllers\ApartmentController::class,
        'application'   => App\AdminApi\Controllers\ApplicationController::class,
        'user'          => App\AdminApi\Controllers\UserController::class,
        'review'        => App\AdminApi\Controllers\ReviewController::class
    ]
];
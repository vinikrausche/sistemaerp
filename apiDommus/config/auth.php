<?php

use App\Models\User;
return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],



    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],
];

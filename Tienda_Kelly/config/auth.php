<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'vendedor' => [
            'driver' => 'session',
            'provider' => 'vendedores', // Asegúrate de que coincida con el nombre correcto en 'providers'
        ],

        'mercado' => [
            'driver' => 'session',
            'provider' => 'mercados',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'mercados' => [
            'driver' => 'eloquent',
            'model' => App\Models\MercadoLocal::class,
        ],

        'vendedores' => [
            'driver' => 'eloquent',
            'model' => App\Models\Vendedor::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'vendedores' => [
            'provider' => 'vendedores',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'mercados' => [
            'provider' => 'mercados',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
    
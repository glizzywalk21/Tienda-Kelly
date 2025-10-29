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

        'admin' => [
            'driver' => 'session',
            'provider' => 'clientes', // ✅ apunta correctamente
        ],

        'cliente' => [
            'driver' => 'session',
            'provider' => 'clientes', // opcional, si también usás este guard
        ],

        'vendedor' => [
            'driver' => 'session',
            'provider' => 'vendedores',
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

        'clientes' => [
            'driver' => 'eloquent',
            'model' => App\Models\Cliente::class, // ✅ asegurate de tener este modelo
        ],

        'vendedores' => [
            'driver' => 'eloquent',
            'model' => App\Models\Vendedor::class,
        ],

        'mercados' => [
            'driver' => 'eloquent',
            'model' => App\Models\MercadoLocal::class,
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

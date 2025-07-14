<?php
return [
    'defaults' => [
        'guard' => 'users',
        'passwords' => 'users',
    ],

    'guards' => [
        'users' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
        'organizers' => [
            'driver' => 'jwt',
            'provider' => 'organizers'
        ],
        'admins' => [
            'driver' => 'jwt',
            'provider' => 'admins'
        ]
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\UsersModel::class
        ],
        'organizers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\OrganizersModel::class
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => \App\Models\AdminsModel::class
        ]
    ]
];

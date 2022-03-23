<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super-admin' => [
            'users' => 'c,r,d,u',
            'admins' => 'c,r,u,d',
            'food_categories'=>'c,r,u,d',
            'meal_categories'=>'c,r,u,d',
            'foods'=>'c,r,u,d',
            'meals'=>'c,r,u,d',
            'uses'=>'c,r,u,d',
            'contacts'=>'c,r,u,d',
            'settings'=>'c,r,u,d',
        ],
        'admin' => [
            'users' => 'c,r',
            'admins' => 'r',
            'food_categories'=>'c,r,u',
            'meal_categories'=>'c,r,u',
            'foods'=>'c,r,u',
            'meals'=>'c,r,u',
            'uses'=>'c,r,u',
            'contacts'=>'c,r',
            'settings'=>'r',
        ],
        'moderator' => [
            'users' => 'r',
            'admins' => 'r',
            'food_categories'=>'r',
            'meal_categories'=>'r',
            'foods'=>'r',
            'meals'=>'r',
            'uses'=>'r',
            'contacts'=>'r',
        ],
        'user' => [
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

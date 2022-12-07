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
        'admin' => [
            // 'users' => 'c,r,u,d',
            // 'payments' => 'c,r,u,d',
            // 'profile' => 'r,u'
        ],
        'upt_psda_kediri' => [

        ],
        'upt_psda_lumajang' => [

        ],
        'upt_psda_bondowoso' => [

        ],
        'upt_psda_pasuruan' => [

        ],
        'upt_psda_bojonegoro' => [

        ],
        'upt_psda_pamekasan' => [

        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

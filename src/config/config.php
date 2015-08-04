<?php return [
    
    // prefix to use on tables related to cms (also entrust tables)
    'table_prefix' => 'cms_',

    //use translations from database
    'use_db_trans' => false,
    'use_trans_cache' => false,
    /*
     * The default title to display in the menu bar
     */
    'title' => 'teman-ager',

    /*
     * Menu items for admin interface
     *
     */
    'adminMenuItems' => [
        [
            'title' => 'Users',
            'permission'=>'access_cms',
            'adminMenuItems_subCategory' => [
                [
                    'permission'=>'access_cms',
                    'route' => 'admin.users.index',
                    'title'=>'Users',
                    'icon'=>'user',
                ],
            ],
        ],
        [
            'title' => 'Translations',
            'permission'=>'access_cms',
            'adminMenuItems_subCategory' => [
                [
                    'permission'=>'access_cms',
                    'route' => 'admin.languages.interface',
                    'title'=>'Interface',
                    'icon'=>'flag',
                ],
            ],
        ],

    ],

];
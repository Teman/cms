<?php return array(


    /*
     * The default title to display in the menu bar
     */
    'cmsTitle' => 'Teman CMS',

    /*
     * Menu items for admin interface
     *
     */
    'categorieItems' => [
        [
            'title' => 'Users',
            'permission'=>'acces_cms',
            'subCategorieItems' => [
                [
                    'permission'=>'acces_cms',
                    'route' => 'admin.users.index',
                    'itemText'=>'Users',
                    'Iclass'=>'fa fa-user',

                ],
            ],
        ],

        [
            'title' => 'Textbox',
            'permission'=>'acces_cms',
            'subCategorieItems' => [
                [
                    'permission'=>'acces_cms',
                    'route' => 'admin.textbox.index',
                    'itemText'=>'Rich Textbox Editor',
                    'Iclass'=>'fa fa-file-text'
                ],
            ]
        ]
    ],

);

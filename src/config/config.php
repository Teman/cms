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
            'subCategorieItems' => [
                [
                    'route' => 'admin.users.index',
                    'itemText'=>'Users',
                    'Iclass'=>'fa fa-user'
                ],
            ],
        ],

        [
            'title' => 'Textbox',
            'subCategorieItems' => [
                [
                    'route' => 'admin.textbox.index',
                    'itemText'=>'Rich Textbox Editor',
                    'Iclass'=>'fa fa-file-text'
                ],
            ]
        ]
    ],

);

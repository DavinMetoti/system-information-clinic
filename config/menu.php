<?php

return [
    'sidebar' => [
        [
            'title' => 'Apps',
            'children' => [
                [
                    'title' => 'Dashboard',
                    'icon' => '',
                    'father' => 'grid',
                    'route' => 'app.dashboard.index',
                ],
                [
                    'title' => 'Suppliers',
                    'icon' => 'fas fa-boxes',
                    'father' => '',
                    'route' => 'app.suppliers.index',
                ],
                [
                    'title' => 'Categories',
                    'icon' => 'fas fa-boxes',
                    'father' => '',
                    'route' => 'app.categories.index',
                ],
            ],
        ],
        [
            'title' => 'User Management',
            'children' => [
                [
                    'title' => 'User',
                    'icon' => 'fas fa-user-plus',
                    'father' => '',
                    'route' => 'user-management.users.index',
                ],
            ],
        ],
    ],
];

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
                    'icon' => 'fas fa-truck',
                    'father' => '',
                    'route' => 'app.suppliers.index',
                ],
                [
                    'title' => 'Categories',
                    'icon' => 'fas fa-tags',
                    'father' => '',
                    'route' => 'app.categories.index',
                ],
                [
                    'title' => 'Products',
                    'icon' => 'fas fa-box',
                    'father' => '',
                    'route' => 'app.products.index',
                ],
            ],
        ],
        [
            'title' => 'User Management',
            'children' => [
                [
                    'title' => 'User',
                    'icon' => 'fas fa-users-cog', // Ikon manajemen pengguna
                    'father' => '',
                    'route' => 'user-management.users.index',
                ],
            ],
        ],
    ],
];

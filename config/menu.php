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
                    'permission' => null,
                ],
            ],
        ],
        [
            'title' => 'Admin',
            'children' => [
                [
                    'title' => 'Doctor Managements',
                    'icon' => 'fas fa-user-md',
                    'father' => '',
                    'route' => 'admin.doctor-management.index',
                    'permission' => 'manage doctors',
                ],
                [
                    'title' => 'Specializations',
                    'icon' => 'fas fa-stethoscope',
                    'father' => '',
                    'route' => 'admin.specialization.index',
                    'permission' => 'manage doctors',
                ],
            ],
        ],
        [
            'title' => 'Dokter',
            'children' => [
                [
                    'title' => 'Patients List',
                    'icon' => 'fas fa-users',
                    'father' => '',
                    'route' => 'doctor.patient.index',
                    'permission' => 'manage medical records',
                ],
                [
                    'title' => 'Medical Records',
                    'icon' => 'fas fa-file-medical',
                    'father' => '',
                    'route' => 'doctor.medical-record.index',
                    'permission' => 'manage medical records',
                ],
            ],
        ]
    ],
];

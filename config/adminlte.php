<?php

return [
    'layout' => [
        'topnav' => false,
        'sidebar_mini' => 'lg',
        'sidebar_collapse' => false,
        'dark_mode' => false,
    ],

    'logo' => '<b>AGEPIF</b> ADMIN',
    'logo_img' => null,
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_alt' => 'Logo',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_xl_alt' => 'Logo',

    'usermenu_header' => false,
    'usermenu_image' => false,
    'usermenu_description' => false,

    'menu' => [
        [
            'text' => 'Tableau de bord',
            'url' => 'admin',
            'icon' => 'fas fa-tachometer-alt',
        ],
        [
            'text' => 'Biens immobiliers',
            'url' => 'admin/properties',
            'icon' => 'fas fa-building',
            'submenu' => [
                [
                    'text' => 'Tous les biens',
                    'url' => 'admin/properties',
                    'icon' => 'fas fa-list',
                ],
                [
                    'text' => 'Ajouter un bien',
                    'url' => 'admin/properties/create',
                    'icon' => 'fas fa-plus',
                ],
            ],
        ],
        [
            'text' => 'Locations',
            'icon' => 'fas fa-home',
            'submenu' => [
                [
                    'text' => 'Contrats actifs',
                    'url' => 'admin/rentals',
                    'icon' => 'fas fa-file-signature',
                ],
                [
                    'text' => 'Paiements',
                    'url' => 'admin/payments',
                    'icon' => 'fas fa-credit-card',
                ],
            ],
        ],
        [
            'text' => 'Demandes de contact',
            'url' => 'admin/inquiries',
            'icon' => 'fas fa-envelope',
            'badge' => 'new',
            'badge_color' => 'danger',
        ],
        [
            'text' => 'Catégories',
            'url' => 'admin/categories',
            'icon' => 'fas fa-tags',
        ],
        [
            'text' => 'Slides',
            'url' => 'admin/slides',
            'icon' => 'fas fa-images',
        ],
        [
            'text' => 'Paramètres',
            'url' => 'admin/settings',
            'icon' => 'fas fa-cog',
        ],
        [
            'text' => 'Utilisateurs',
            'url' => 'admin/users',
            'icon' => 'fas fa-users',
        ],
    ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'datatables' => true,
        'select2' => true,
        'chartjs' => true,
        'sweetalert2' => true,
    ],
];

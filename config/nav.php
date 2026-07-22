<?php

return [
    'sidebar' => [
        ['label' => 'Dashboard', 'icon' => 'chart-bar', 'url' => '/styleguide/layouts/sidebar', 'active' => true],
        ['label' => 'Transaksi', 'icon' => 'receipt-2', 'url' => '#'],
        ['label' => 'Kartu', 'icon' => 'credit-card', 'url' => '#'],
        ['label' => 'Pengaturan', 'icon' => 'settings', 'url' => '#'],
    ],

    'topbar' => [
        ['label' => 'Dashboard', 'url' => '/styleguide/layouts/topbar', 'active' => true],
        ['label' => 'Transaksi', 'url' => '#'],
        ['label' => 'Laporan', 'url' => '#'],
        ['label' => 'Kartu', 'url' => '#'],
        ['label' => 'Pengaturan', 'url' => '#'],
    ],

    'modules' => [
        [
            'key' => 'keuangan',
            'label' => 'Keuangan',
            'icon' => 'wallet',
            'sidebar' => [
                ['label' => 'Dashboard', 'icon' => 'chart-bar', 'url' => '/styleguide/layouts/mix?modul=keuangan', 'active' => true],
                ['label' => 'Transaksi', 'icon' => 'receipt-2', 'url' => '#'],
                ['label' => 'Kartu', 'icon' => 'credit-card', 'url' => '#'],
            ],
        ],
        [
            'key' => 'laporan',
            'label' => 'Laporan',
            'icon' => 'chart-bar',
            'sidebar' => [
                ['label' => 'Ringkasan', 'icon' => 'chart-bar', 'url' => '/styleguide/layouts/mix?modul=laporan', 'active' => true],
                ['label' => 'Ekspor', 'icon' => 'receipt-2', 'url' => '#'],
            ],
        ],
        [
            'key' => 'pengaturan',
            'label' => 'Pengaturan',
            'icon' => 'settings',
            'sidebar' => [
                ['label' => 'Profil', 'icon' => 'user', 'url' => '/styleguide/layouts/mix?modul=pengaturan', 'active' => true],
                ['label' => 'Preferensi', 'icon' => 'settings', 'url' => '#'],
            ],
        ],
    ],
];

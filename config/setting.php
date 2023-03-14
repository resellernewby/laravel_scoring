<?php

return [
    'asset' => [
        'image' => [
            'directory' => 'assets',
            'width' => 500,
            'thumbnail' => [
                'width' => 150,
                'height' => 150
            ],
        ]
    ],
    'conditions' => [
        'excellent' => 'Excellent',
        'good' => 'Good',
        'poor' => 'Poor',
        'bad' => 'Bad',
    ],
    'conditions_returned' => [
        'excellent' => 'Excellent',
        'good' => 'Good',
        'poor' => 'Poor',
    ],
    'status' => [
        'in_stock' => 'In Stock',
        'in_use' => 'In Use',
        'returned' => 'Returned',
        'damaged' => 'Damaged',
        'in_repair' => 'In Repair',
    ],
    'warehouse_id_for_damaged' => 1,
    'rack_id_for_damaged' => 1,
    'user_beginner' => 'not used',
    'action_lists' => [
        'new item' => 'Barang baru',
        'add stock' => 'Tambah stok',
        'returned' => 'Dikembalikan setelah pemakaian',
        'in_use' => 'Digunakan',
        'damaged' => 'Barang rusak',
        'in_repair' => 'Dalam perbaikan',
        'sold' => 'Dijual',
        'destroyed' => 'Dimusnahkan',
    ]
];

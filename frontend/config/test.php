<?php
return [
    'id' => 'app-frontend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'db' => [
            'dsn' => 'pgsql:host=localhost;port=5432;dbname=testmydb',
        ]
    ],
];

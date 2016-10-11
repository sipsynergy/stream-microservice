<?php
return [
    'settings' => [
        'displayErrorDetails'    => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        'logger'                 => [
            'name'  => 'slim-app',
            'path'  => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'doctrine'               => [
            'meta'       => [
                'entity_path'           => [
                    __DIR__ . '/App/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir'             => __DIR__ . '/../cache/proxies',
                'cache'                 => null,
            ],
            'connection' => [
              'driver' => 'pdo_sqlite',
              'path' => __DIR__.'/../sql/db.sqlite'
            ],
        ],
    ],
];

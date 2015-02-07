<?php

/**
 * All this configuration would be better if
 * you save it in your server as a environment variable
 * to avoid some type of attacks
 */

return [
    'mysql' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',       // also valid localhost
        'port' => '3306',            // by default 3306
        'database' => 'db',   // default database
        'user' => 'root',
        'password' => '',            // recommended save it in the server
        'charset' => 'utf-8'
    ],
    'pgsql' => [
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '5437',       // by default 5437
        'database' => 'db',
        'user' => 'postgres',
        'password' => '',
        'charset' => 'utf-8'
    ],
    'sqlite' => [
        'driver' => 'sqlite',
        'database' => __DIR__ .'/../app/database/'
    ]
];

<?php

$confs = [
    "aba19" => [
        "title" => "Абакан",
        "db" => [
            'driver'    => 'pgsql',
            'host'      => '127.0.0.1',
            'port'      =>'5432',
            'database'  => 'taxi',
            'username'  => 'alk',
            'password'  => 'password',
            'charset'   => 'utf8',
            'prefix'    => '',
            'schema'   => 'public',
        ],
        "redis" => [
            "host" => "127.0.0.1",
            "port" => 6379,
            "pass" => "parol111"
        ]
    ]
];

$db = [

    'driver'    => 'pgsql',
    'host'      => '127.0.0.1',
    'port'      =>'5432',
    'database'  => 'taxi',
    'username'  => 'alk',
    'password'  => 'password',
    'charset'   => 'utf8',
    'prefix'    => '',
    'schema'   => 'public',
];
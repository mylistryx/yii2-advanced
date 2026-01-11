<?php

use yii\db\Connection as DbConnection;
use yii\redis\Connection as RedisConnection;
use yii\symfonymailer\Mailer;

return [
    'components' => [
        'db' => [
            'class' => DbConnection::class,
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
        ],
        'redis'=> [
            'class' => RedisConnection::class,
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
        'mailer' => [
            'class' => Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
    ],
];

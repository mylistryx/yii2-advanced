<?php

use yii\i18n\PhpMessageSource;
use yii\queue\redis\Queue;
use yii\redis\Cache;
use yii\redis\Session;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'bootstrap' => [
        'queue',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'components' => [
        'cache' => [
            'class' => Cache::class,
        ],
        'session' => [
            'class' => Session::class,
        ],
        'queue' => [
            'class' => Queue::class,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => PhpMessageSource::class,
                ],
            ],
        ],
    ],
];

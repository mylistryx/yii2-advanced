<?php

use common\models\Identity;
use yii\web\User;

return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'user' => [
            'class' => User::class,
            'identityClass' => Identity::class,
        ],
    ],
];

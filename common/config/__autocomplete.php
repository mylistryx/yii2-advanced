<?php

use common\components\WebUser;
use common\models\Identity;
use yii\console\Application as ConsoleApplication;
use yii\rbac\DbManager;
use yii\web\Application as WebApplication;

class Yii
{
    public static ConsoleApplication|__Application|WebApplication $app;
}

/**
 * @property DbManager $authManager
 * @property WebUser|__WebUser $user
 * @property Redis $redis
 */
class __Application
{
}

/**
 * @property Identity $identity
 */
class __WebUser
{
}

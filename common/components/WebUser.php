<?php

namespace common\components;

use yii\web\User;

final class WebUser extends User
{
    public $loginUrl = ['/auth/index'];
}
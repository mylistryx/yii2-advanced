<?php

namespace common\fixtures;

use common\models\Identity;
use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = Identity::class;
}

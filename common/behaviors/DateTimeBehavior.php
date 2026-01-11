<?php

namespace common\behaviors;

use yii\behaviors\TimestampBehavior;

class DateTimeBehavior extends TimestampBehavior
{
    protected function getValue($event): string
    {
        return date('Y-m-d H:i:s');
    }
}
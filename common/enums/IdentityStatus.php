<?php

namespace common\enums;

use common\traits\EnumToArrayTrait;

enum IdentityStatus: int
{
    use EnumToArrayTrait;

    case Active = 10;
    case Inactive = 9;
    case Deleted = 0;
}
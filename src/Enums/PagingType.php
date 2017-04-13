<?php

namespace Saritasa\Enums;

use Saritasa\Enum;

class PagingType extends Enum
{
    const NONE = 'NONE';
    const PAGINATOR = 'PAGINATOR';
    const CURSOR = 'CURSOR';
}

<?php

namespace Somecode\OpenApi\Entities\Schema;

use Somecode\OpenApi\Entities\Schema\Addons\HasEnum;
use Somecode\OpenApi\Entities\Schema\Addons\HasMaximum;
use Somecode\OpenApi\Entities\Schema\Addons\HasMinimum;
use Somecode\OpenApi\Entities\Schema\Formats\DoubleFormat;
use Somecode\OpenApi\Entities\Schema\Formats\FloatFormat;

class NumberSchema extends Schema
{
    use DoubleFormat, FloatFormat, HasEnum, HasMaximum, HasMinimum;

    protected function type(): Type
    {
        return Type::Number;
    }

    protected function specificData(): array
    {
        return [];
    }
}

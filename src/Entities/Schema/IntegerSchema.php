<?php

namespace Somecode\OpenApi\Entities\Schema;

use Somecode\OpenApi\Entities\Schema\Addons\HasEnum;
use Somecode\OpenApi\Entities\Schema\Addons\HasMaximum;
use Somecode\OpenApi\Entities\Schema\Addons\HasMinimum;
use Somecode\OpenApi\Entities\Schema\Formats\Int32Format;
use Somecode\OpenApi\Entities\Schema\Formats\Int64Format;

class IntegerSchema extends Schema
{
    use HasEnum, HasMaximum, HasMinimum, Int32Format, Int64Format;

    protected function type(): Type
    {
        return Type::Integer;
    }

    protected function specificData(): array
    {
        return [];
    }
}

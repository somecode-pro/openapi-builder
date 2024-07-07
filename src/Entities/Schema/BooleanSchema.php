<?php

namespace Somecode\OpenApi\Entities\Schema;

class BooleanSchema extends Schema
{
    protected function type(): Type
    {
        return Type::Boolean;
    }

    protected function specificData(): array
    {
        return [];
    }
}

<?php

namespace Somecode\OpenApi\Entities\Parameters;

use Somecode\OpenApi\Enums\ParameterType;

class QueryParameter extends Parameter
{
    public function type(): ParameterType
    {
        return ParameterType::Query;
    }
}

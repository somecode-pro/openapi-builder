<?php

namespace Somecode\OpenApi\Entities\Methods;

use Somecode\OpenApi\Enums\RequestMethod;

class Patch extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::PATCH;
    }
}

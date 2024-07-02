<?php

namespace Somecode\OpenApi\Entities\Methods;

use Somecode\OpenApi\Enums\RequestMethod;

class Get extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::GET;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Method;

use Somecode\OpenApi\Enums\RequestMethod;

class Get extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::GET;
    }
}

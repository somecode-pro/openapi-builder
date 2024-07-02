<?php

namespace Somecode\OpenApi\Entities\Methods;

use Somecode\OpenApi\Enums\RequestMethod;

class Put extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::PUT;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Method;

class Put extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::PUT;
    }
}

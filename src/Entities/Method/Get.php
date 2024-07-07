<?php

namespace Somecode\OpenApi\Entities\Method;

class Get extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::GET;
    }
}

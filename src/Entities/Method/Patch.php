<?php

namespace Somecode\OpenApi\Entities\Method;

class Patch extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::PATCH;
    }
}

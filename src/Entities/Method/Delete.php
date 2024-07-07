<?php

namespace Somecode\OpenApi\Entities\Method;

class Delete extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::DELETE;
    }
}

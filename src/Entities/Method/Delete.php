<?php

namespace Somecode\OpenApi\Entities\Method;

use Somecode\OpenApi\Enums\RequestMethod;

class Delete extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::DELETE;
    }
}

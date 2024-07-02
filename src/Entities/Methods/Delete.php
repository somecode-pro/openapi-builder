<?php

namespace Somecode\OpenApi\Entities\Methods;

use Somecode\OpenApi\Enums\RequestMethod;

class Delete extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::DELETE;
    }
}

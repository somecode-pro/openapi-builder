<?php

namespace Somecode\OpenApi\Entities\Method;

use Somecode\OpenApi\Enums\RequestMethod;

class Post extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::POST;
    }
}

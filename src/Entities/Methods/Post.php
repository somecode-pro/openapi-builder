<?php

namespace Somecode\OpenApi\Entities\Methods;

use Somecode\OpenApi\Enums\RequestMethod;

class Post extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::POST;
    }
}

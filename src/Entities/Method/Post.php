<?php

namespace Somecode\OpenApi\Entities\Method;

class Post extends Method
{
    public function method(): RequestMethod
    {
        return RequestMethod::POST;
    }
}

<?php

namespace Somecode\OpenApi\Services;

use Somecode\OpenApi\Entities\Method\Delete;
use Somecode\OpenApi\Entities\Method\Get;
use Somecode\OpenApi\Entities\Method\Method;
use Somecode\OpenApi\Entities\Method\Patch;
use Somecode\OpenApi\Entities\Method\Post;
use Somecode\OpenApi\Entities\Method\Put;
use Somecode\OpenApi\Enums\RequestMethod;

class PathMethodFactory
{
    public static function create(RequestMethod $method): Method
    {
        return match ($method) {
            RequestMethod::GET => new Get(),
            RequestMethod::POST => new Post(),
            RequestMethod::PUT => new Put(),
            RequestMethod::DELETE => new Delete(),
            RequestMethod::PATCH => new Patch(),
            default => throw new \InvalidArgumentException('Unknown request method'),
        };
    }
}

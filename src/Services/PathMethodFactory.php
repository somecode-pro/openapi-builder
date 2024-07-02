<?php

namespace Somecode\OpenApi\Services;

use Somecode\OpenApi\Entities\Methods\Delete;
use Somecode\OpenApi\Entities\Methods\Get;
use Somecode\OpenApi\Entities\Methods\Method;
use Somecode\OpenApi\Entities\Methods\Patch;
use Somecode\OpenApi\Entities\Methods\Post;
use Somecode\OpenApi\Entities\Methods\Put;
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

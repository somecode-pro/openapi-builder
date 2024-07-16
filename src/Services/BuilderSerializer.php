<?php

namespace Somecode\OpenApi\Services;

use Somecode\OpenApi\Builder;

class BuilderSerializer
{
    public function __construct(
        private readonly Builder $builder
    ) {}

    public function toJson(): string
    {
        return json_encode($this->builder->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

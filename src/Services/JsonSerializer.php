<?php

namespace Somecode\OpenApi\Services;

use Somecode\OpenApi\Builder;

class JsonSerializer
{
    public function __construct(
        private Builder $builder
    ) {}

    public function serialize(): string
    {
        return json_encode([
            'openapi' => $this->builder->openApiVersion(),
            'info' => [
                'title' => $this->builder->info()->getTitle(),
                'version' => $this->builder->info()->getVersion(),
                'description' => $this->builder->info()->getDescription(),
            ],
            'paths' => [],
        ], JSON_PRETTY_PRINT);
    }
}

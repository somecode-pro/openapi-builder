<?php

namespace Somecode\OpenApi\Services;

use Somecode\OpenApi\Builder;
use Somecode\OpenApi\Entities\Path;

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
            'paths' => $this->paths(),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function paths(): array
    {
        $paths = [];

        /** @var Path $path */
        foreach ($this->builder->paths() as $path) {
            $paths[$path->uri()] = $path->toArray();
        }

        return $paths;
    }
}

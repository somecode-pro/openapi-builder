<?php

namespace Somecode\OpenApi\Services;

use Somecode\OpenApi\Builder;
use Somecode\OpenApi\Entities\Path;
use Somecode\OpenApi\Entities\Server\Server;

class JsonSerializer
{
    public function __construct(
        private Builder $builder
    ) {}

    public function serialize(): string
    {
        return json_encode([
            'openapi' => $this->builder->openApiVersion(),
            'info' => $this->builder->info()->toArray(),
            'servers' => $this->servers(),
            'paths' => $this->paths(),
            'components' => $this->builder->componentsToArray(),
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

    private function servers()
    {
        return $this->builder->servers()->map(
            fn (Server $server) => $server->toArray()
        )->toArray();
    }
}

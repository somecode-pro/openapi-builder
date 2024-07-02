<?php

namespace Somecode\OpenApi\Entities\Methods;

use Somecode\OpenApi\Enums\RequestMethod;

abstract class Method
{
    private array $tags = [];

    private ?string $summary = null;

    private ?string $description = null;

    private string $operationId;

    public function __construct()
    {
        // TODO: mb need use other method for generate operationId
        $this->operationId = uniqid();
    }

    public static function create(): static
    {
        return new static();
    }

    public function tags(array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function summary(?string $summary): Method
    {
        $this->summary = $summary;

        return $this;
    }

    public function description(?string $description): Method
    {
        $this->description = $description;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getOperationId(): string
    {
        return $this->operationId;
    }

    abstract public function method(): RequestMethod;
}

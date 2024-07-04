<?php

namespace Somecode\OpenApi\Entities\Method;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Parameter\Parameter;
use Somecode\OpenApi\Enums\RequestMethod;

abstract class Method
{
    private array $tags = [];

    private ?string $summary = null;

    private ?string $description = null;

    private string $operationId;

    private ArrayCollection $parameters;

    public function __construct()
    {
        // TODO: mb need use other method for generate operationId
        $this->operationId = uniqid();
        $this->parameters = new ArrayCollection();
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

    public function addParameter(Parameter $parameter): Method
    {
        $this->parameters->add($parameter);

        return $this;
    }

    public function getParameters(): ArrayCollection
    {
        return $this->parameters;
    }

    public function toArray(): array
    {
        return [
            'tags' => $this->tags,
            'summary' => $this->summary,
            'description' => $this->description,
            'operationId' => $this->operationId,
            'parameters' => $this->parameters->map(
                fn (Parameter $parameter) => $parameter->toArray()
            )->toArray(),
        ];
    }

    abstract public function method(): RequestMethod;
}

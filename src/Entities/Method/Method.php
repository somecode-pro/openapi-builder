<?php

namespace Somecode\OpenApi\Entities\Method;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Parameter\Parameter;

abstract class Method
{
    private array $tags = [];

    private ?string $summary = null;

    private ?string $description = null;

    private string $operationId;

    private ArrayCollection $parameters;

    private ArrayCollection $parameterRefs;

    public function __construct()
    {
        // TODO: mb need use other method for generate operationId
        $this->operationId = uniqid();
        $this->parameters = new ArrayCollection();
        $this->parameterRefs = new ArrayCollection();
    }

    abstract public function method(): RequestMethod;

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

    public function addParameters(array $parameters): Method
    {
        foreach ($parameters as $parameter) {
            $this->addParameter($parameter);
        }

        return $this;
    }

    public function addParameterRef(string $ref): Method
    {
        $this->parameterRefs->add("#/components/parameters/$ref");

        return $this;
    }

    public function addParameterRefs(array $refs): Method
    {
        foreach ($refs as $ref) {
            $this->addParameterRef($ref);
        }

        return $this;
    }

    public function getParameters(): ArrayCollection
    {
        return $this->parameters;
    }

    public function getParameterRefs(): ArrayCollection
    {
        return $this->parameterRefs;
    }

    public function toArray(): array
    {
        return [
            'tags' => $this->tags,
            'summary' => $this->summary,
            'description' => $this->description,
            'operationId' => $this->operationId,
            'parameters' => $this->getParametersAsArray(),
        ];
    }

    private function getParametersAsArray(): array
    {
        $parameters = $this->parameters->map(
            fn (Parameter $parameter) => $parameter->toArray()
        )->toArray();

        $parameterRefs = [];

        foreach ($this->parameterRefs as $parameterRef) {
            $parameterRefs[] = ['$ref' => $parameterRef];
        }

        return array_merge($parameters, $parameterRefs);
    }
}
<?php

namespace Somecode\OpenApi\Entities\Method;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Parameter\Parameter;
use Somecode\OpenApi\Entities\Request\RequestBody;
use Somecode\OpenApi\Entities\Response\Response;

abstract class Method
{
    private array $tags = [];

    private string $summary;

    private string $description;

    private string $operationId;

    private ArrayCollection $parameters;

    private ArrayCollection $parameterRefs;

    private RequestBody $requestBody;

    private ArrayCollection $responses;

    public function __construct()
    {
        // TODO: mb need use other method for generate operationId
        $this->operationId = uniqid();
        $this->parameters = new ArrayCollection();
        $this->parameterRefs = new ArrayCollection();
        $this->responses = new ArrayCollection();
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

    public function requestBody(RequestBody $requestBody): Method
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    public function addResponse(Response $response): static
    {
        $this->responses->add($response);

        return $this;
    }

    public function addResponses(array $responses): static
    {
        foreach ($responses as $response) {
            $this->addResponse($response);
        }

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'tags' => $this->tags,
            'operationId' => $this->operationId,
            'parameters' => $this->getParametersAsArray(),
        ];

        if (isset($this->summary)) {
            $data['summary'] = $this->summary;
        }

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->requestBody)) {
            $data['requestBody'] = $this->requestBody->toArray();
        }

        if (! $this->responses->isEmpty()) {
            $data['responses'] = $this->getResponsesArray();
        }

        return $data;
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

    private function getResponsesArray(): array
    {
        $responses = [];

        /** @var Response $response */
        foreach ($this->responses as $response) {
            $responses[$response->getCode()] = $response->toArray();
        }

        return $responses;
    }
}

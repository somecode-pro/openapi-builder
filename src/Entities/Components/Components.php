<?php

namespace Somecode\OpenApi\Entities\Components;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Parameter\Parameter;
use Somecode\OpenApi\Entities\Schema\Schema;

trait Components
{
    /** @var ArrayCollection<Schema[]> */
    protected ArrayCollection $schemas;

    /** @var ArrayCollection<Parameter[]> */
    protected ArrayCollection $parameters;

    protected function initComponents(): void
    {
        $this->schemas = new ArrayCollection();
        $this->parameters = new ArrayCollection();
    }

    public function getSchemas(): ArrayCollection
    {
        return $this->schemas;
    }

    public function addSchema(Schema $schema): static
    {
        if ($schema->isEmptyName()) {
            throw new \InvalidArgumentException('Schema name cannot be empty');
        }

        $this->schemas->add($schema);

        return $this;
    }

    public function addSchemas(array $schemas): static
    {
        foreach ($schemas as $schema) {
            $this->addSchema($schema);
        }

        return $this;
    }

    public function getParameters(): ArrayCollection
    {
        return $this->parameters;
    }

    public function addParameter(Parameter $parameter): static
    {
        if ($parameter->isEmptyName()) {
            throw new \InvalidArgumentException('Parameter name cannot be empty');
        }

        $this->parameters->add($parameter);

        return $this;
    }

    public function addParameters(array $parameters): static
    {
        foreach ($parameters as $parameter) {
            $this->addParameter($parameter);
        }

        return $this;
    }

    public function componentsToArray(): array
    {
        return [
            'schemas' => $this->getSchemasArray(),
            'parameters' => $this->getParametersArray(),
        ];
    }

    private function getSchemasArray(): array
    {
        $data = [];

        /** @var Schema $schema */
        foreach ($this->schemas as $schema) {
            $data[$schema->getName()] = $schema->toArray();
        }

        return $data;
    }

    private function getParametersArray(): array
    {
        $data = [];

        /** @var Parameter $parameter */
        foreach ($this->parameters as $parameter) {
            $data[$parameter->getName()] = $parameter->toArray();
        }

        return $data;
    }
}

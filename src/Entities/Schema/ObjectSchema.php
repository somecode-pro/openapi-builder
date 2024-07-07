<?php

namespace Somecode\OpenApi\Entities\Schema;

use Doctrine\Common\Collections\ArrayCollection;

class ObjectSchema extends Schema
{
    private ArrayCollection $properties;

    private array $required = [];

    private int $minProperties;

    private int $maxProperties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    protected function type(): Type
    {
        return Type::Object;
    }

    protected function specificData(): array
    {
        $data = [
            'properties' => $this->getPropertiesArray(),
        ];

        if (count($this->required) > 0) {
            $data['required'] = $this->required;
        }

        if (isset($this->minProperties)) {
            $data['minProperties'] = $this->minProperties;
        }

        if (isset($this->maxProperties)) {
            $data['maxProperties'] = $this->maxProperties;
        }

        return $data;
    }

    public function addProperty(Schema $schema): static
    {
        if ($schema->isEmptyName()) {
            throw new \InvalidArgumentException('Property name is required');
        }

        if ($schema->isRequired()) {
            $this->required[] = $schema->getName();
        }

        $this->properties->add($schema);

        return $this;
    }

    public function addProperties(array $schemas): static
    {
        foreach ($schemas as $schema) {
            $this->addProperty($schema);
        }

        return $this;
    }

    public function requiredFields(array $array): static
    {
        $this->required = $array;

        return $this;
    }

    public function minProperties(int $minProperties): ObjectSchema
    {
        $this->minProperties = $minProperties;

        return $this;
    }

    public function maxProperties(int $maxProperties): ObjectSchema
    {
        $this->maxProperties = $maxProperties;

        return $this;
    }

    private function getPropertiesArray(): array
    {
        $properties = [];

        /** @var Schema $property */
        foreach ($this->properties as $property) {
            $properties[$property->getName()] = $property->toArray();
        }

        return $properties;
    }
}

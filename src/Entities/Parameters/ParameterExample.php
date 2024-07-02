<?php

namespace Somecode\OpenApi\Entities\Parameters;

class ParameterExample
{
    private string $name;

    private ?string $summary = null;

    private mixed $value;

    public function getName(): string
    {
        return $this->name;
    }

    public function name(string $name): ParameterExample
    {
        $this->name = $name;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function summary(?string $summary): ParameterExample
    {
        $this->summary = $summary;

        return $this;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function value(mixed $value): ParameterExample
    {
        $this->value = $value;

        return $this;
    }
}

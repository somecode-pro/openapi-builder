<?php

namespace Somecode\OpenApi\Entities\Parameter;

class ParameterExample
{
    private string $name;

    private ?string $summary = null;

    private mixed $value;

    public static function create(): static
    {
        return new static();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function name(string $name): ParameterExample
    {
        $this->name = $name;

        return $this;
    }

    public function summary(?string $summary): ParameterExample
    {
        $this->summary = $summary;

        return $this;
    }

    public function value(mixed $value): ParameterExample
    {
        $this->value = $value;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'summary' => $this->summary,
            'value' => $this->value,
        ];
    }
}

<?php

namespace Somecode\OpenApi\Entities\Request\Content;

class ContentExample
{
    private string $name;

    private string $summary;

    private mixed $value;

    public static function create(string $name): static
    {
        $instance = new static();

        $instance->name($name);

        return $instance;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function summary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function value(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if (isset($this->summary)) {
            $data['summary'] = $this->summary;
        }

        if (isset($this->value)) {
            $data['value'] = $this->value;
        }

        return $data;
    }
}

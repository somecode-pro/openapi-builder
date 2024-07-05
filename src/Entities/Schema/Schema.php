<?php

namespace Somecode\OpenApi\Entities\Schema;

abstract class Schema
{
    private string $description;

    private mixed $example;

    private string $format;

    private array $enum;

    private mixed $default;

    abstract protected function type(): Type;

    abstract protected function specificData(): array;

    public static function create(): static
    {
        return new static();
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function description(string $description): Schema
    {
        $this->description = $description;

        return $this;
    }

    public function getExample(): mixed
    {
        return $this->example;
    }

    public function example(mixed $example): Schema
    {
        $this->example = $example;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'type' => $this->type()->value,
        ];

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->example)) {
            $data['example'] = $this->example;
        }

        if (isset($this->format)) {
            $data['format'] = $this->format;
        }

        if (isset($this->enum)) {
            $data['enum'] = $this->enum;
        }

        if (isset($this->default)) {
            $data['default'] = $this->default;
        }

        return array_merge($data, $this->specificData());
    }

    public function getDefault(): mixed
    {
        return $this->default;
    }

    public function default(mixed $default): Schema
    {
        $this->default = $default;

        return $this;
    }

    protected function setFormat(string $format): Schema
    {
        $this->format = $format;

        return $this;
    }

    protected function setEnum(array $enum): Schema
    {
        $this->enum = $enum;

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Schema;

use Somecode\OpenApi\Entities\Schema\Formats\Format;

abstract class Schema
{
    private string $description;

    private mixed $example;

    private Format $format;

    private array $enum;

    private mixed $default;

    private int|float $minimum;

    private int|float $maximum;

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
            $data['format'] = $this->format->value;
        }

        if (isset($this->enum)) {
            $data['enum'] = $this->enum;
        }

        if (isset($this->default)) {
            $data['default'] = $this->default;
        }

        if (isset($this->minimum)) {
            $data['minimum'] = $this->minimum;
        }

        if (isset($this->maximum)) {
            $data['maximum'] = $this->maximum;
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

    protected function setMinimum(float|int $minimum): Schema
    {
        $this->minimum = $minimum;

        return $this;
    }

    protected function setMaximum(float|int $maximum): Schema
    {
        $this->maximum = $maximum;

        return $this;
    }

    protected function setFormat(Format $format): Schema
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

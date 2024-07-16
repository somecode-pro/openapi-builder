<?php

namespace Somecode\OpenApi\Entities\Schema;

use Somecode\OpenApi\Entities\Schema\Addons\HasSchemaRef;
use Somecode\OpenApi\Entities\Schema\Formats\Format;

abstract class Schema
{
    use HasSchemaRef;

    private string $name;

    private string $description;

    private mixed $example;

    private Format $format;

    private array $enum;

    private mixed $default;

    private int|float $minimum;

    private int|float $maximum;

    private bool $isRequired = false;

    abstract protected function type(): Type;

    abstract protected function specificData(): array;

    public static function create(?string $name = null): static
    {
        $instance = new static();

        if (! is_null($name)) {
            $instance->name($name);
        }

        return $instance;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function name(string $name): Schema
    {
        $this->name = $name;

        return $this;
    }

    public function isEmptyName(): bool
    {
        return empty($this->name);
    }

    public function description(string $description): Schema
    {
        $this->description = $description;

        return $this;
    }

    public function example(mixed $example): Schema
    {
        $this->example = $example;

        return $this;
    }

    public function default(mixed $default): Schema
    {
        $this->default = $default;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function markAsRequired(): Schema
    {
        $this->isRequired = true;

        return $this;
    }

    public function toArray(): array
    {
        if (! $this->isEmptyRef()) {
            return ['$ref' => $this->getRef()];
        }

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

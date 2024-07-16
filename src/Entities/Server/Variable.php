<?php

namespace Somecode\OpenApi\Entities\Server;

use Somecode\OpenApi\Entities\Schema\Addons\HasEnum;

class Variable
{
    use HasEnum;

    private string $name;

    private string $description;

    private mixed $default;

    private array $enum;

    public static function create(?string $name = null): static
    {
        $instance = new static();

        if (! is_null($name)) {
            $instance->name($name);
        }

        return $instance;
    }

    public function isEmptyName(): bool
    {
        return empty($this->name);
    }

    public function name(string $name): Variable
    {
        $this->name = $name;

        return $this;
    }

    public function default(mixed $default): Variable
    {
        $this->default = $default;

        return $this;
    }

    public function description(string $description): Variable
    {
        $this->description = $description;

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->default)) {
            $data['default'] = $this->default;
        }

        if (isset($this->enum)) {
            $data['enum'] = $this->enum;
        }

        return $data;
    }

    protected function setEnum(array $enum): static
    {
        $this->enum = $enum;

        return $this;
    }
}

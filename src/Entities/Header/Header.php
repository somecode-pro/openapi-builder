<?php

namespace Somecode\OpenApi\Entities\Header;

use Somecode\OpenApi\Entities\Schema\HasSchema;

class Header
{
    use HasSchema;

    private string $description;

    public function __construct(
        private string $name
    ) {}

    public static function create(string $name): static
    {
        return new static($name);
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function name(string $name): Header
    {
        $this->name = $name;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'schema' => $this->schemaToArray(),
        ];

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        return $data;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Security;

class Security
{
    private string $name;

    private SecurityType $type;

    private SecurityScheme $scheme;

    public function getName(): string
    {
        return $this->name;
    }

    public function name(string $name): Security
    {
        $this->name = $name;

        return $this;
    }

    public function type(SecurityType $type): Security
    {
        $this->type = $type;

        return $this;
    }

    public function scheme(SecurityScheme $scheme): Security
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'scheme' => $this->scheme->value,
        ];
    }
}

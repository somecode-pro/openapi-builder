<?php

namespace Somecode\OpenApi\Entities\Security;

class BearerScheme extends Security
{
    public static function create(string $name): static
    {
        $instance = new static();

        $instance
            ->name($name)
            ->type(SecurityType::Http)
            ->scheme(SecurityScheme::Bearer);

        return $instance;
    }
}

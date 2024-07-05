<?php

namespace Somecode\OpenApi\Entities\Schema\Addons;

trait HasEnum
{
    public function enum(array|string $enum): static
    {
        if (is_array($enum)) {
            $this->setEnum($enum);

            return $this;
        }

        if (! enum_exists($enum)) {
            throw new \InvalidArgumentException('Enum must be an array or an Enum class');
        }

        $enum = $this->enumToArray($enum);

        $this->setEnum($enum);

        return $this;
    }

    private function enumToArray(string $enum): array
    {
        $enumValues = array_column($enum::cases(), 'value');

        if (count($enumValues) === 0) {
            $enumValues = array_column($enum::cases(), 'name');
        }

        if (count($enumValues) === 0) {
            throw new \InvalidArgumentException('Enum must have at least one value');
        }

        return $enumValues;
    }
}

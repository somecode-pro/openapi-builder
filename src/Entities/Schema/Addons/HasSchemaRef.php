<?php

namespace Somecode\OpenApi\Entities\Schema\Addons;

trait HasSchemaRef
{
    private string $ref;

    public function ref(string $ref): static
    {
        $this->ref = "#/components/schemas/$ref";

        return $this;
    }

    public function getRef(): string
    {
        return $this->ref;
    }

    public function isEmptyRef(): bool
    {
        return empty($this->ref);
    }
}

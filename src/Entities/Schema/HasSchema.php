<?php

namespace Somecode\OpenApi\Entities\Schema;

trait HasSchema
{
    private Schema|string $schema;

    public function schema(Schema|string $schema): static
    {
        if (is_string($schema)) {
            $this->schema = str_replace('#/components/schemas/', '', $schema);
        } else {
            $this->schema = $schema;
        }

        return $this;
    }

    private function schemaToArray(): array
    {
        if (! isset($this->schema)) {
            return [];
        }

        if ($this->schema instanceof Schema) {
            return $this->schema->toArray();
        }

        return [
            '$ref' => "#/components/schemas/$this->schema",
        ];
    }
}

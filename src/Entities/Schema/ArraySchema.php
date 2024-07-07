<?php

namespace Somecode\OpenApi\Entities\Schema;

class ArraySchema extends Schema
{
    private int $minItems;

    private int $maxItems;

    private bool $uniqueItems;

    private Schema|string $itemsSchema;

    protected function type(): Type
    {
        return Type::Array;
    }

    protected function specificData(): array
    {
        if (! isset($this->itemsSchema)) {
            throw new \InvalidArgumentException('Items schema is required');
        }

        $data = [
            'items' => $this->getItemsSchemaData(),
        ];

        if (isset($this->minItems)) {
            $data['minItems'] = $this->minItems;
        }

        if (isset($this->maxItems)) {
            $data['maxItems'] = $this->maxItems;
        }

        if (isset($this->uniqueItems)) {
            $data['uniqueItems'] = $this->uniqueItems;
        }

        return $data;
    }

    public function minItems(int $minItems): static
    {
        $this->minItems = $minItems;

        return $this;
    }

    public function maxItems(int $maxItems): static
    {
        $this->maxItems = $maxItems;

        return $this;
    }

    public function uniqueItems(bool $uniqueItems = true): static
    {
        $this->uniqueItems = $uniqueItems;

        return $this;
    }

    public function itemsSchema(Schema|string $schema): static
    {
        $this->itemsSchema = $schema;

        return $this;
    }

    private function getItemsSchemaData(): array
    {
        if (is_string($this->itemsSchema)) {
            return ['$ref' => "#/components/schemas/$this->itemsSchema"];
        } else {
            return $this->itemsSchema->toArray();
        }
    }
}

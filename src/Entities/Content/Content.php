<?php

namespace Somecode\OpenApi\Entities\Content;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Schema\Schema;

abstract class Content
{
    private Schema|string $schema;

    private ArrayCollection $examples;

    // TODO: Implement in the next iteration
    private mixed $encoding;

    public function __construct()
    {
        $this->examples = new ArrayCollection();
    }

    abstract public function contentType(): ContentType;

    public static function create(): static
    {
        return new static();
    }

    public function schema(string|Schema $schema): Content
    {
        $this->schema = $schema;

        return $this;
    }

    public function addExample(ContentExample $example): Content
    {
        $this->examples->add($example);

        return $this;
    }

    public function addExamples(array $examples): static
    {
        foreach ($examples as $example) {
            $this->addExample($example);
        }

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if (isset($this->schema)) {
            $data['schema'] = $this->getSchemaData();
        }

        if (! $this->examples->isEmpty()) {
            $data['examples'] = $this->getExamplesArray();
        }

        return $data;
    }

    private function getSchemaData(): array
    {
        if ($this->schema instanceof Schema) {
            return $this->schema->toArray();
        }

        return [
            '$ref' => "#/components/schemas/$this->schema",
        ];
    }

    private function getExamplesArray(): array
    {
        $examples = [];

        /** @var ContentExample $example */
        foreach ($this->examples as $example) {
            $examples[$example->getName()] = $example->toArray();
        }

        return $examples;
    }
}

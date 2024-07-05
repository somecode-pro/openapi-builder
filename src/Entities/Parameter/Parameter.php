<?php

namespace Somecode\OpenApi\Entities\Parameter;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Schema\Schema;

abstract class Parameter
{
    private string $name;

    private ?string $description = null;

    private bool $required = false;

    private bool $deprecated = false;

    private Schema $schema;

    private mixed $example;

    /** @var ArrayCollection<ParameterExample[]> */
    private ArrayCollection $examples;

    private string $style;

    private bool $explode = false;

    public function __construct()
    {
        $this->examples = new ArrayCollection();
    }

    abstract public function type(): Type;

    abstract protected function specificData(): array;

    abstract protected function defaultStyle(): string;

    public static function create(): static
    {
        return new static();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function name(string $name): Parameter
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function description(?string $description): Parameter
    {
        $this->description = $description;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): Parameter
    {
        $this->required = $required;

        return $this;
    }

    public function asRequired(): static
    {
        $this->required = true;

        return $this;
    }

    public function isDeprecated(): bool
    {
        return $this->deprecated;
    }

    public function setDeprecated(bool $deprecated): Parameter
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    public function asDeprecated(): Parameter
    {
        $this->deprecated = true;

        return $this;
    }

    public function getSchema(): Schema
    {
        return $this->schema;
    }

    public function schema(Schema $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function getExample(): mixed
    {
        return $this->example;
    }

    public function example(mixed $example): Parameter
    {
        $this->example = $example;

        return $this;
    }

    public function getExamples(): ArrayCollection
    {
        return $this->examples;
    }

    public function addExample(ParameterExample $example): Parameter
    {
        $this->examples->add($example);

        return $this;
    }

    /**
     * @param  array<ParameterExample>  $examples
     * @return $this
     */
    public function addExamples(array $examples): Parameter
    {
        foreach ($examples as $example) {
            $this->addExample($example);
        }

        return $this;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function isExplode(): bool
    {
        return $this->explode;
    }

    public function setExplode(bool $explode): Parameter
    {
        $this->explode = $explode;

        return $this;
    }

    public function asExplode(): Parameter
    {
        $this->explode = true;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'in' => $this->type()->value,
            'name' => $this->name,
            'description' => $this->description,
            'required' => $this->required,
            'deprecated' => $this->deprecated,
            'schema' => $this->schema->toArray(),
            'style' => $this->style ?? $this->defaultStyle(),
            'explode' => $this->explode,
        ];

        if (isset($this->example)) {
            $data['example'] = $this->example;
        }

        if (count($this->examples) > 0) {
            $data['examples'] = $this->getExamplesAsArray();
        }

        return array_merge($data, $this->specificData());
    }

    protected function setStyle(string $style): static
    {
        $this->style = $style;

        return $this;
    }

    private function getExamplesAsArray(): array
    {
        $examples = [];

        /** @var ParameterExample $example */
        foreach ($this->examples as $example) {
            $examples[$example->getName()] = $example->toArray();
        }

        return $examples;
    }
}

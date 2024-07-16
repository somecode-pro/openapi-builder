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

    public static function create(?string $name = null): static
    {
        $instance = new static();

        if (! is_null($name)) {
            $instance->name($name);
        }

        return $instance;
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

    public function isEmptyName(): bool
    {
        return empty($this->name);
    }

    public function description(?string $description): Parameter
    {
        $this->description = $description;

        return $this;
    }

    public function required(bool $required = true): Parameter
    {
        $this->required = $required;

        return $this;
    }

    public function deprecated(bool $deprecated = true): Parameter
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    public function schema(Schema $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function example(mixed $example): Parameter
    {
        $this->example = $example;

        return $this;
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

    public function explode(bool $explode = true): Parameter
    {
        $this->explode = $explode;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'in' => $this->type()->value,
            'required' => $this->required,
            'deprecated' => $this->deprecated,
            'style' => $this->style ?? $this->defaultStyle(),
            'explode' => $this->explode,
        ];

        if (isset($this->name)) {
            $data['name'] = $this->name;
        }

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->schema)) {
            $data['schema'] = $this->schema->toArray();
        }

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

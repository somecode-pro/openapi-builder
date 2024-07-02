<?php

namespace Somecode\OpenApi\Entities\Parameters;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Enums\ParameterType;

abstract class Parameter
{
    private string $name;

    private ?string $description = null;

    private bool $required = false;

    private bool $deprecated = false;

    // TODO: implement after Schema class is implemented
    private $schema;

    private mixed $example;

    private ArrayCollection $examples;

    private string $style;

    private bool $explode;

    public function __construct()
    {
        $this->examples = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param  mixed  $schema
     * @return Parameter
     */
    public function setSchema($schema)
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

    // TODO: implement addExample method
    public function addExample($example): Parameter
    {
        $this->examples->add($example);

        return $this;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function style(string $style): Parameter
    {
        $this->style = $style;

        return $this;
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

    abstract public function type(): ParameterType;
}

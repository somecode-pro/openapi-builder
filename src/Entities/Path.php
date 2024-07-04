<?php

namespace Somecode\OpenApi\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Method\Method;

class Path
{
    private ArrayCollection $methods;

    public function __construct(
        private string $uri
    ) {
        $this->methods = new ArrayCollection();
    }

    public static function create(string $uri): static
    {
        return new static($uri);
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function applyPrefix(string $prefix): Path
    {
        $this->uri = $prefix.$this->uri;

        return $this;
    }

    public function addMethod(Method $method): Path
    {
        $this->methods->add($method);

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        /** @var Method $method */
        foreach ($this->methods as $method) {
            $data[strtolower($method->method()->value)] = $method->toArray();
        }

        return $data;
    }
}

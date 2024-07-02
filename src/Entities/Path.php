<?php

namespace Somecode\OpenApi\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Methods\Method;

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
}

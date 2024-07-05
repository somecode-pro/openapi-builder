<?php

namespace Somecode\OpenApi\Entities\Schema\Addons;

trait HasMaximum
{
    public function maximum(int|float $maximum): static
    {
        $this->setMaximum($maximum);

        return $this;
    }
}

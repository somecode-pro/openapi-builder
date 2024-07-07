<?php

namespace Somecode\OpenApi\Entities\Schema\Addons;

trait HasMinimum
{
    public function minimum(int|float $minimum): static
    {
        $this->setMinimum($minimum);

        return $this;
    }
}

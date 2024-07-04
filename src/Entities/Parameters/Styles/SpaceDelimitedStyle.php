<?php

namespace Somecode\OpenApi\Entities\Parameters\Styles;

trait SpaceDelimitedStyle
{
    public function useSpaceDelimitedStyle(): static
    {
        $this->setStyle('spaceDelimited');

        return $this;
    }
}

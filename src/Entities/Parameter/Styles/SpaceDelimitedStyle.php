<?php

namespace Somecode\OpenApi\Entities\Parameter\Styles;

trait SpaceDelimitedStyle
{
    public function useSpaceDelimitedStyle(): static
    {
        $this->setStyle('spaceDelimited');

        return $this;
    }
}

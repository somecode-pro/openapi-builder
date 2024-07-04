<?php

namespace Somecode\OpenApi\Entities\Parameters\Styles;

trait FormStyle
{
    public function useFormStyle(): static
    {
        $this->setStyle('form');

        return $this;
    }
}

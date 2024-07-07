<?php

namespace Somecode\OpenApi\Entities\Parameter\Styles;

trait FormStyle
{
    public function useFormStyle(): static
    {
        $this->setStyle('form');

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Parameters\Styles;

trait MatrixStyle
{
    public function useMatrixStyle(): static
    {
        $this->setStyle('matrix');

        return $this;
    }
}

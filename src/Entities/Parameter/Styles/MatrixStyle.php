<?php

namespace Somecode\OpenApi\Entities\Parameter\Styles;

trait MatrixStyle
{
    public function useMatrixStyle(): static
    {
        $this->setStyle('matrix');

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Parameter\Styles;

trait LabelStyle
{
    public function useLabelStyle(): static
    {
        $this->setStyle('label');

        return $this;
    }
}

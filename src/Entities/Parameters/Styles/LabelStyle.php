<?php

namespace Somecode\OpenApi\Entities\Parameters\Styles;

trait LabelStyle
{
    public function useLabelStyle(): static
    {
        $this->setStyle('label');

        return $this;
    }
}

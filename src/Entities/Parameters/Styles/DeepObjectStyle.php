<?php

namespace Somecode\OpenApi\Entities\Parameters\Styles;

trait DeepObjectStyle
{
    public function useDeepObjectStyle(): static
    {
        $this->setStyle('deepObject');

        return $this;
    }
}

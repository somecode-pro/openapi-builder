<?php

namespace Somecode\OpenApi\Entities\Parameters\Styles;

trait SimpleStyle
{
    public function useSimpleStyle(): static
    {
        $this->setStyle('simple');

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Parameter\Styles;

trait SimpleStyle
{
    public function useSimpleStyle(): static
    {
        $this->setStyle('simple');

        return $this;
    }
}

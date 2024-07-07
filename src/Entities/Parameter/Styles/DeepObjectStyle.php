<?php

namespace Somecode\OpenApi\Entities\Parameter\Styles;

trait DeepObjectStyle
{
    public function useDeepObjectStyle(): static
    {
        $this->setStyle('deepObject');

        return $this;
    }
}

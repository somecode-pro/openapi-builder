<?php

namespace Somecode\OpenApi\Entities\Parameters\Styles;

trait PipeDelimitedStyle
{
    public function usePipeDelimitedStyle(): static
    {
        $this->setStyle('pipeDelimited');

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Parameter\Styles;

trait PipeDelimitedStyle
{
    public function usePipeDelimitedStyle(): static
    {
        $this->setStyle('pipeDelimited');

        return $this;
    }
}

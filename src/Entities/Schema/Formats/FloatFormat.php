<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait FloatFormat
{
    public function useFloatFormat(): static
    {
        $this->setFormat(Format::Float);

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait DoubleFormat
{
    public function useDoubleFormat(): static
    {
        $this->setFormat(Format::Double);

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait BinaryFormat
{
    public function useBinaryFormat(): static
    {
        $this->setFormat(Format::Binary);

        return $this;
    }
}

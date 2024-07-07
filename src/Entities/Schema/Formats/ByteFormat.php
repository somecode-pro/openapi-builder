<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait ByteFormat
{
    public function useByteFormat(): static
    {
        $this->setFormat(Format::Byte);

        return $this;
    }
}

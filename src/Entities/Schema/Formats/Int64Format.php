<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait Int64Format
{
    public function useInt64Format(): static
    {
        $this->setFormat(Format::Int64);

        return $this;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait Int32Format
{
    public function useInt32Format(): static
    {
        $this->setFormat(Format::Int32);

        return $this;
    }
}

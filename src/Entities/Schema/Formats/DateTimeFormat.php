<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait DateTimeFormat
{
    public function useDateTimeFormat(): static
    {
        $this->setFormat(Format::DateTime);

        return $this;
    }
}

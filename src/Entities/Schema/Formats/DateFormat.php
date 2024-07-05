<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait DateFormat
{
    public function useDateFormat(): static
    {
        $this->setFormat(Format::Date);

        return $this;
    }
}

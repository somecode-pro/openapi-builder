<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

trait PasswordFormat
{
    public function usePasswordFormat(): static
    {
        $this->setFormat(Format::Password);

        return $this;
    }
}

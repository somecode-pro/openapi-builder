<?php

namespace Somecode\OpenApi\Entities\Schema;

use Somecode\OpenApi\Entities\Schema\Addons\HasEnum;
use Somecode\OpenApi\Entities\Schema\Formats\BinaryFormat;
use Somecode\OpenApi\Entities\Schema\Formats\ByteFormat;
use Somecode\OpenApi\Entities\Schema\Formats\DateFormat;
use Somecode\OpenApi\Entities\Schema\Formats\DateTimeFormat;
use Somecode\OpenApi\Entities\Schema\Formats\PasswordFormat;

class StringSchema extends Schema
{
    use BinaryFormat, ByteFormat, DateFormat, DateTimeFormat, HasEnum, PasswordFormat;

    private int $minLength;

    private int $maxLength;

    private string $pattern;

    protected function type(): Type
    {
        return Type::String;
    }

    protected function specificData(): array
    {
        $data = [];

        if (isset($this->minLength)) {
            $data['minLength'] = $this->minLength;
        }

        if (isset($this->maxLength)) {
            $data['maxLength'] = $this->maxLength;
        }

        if (isset($this->pattern)) {
            $data['pattern'] = $this->pattern;
        }

        return $data;
    }

    public function getMinLength(): int
    {
        return $this->minLength;
    }

    public function minLength(int $minLength): StringSchema
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    public function maxLength(int $maxLength): StringSchema
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function pattern(string $pattern): StringSchema
    {
        $this->pattern = $pattern;

        return $this;
    }
}

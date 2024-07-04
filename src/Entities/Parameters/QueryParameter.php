<?php

namespace Somecode\OpenApi\Entities\Parameters;

use Somecode\OpenApi\Entities\Parameters\Styles\DeepObjectStyle;
use Somecode\OpenApi\Entities\Parameters\Styles\FormStyle;
use Somecode\OpenApi\Entities\Parameters\Styles\PipeDelimitedStyle;
use Somecode\OpenApi\Entities\Parameters\Styles\SpaceDelimitedStyle;
use Somecode\OpenApi\Enums\ParameterType;

class QueryParameter extends Parameter
{
    use DeepObjectStyle, FormStyle, PipeDelimitedStyle, SpaceDelimitedStyle;

    private bool $allowEmptyValue = false;

    private bool $allowReserved = false;

    public function type(): ParameterType
    {
        return ParameterType::Query;
    }

    protected function specificData(): array
    {
        return [
            'allowEmptyValue' => $this->allowEmptyValue,
            'allowReserved' => $this->allowReserved,
        ];
    }

    protected function defaultStyle(): string
    {
        return 'form';
    }

    public function isAllowEmptyValue(): bool
    {
        return $this->allowEmptyValue;
    }

    public function allowEmptyValue(bool $allowEmptyValue = true): QueryParameter
    {
        $this->allowEmptyValue = $allowEmptyValue;

        return $this;
    }

    public function isAllowReserved(): bool
    {
        return $this->allowReserved;
    }

    public function allowReserved(bool $allowReserved = true): QueryParameter
    {
        $this->allowReserved = $allowReserved;

        return $this;
    }
}

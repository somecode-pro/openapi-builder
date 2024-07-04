<?php

namespace Somecode\OpenApi\Entities\Parameters;

use Somecode\OpenApi\Entities\Parameters\Styles\LabelStyle;
use Somecode\OpenApi\Entities\Parameters\Styles\MatrixStyle;
use Somecode\OpenApi\Entities\Parameters\Styles\SimpleStyle;
use Somecode\OpenApi\Enums\ParameterType;

class PathParameter extends Parameter
{
    use LabelStyle, MatrixStyle, SimpleStyle;

    public function type(): ParameterType
    {
        return ParameterType::Path;
    }

    protected function specificData(): array
    {
        return [
            'required' => true,
        ];
    }

    protected function defaultStyle(): string
    {
        return 'simple';
    }
}

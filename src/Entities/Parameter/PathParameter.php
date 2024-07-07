<?php

namespace Somecode\OpenApi\Entities\Parameter;

use Somecode\OpenApi\Entities\Parameter\Styles\LabelStyle;
use Somecode\OpenApi\Entities\Parameter\Styles\MatrixStyle;
use Somecode\OpenApi\Entities\Parameter\Styles\SimpleStyle;

class PathParameter extends Parameter
{
    use LabelStyle, MatrixStyle, SimpleStyle;

    public function type(): Type
    {
        return Type::Path;
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

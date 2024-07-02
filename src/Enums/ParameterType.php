<?php

namespace Somecode\OpenApi\Enums;

enum ParameterType: string
{
    case Query = 'query';
    case Path = 'path';
    case Header = 'header';
    case Cookie = 'cookie';
}

<?php

namespace Somecode\OpenApi\Entities\Parameter;

enum Type: string
{
    case Query = 'query';
    case Path = 'path';
    case Header = 'header';
    case Cookie = 'cookie';
}

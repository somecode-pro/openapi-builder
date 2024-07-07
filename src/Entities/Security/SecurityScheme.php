<?php

namespace Somecode\OpenApi\Entities\Security;

enum SecurityScheme: string
{
    case Bearer = 'bearer';
    case Basic = 'basic';
}

<?php

namespace Somecode\OpenApi\Entities\Schema\Formats;

enum Format: string
{
    // For integer format
    case Int32 = 'int32';
    case Int64 = 'int64';

    // For number format
    case Float = 'float';
    case Double = 'double';

    // For string format
    case Byte = 'byte';
    case Binary = 'binary';
    case Date = 'date';
    case DateTime = 'date-time';
    case Password = 'password';
}

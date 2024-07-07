<?php

namespace Somecode\OpenApi\Entities\Content;

enum ContentType: string
{
    case Json = 'application/json';
    case Xml = 'application/xml';
    case PlainText = 'text/plain';
    case FormData = 'multipart/form-data';
}

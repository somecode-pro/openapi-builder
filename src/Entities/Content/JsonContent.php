<?php

namespace Somecode\OpenApi\Entities\Content;

class JsonContent extends Content
{
    public function contentType(): ContentType
    {
        return ContentType::Json;
    }
}

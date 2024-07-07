<?php

namespace Somecode\OpenApi\Entities\Request\Content;

class JsonContent extends Content
{
    public function contentType(): ContentType
    {
        return ContentType::Json;
    }
}

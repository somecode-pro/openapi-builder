<?php

namespace Somecode\OpenApi\Entities\Content;

class FormContent extends Content
{
    public function contentType(): ContentType
    {
        return ContentType::FormData;
    }
}

<?php

namespace Somecode\OpenApi\Entities\Request\Content;

class FormContent extends Content
{
    public function contentType(): ContentType
    {
        return ContentType::FormData;
    }
}

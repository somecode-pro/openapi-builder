<?php

namespace Somecode\OpenApi\Entities;

class Info
{
    public function __construct(
        private ?string $title = null,
        private ?string $version = null,
        private ?string $description = null,
    ) {}

    public function setTitle(?string $title): Info
    {
        $this->title = $title;

        return $this;
    }

    public function setVersion(?string $version): Info
    {
        $this->version = $version;

        return $this;
    }

    public function setDescription(?string $description): Info
    {
        $this->description = $description;

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if (! is_null($this->title)) {
            $data['title'] = $this->title;
        }

        if (! is_null($this->version)) {
            $data['version'] = $this->version;
        }

        if (! is_null($this->description)) {
            $data['description'] = $this->description;
        }

        return $data;
    }
}

<?php

namespace Somecode\OpenApi\Entities;

class Info
{
    public function __construct(
        private ?string $title = null,
        private ?string $version = null,
        private ?string $description = null,
    )
    { }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Info
    {
        $this->title = $title;
        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): Info
    {
        $this->version = $version;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Info
    {
        $this->description = $description;
        return $this;
    }
}

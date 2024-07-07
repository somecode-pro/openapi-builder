<?php

namespace Somecode\OpenApi\Entities\Request;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Request\Content\Content;

class RequestBody
{
    private string $description;

    private bool $required;

    private ArrayCollection $content;

    public function __construct()
    {
        $this->content = new ArrayCollection();
    }

    public static function create(): static
    {
        return new static();
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function required(bool $required = true): static
    {
        $this->required = $required;

        return $this;
    }

    public function addContent(Content $content): static
    {
        $this->content->add($content);

        return $this;
    }

    public function addContents(array $contents): static
    {
        foreach ($contents as $content) {
            $this->addContent($content);
        }

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->required)) {
            $data['required'] = $this->required;
        }

        if (! $this->content->isEmpty()) {
            $data['content'] = $this->getContentsArray();
        }

        return $data;
    }

    private function getContentsArray(): array
    {
        $contents = [];

        /** @var Content $content */
        foreach ($this->content as $content) {
            $contents[$content->contentType()->value] = $content->toArray();
        }

        return $contents;
    }
}

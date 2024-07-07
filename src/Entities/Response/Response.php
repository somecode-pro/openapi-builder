<?php

namespace Somecode\OpenApi\Entities\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Content\Content;
use Somecode\OpenApi\Entities\Header\Header;

class Response
{
    private int $code;

    private string $description;

    private ArrayCollection $headers;

    private ArrayCollection $content;

    // TODO: Implement in the next iteration
    private ArrayCollection $links;

    public function __construct(int $code)
    {
        $this->code = $code;
        $this->headers = new ArrayCollection();
        $this->content = new ArrayCollection();
    }

    public static function create(int $code): static
    {
        return new static($code);
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function description(string $description): Response
    {
        $this->description = $description;

        return $this;
    }

    public function addHeader(Header $header): static
    {
        $this->headers->add($header);

        return $this;
    }

    public function addHeaders(array $headers): static
    {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }

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

        if (! $this->content->isEmpty()) {
            $data['content'] = $this->getContentsArray();
        }

        if (! $this->headers->isEmpty()) {
            $data['headers'] = $this->getHeadersArray();
        }

        return $data;
    }

    public static function ok(): static
    {
        return new static(200);
    }

    public static function notFound(): static
    {
        return new static(404);
    }

    public static function badRequest(): static
    {
        return new static(400);
    }

    public static function serverError(): static
    {
        return new static(500);
    }

    public static function forbidden(): static
    {
        return new static(403);
    }

    public static function unauthorized(): static
    {
        return new static(401);
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

    private function getHeadersArray(): array
    {
        $headers = [];

        /** @var Header $header */
        foreach ($this->headers as $header) {
            $headers[$header->getName()] = $header->toArray();
        }

        return $headers;
    }
}

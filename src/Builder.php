<?php

namespace Somecode\OpenApi;

use Doctrine\Common\Collections\ArrayCollection;
use Somecode\OpenApi\Entities\Components\Components;
use Somecode\OpenApi\Entities\Info;
use Somecode\OpenApi\Entities\Path;
use Somecode\OpenApi\Entities\Security\HasSecurity;
use Somecode\OpenApi\Entities\Server\Server;
use Somecode\OpenApi\Services\JsonSerializer;

class Builder
{
    use Components, HasSecurity;

    private string $version = '3.0.0';

    private string $prefix = '';

    private Info $info;

    /** @var ArrayCollection<array<Path>> */
    private ArrayCollection $paths;

    private ArrayCollection $servers;

    public function __construct(
        ?string $title = null,
        ?string $version = null,
        ?string $description = null
    ) {
        $this->info = new Info($title, $version, $description);
        $this->paths = new ArrayCollection();
        $this->servers = new ArrayCollection();
        $this->initComponents();
    }

    public function openApiVersion(): string
    {
        return $this->version;
    }

    public function title(string $title): Builder
    {
        $this->info->setTitle($title);

        return $this;
    }

    public function version(string $version): Builder
    {
        $this->info->setVersion($version);

        return $this;
    }

    public function description(string $description): Builder
    {
        $this->info->setDescription($description);

        return $this;
    }

    public function prefix(string $prefix): Builder
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function info(): Info
    {
        return $this->info;
    }

    public function paths(): ArrayCollection
    {
        return $this->paths;
    }

    public function addPath(Path $path): Builder
    {
        $path->applyPrefix($this->prefix);

        $this->paths->add($path);

        return $this;
    }

    public function addPaths(array $paths): Builder
    {
        foreach ($paths as $path) {
            $this->addPath($path);
        }

        return $this;
    }

    public function addServer(Server $server): static
    {
        $this->servers->add($server);

        return $this;
    }

    public function addServers(array $servers): static
    {
        foreach ($servers as $server) {
            $this->addServer($server);
        }

        return $this;
    }

    public function servers(): ArrayCollection
    {
        return $this->servers;
    }

    public function toJson(): string
    {
        $serializer = new JsonSerializer($this);

        return $serializer->serialize();
    }
}

<?php

namespace Somecode\OpenApi\Entities\Server;

use Doctrine\Common\Collections\ArrayCollection;

class Server
{
    private string $url;

    private string $description;

    private ArrayCollection $variables;

    public function __construct()
    {
        $this->variables = new ArrayCollection();
    }

    public static function create(?string $url = null): static
    {
        $instance = new static();

        if (! is_null($url)) {
            $instance->url($url);
        }

        return $instance;
    }

    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function addVariable(Variable $variable): static
    {
        if ($variable->isEmptyName()) {
            throw new \InvalidArgumentException('Variable name is required');
        }

        $this->variables->add($variable);

        return $this;
    }

    public function addVariables(array $variables): static
    {
        foreach ($variables as $variable) {
            $this->addVariable($variable);
        }

        return $this;
    }

    public function toArray(): array
    {
        if (! isset($this->url)) {
            throw new \Exception('Server URL is required');
        }

        $data = [
            'url' => $this->url,
        ];

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (! $this->variables->isEmpty()) {
            $data['variables'] = $this->getVariablesArray();
        }

        return $data;
    }

    private function getVariablesArray(): array
    {
        $variables = [];

        /** @var Variable $variable */
        foreach ($this->variables as $variable) {
            $variables[$variable->getName()] = $variable->toArray();
        }

        return $variables;
    }
}

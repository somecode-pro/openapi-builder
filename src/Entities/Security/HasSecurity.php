<?php

namespace Somecode\OpenApi\Entities\Security;

use Doctrine\Common\Collections\ArrayCollection;

trait HasSecurity
{
    private ArrayCollection $security;

    public function getSecurity(): ArrayCollection
    {
        return $this->security ??= new ArrayCollection();
    }

    public function useSecurity(array|string $security): static
    {
        if (is_string($security)) {
            $this->getSecurity()->add($security);
        } else {
            $this->security = new ArrayCollection($security);
        }

        return $this;
    }

    public function securityToArray()
    {
        return $this->getSecurity()->map(
            fn (string $security) => [$security => []]
        )->toArray();
    }

    public function hasSecurity(): bool
    {
        return $this->getSecurity()->count() > 0;
    }
}

<?php

namespace App;

final class Configuration
{
    protected array $credentials;

    public function setCredentials(array $credentials): void
    {
        $this->credentials = $credentials;
    }

    public function getCredentials(): array
    {
        return $this->credentials;
    }
}

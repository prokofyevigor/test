<?php

namespace App;

class EmailConfiguration extends Configuration
{
    public function setCredentials(array $credentials): void
    {
        $this->validate($credentials);

        parent::setCredentials($credentials);
    }

    public function validate(array $configuration)
    {
        // Some validation rules. Imagine that she is here.
    }
}

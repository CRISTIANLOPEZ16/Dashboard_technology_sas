<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;

Class Name {

    private string $name;

    public function __construct(string $name)
    {
        if (strlen($name) < 3) {
            throw new InvalidArgumentException("Name must be at least 3 characters long");
        }
        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
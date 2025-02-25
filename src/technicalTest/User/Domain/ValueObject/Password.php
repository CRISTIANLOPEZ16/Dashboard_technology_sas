<?php

namespace App\Domain\ValueObject;
use App\Domain\Exception\WeakPasswordException;
use InvalidArgumentException;

class Password
{
    private string $hashedPassword;

    public function __construct(string $password)
    {
        $this->validate($password);
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    private function validate(string $password): void
    {
        if (strlen($password) < 8) {
            throw new WeakPasswordException("Password must be at least 8 characters long");
        }
        if (!preg_match('/[A-Z]/', $password)) {
            throw new WeakPasswordException("Password must contain at least one uppercase letter");
        }
        if (!preg_match('/\d/', $password)) {
            throw new WeakPasswordException("Password must contain at least one number");
        }
        if (!preg_match('/[\W]/', $password)) {
            throw new WeakPasswordException("Password must contain at least one special character");
        }
    }

    public function getHashedValue(): string
    {
        return $this->hashedPassword;
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedPassword);
    }

    public function __toString(): string
    {
        return $this->hashedPassword;
    }
}

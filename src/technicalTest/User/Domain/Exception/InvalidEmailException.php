<?php

namespace App\Domain\Exception;

use DomainException;

class InvalidEmailException extends DomainException
{
    public function __construct(string $email)
    {
        parent::__construct("The email '{$email}' is not valid.");
    }
}

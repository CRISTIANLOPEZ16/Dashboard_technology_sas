<?php
namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use InvalidArgumentException;

class UserId
{
    private UuidInterface $id;

    public function __construct(?string $id = null)
    {
        if ($id === null) {
            $this->id = Uuid::uuid4(); // Genera un UUID si es null
        } else {
            if (!Uuid::isValid($id)) {
                throw new InvalidArgumentException("Invalid UUID string");
            }
            $this->id = Uuid::fromString($id);
        }
    }

    public function getValue(): string
    {
        return $this->id->toString();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
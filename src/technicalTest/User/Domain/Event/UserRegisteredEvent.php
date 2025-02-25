<?php

namespace App\Domain\Event;

use App\Domain\Entity\User;

class UserRegisteredEvent implements DomainEventInterface
{
    private User $user;
    private \DateTimeImmutable $occurredOn;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}

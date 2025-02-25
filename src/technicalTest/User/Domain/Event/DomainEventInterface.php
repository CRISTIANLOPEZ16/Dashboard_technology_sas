<?php

namespace App\Domain\Event;

interface DomainEventInterface
{
    public function occurredOn(): \DateTimeImmutable;
}

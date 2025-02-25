<?php

namespace App\Domain\Event;

class DomainEventDispatcher
{
    private array $listeners = [];

    public function subscribe(string $eventClass, EventListenerInterface $listener): void
    {
        $this->listeners[$eventClass][] = $listener;
    }

    public function dispatch(DomainEventInterface $event): void
    {
        $eventClass = get_class($event);

        if (!isset($this->listeners[$eventClass])) {
            return;
        }

        foreach ($this->listeners[$eventClass] as $listener) {
            $listener->handle($event);
        }
    }
}

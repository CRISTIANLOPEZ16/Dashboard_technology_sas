<?php
namespace App\Domain\Event;

interface EventListenerInterface
{
    public function handle(object $event): void;
}

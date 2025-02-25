<?php


namespace App\Application\Listener;

use App\Domain\Event\EventListenerInterface;
use App\Domain\Event\UserRegisteredEvent;

class SendWelcomeEmailListener implements EventListenerInterface
{
    public function handle(object $event): void
    {
        if (!$event instanceof UserRegisteredEvent) {
            return;
        }

        $user = $event->getUser();
        echo "📧 Enviando email de bienvenida a: " . $user->getEmail()->getValue() . "\n";
    }
}

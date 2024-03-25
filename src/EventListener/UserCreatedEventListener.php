<?php

// src/EventListener/UserCreatedEventListener.php
namespace App\EventListener;

use App\Event\UserCreatedEvent;
use Symfony\Component\Messenger\MessageBusInterface;

class UserCreatedEventListener
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
		$this->trace("__construct(MessageBusInterface \$messageBus)")	;
		$this->trace($messageBus)	;
		
        $this->messageBus = $messageBus;
    }

    public function __invoke(UserCreatedEvent $event)
    {
		$this->trace("// src/EventListener/UserCreatedEventListener.php")	;
		$this->trace("function __invoke(UserCreatedEvent \$event)")	;
		
        // Here you can send the event through a message broker
		$this->trace('UserCreatedEvent')	;
		$this->trace($event)	;
        $this->messageBus->dispatch($event);
    }
		
	function trace($var){
		
		$message = '|' .var_export($var, true).'|' . "\n";
		
		file_put_contents("/home/miro/www/nextbasket/src/symfony/demo/src/Controller/logs/trace.log", $message, FILE_APPEND);
	}
}
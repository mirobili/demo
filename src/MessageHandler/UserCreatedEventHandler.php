<?php

namespace App\MessageHandler;

use App\Event\UserCreatedEvent;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Handler\AsMessageHandler;

use App\Message\UserCreatedMessage;
use App\Message\ArrayMessage;

#[AsMessageHandler]
class UserCreatedEventHandler
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(UserCreatedEvent $event)
    {
        // Logic to handle the UserCreatedEvent
        // For example, you can perform database operations, send emails, etc.
		
		$this->trace("UserCreatedEventHandler.php");
		$this->trace("UserCreatedEventHandler.php __invoke(UserCreatedEvent \$event");
		$this->trace($event->getUserData());



	//dd($event->getUserData());

        // Create and dispatch a message for RabbitMQ

//		$messageToRabbitMQ = new UserCreatedMessage($event->getUserData());
		
		// $jsonPayload= json_encode($event->getUserData());
		// $messageToRabbitMQ = new Envelope($jsonPayload);
		
		$messageToRabbitMQ = new UserCreatedMessage($event->getUserData());
        $this->messageBus->dispatch($messageToRabbitMQ);
		
		
        // $this->messageBus->dispatch($event->getUserData());
        
		// $arrayData = [
			// 'email' => 'example@example.com',
			// 'firstName' => 'John',
			// 'lastName' => 'Doe'
		// ];
		
		// $this->messageBus->dispatch($arrayData);
    }
	
    public function trace($var)
    {
        $message = '|' . var_export($var, true) . '|' . "\n\n";
        file_put_contents("/home/miro/www/nextbasket/src/symfony/demo/src/Controller/logs/trace.log", $message, FILE_APPEND);
    }
}
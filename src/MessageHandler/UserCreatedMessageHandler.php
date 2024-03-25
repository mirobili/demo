<?php


// src/MessageHandler/UserCreatedMessageHandler.php

namespace App\MessageHandler;

use App\Message\UserCreatedMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Psr\Log\LoggerInterface;
// use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

use Symfony\Component\Messenger\Handler\AsMessageHandler;


use App\Message\ArrayMessage;


#[AsMessageHandler]
class UserCreatedMessageHandler 
{
    private $logger;

    public function __construct(MessageBusInterface $messageBus, LoggerInterface $logger)
    {
		$this->messageBus = $messageBus;
        $this->logger = $logger;
    }

    public function __invoke(UserCreatedMessage $message)
    {
        // Log the sent data
        $this->logger->info('User created event data:', $message->getData());
        $this->logger->info('22222222222222222222222222222222');
		
		// function trace($var){

			// $message = '|' .var_export($var, true).'|' . "\n\n";
			// file_put_contents("/home/miro/www/nextbasket/src/symfony/demo/src/Controller/logs/trace.log", $message, FILE_APPEND);
		// }
		
		
		// trace('1111111111111111111111111111111111111111');
		// trace('User created event data:'. $message->getData());
		
		
    }
}
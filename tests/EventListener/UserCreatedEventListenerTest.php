<?php
// tests/EventListener/UserCreatedEventListenerTest.php

namespace App\Tests\EventListener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Event\UserCreatedEvent;

class UserCreatedEventListenerTest extends WebTestCase
{
    public function testUserCreatedEventIsHandled()
    {
        // Create a test client
        $client = static::createClient();

        // Dispatch the UserCreatedEvent
        $container = $client->getContainer();
        $dispatcher = $container->get('event_dispatcher');
        $event = new UserCreatedEvent(array (
		  'email' => 'example@example.com',
		  'firstName' => 'John',
		  'lastName' => 'Doe',
		));
        $dispatcher->dispatch($event);

        // Assert that the event listener was invoked
        $logger = $container->get('logger');
        $this->assertStringContainsString('User created', $logger->getLogs()[0]['message']);
    }
}
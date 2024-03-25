<?php 

// src/Event/UserCreatedEvent.php
namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class UserCreatedEvent extends Event
{
    private $userData;

    public function __construct(array $userData)
    {
        $this->userData = $userData;
    }

    public function getUserData(): array
    {
        return $this->userData;
    }
}
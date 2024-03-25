<?php
namespace App\Message;

class UserCreatedMessage
{
    // private $userData;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
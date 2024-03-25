<?php
// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Event\UserCreatedEvent;

class UserController extends AbstractController
{
    /**
     * @Route("/users", methods={"POST"})
     */
    public function createUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        // Store the submitted data (e.g., in a database)
        // Example: You can use Doctrine to persist the data to a database

        // Dispatch an event after saving the data
        $userCreatedEvent = new UserCreatedEvent($data);
        $this->dispatchMessage($userCreatedEvent);

        return new JsonResponse(['message' => 'User created'], Response::HTTP_CREATED);
    }
}
<?php

// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", methods={"POST"})
     */
    public function createUser(Request $request, MessageBusInterface $messageBus): Response
    {
        $data = json_decode($request->getContent(), true);

        // Validate the incoming data (You may want to use Symfony's validator component)
        $errors = $this->validateUserData($data);
        if ($errors) {
            return new Response(json_encode(['errors' => $errors]), Response::HTTP_BAD_REQUEST);
        }

        // Create a new User entity
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);

        // Save the user to database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Publish an event to RabbitMQ
        $messageBus->dispatch(new UserCreatedEvent($user->getId()));

        return new Response('User created successfully', Response::HTTP_CREATED);
    }

    // You may implement validation logic here or use Symfony's Validator component
    private function validateUserData(array $data): array
    {
        $errors = [];

        // Example validation
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address';
        }
        // Other validations for firstName and lastName can be added here

        return $errors;
    }
}
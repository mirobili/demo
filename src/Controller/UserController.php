<?php
// src/Controller/UserController.php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

use App\Event\UserCreatedEvent;

/**
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_list", methods={"GET"})
     */
    public function index(): Response
    {
        // Logic to fetch and return a list of users
		
		
		$data='[{
			  "id": 1,
			  "first_name": "Reynold",
			  "last_name": "O\' Flaherty",
			  "email": "roflaherty0@cnn.com",
			  "gender": "Male",
			  "ip_address": "90.66.201.63"
			}, {
			  "id": 2,
			  "first_name": "Gabriel",
			  "last_name": "Campany",
			  "email": "gcampany1@latimes.com",
			  "gender": "Female",
			  "ip_address": "140.165.57.192"
			}, {
			  "id": 3,
			  "first_name": "Siusan",
			  "last_name": "Rosenfarb",
			  "email": "srosenfarb2@xrea.com",
			  "gender": "Female",
			  "ip_address": "217.160.58.216"
			}]';
		$this->trace($data);
		
		return new JsonResponse(json_decode($data), Response::HTTP_OK);
		//return new JsonResponse(['message' => 'User created'], Response::HTTP_OK);
			
	}
		
    /**
     * @Route("/", name="user_create", methods={"POST"})
     */
   
	public function create(Request $request, EventDispatcherInterface $eventDispatcher): Response
    { // public function create(Request $request): Response
        // Logic to create a new user
	
		//	return json_encode(['status'=>'Success']);
	 
	 
		$data = json_decode($request->getContent(), true);

				// // Store the submitted data (e.g., in a database)
				// // Example: You can use Doctrine to persist the data to a database

				// // Dispatch an event after saving the data
				
				
				
				 // public function someAction(MessageBusInterface $messageBus): Response
    // {
        // // Dispatch a message
        // $message = new SomeMessage('Hello, AMQP!');
        // $messageBus->dispatch($message);

        // return new JsonResponse(['message' => 'Message dispatched']);
    // }
				

				
        $userCreatedEvent = new UserCreatedEvent($data);
        //$this->dispatchMessage($userCreatedEvent);
		// $eventDispatcher->dispatch('user.created',$userCreatedEvent);
		$eventDispatcher->dispatch($userCreatedEvent, 'user.created');
		
		
		//$eventDispatcher->dispatch('user.created', $userCreatedEvent);
		
		$this->trace($data);
		$this->trace($userCreatedEvent);
		
		

        return new JsonResponse(['message' => 'User created'], Response::HTTP_CREATED);
	}

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        // Logic to fetch and return a specific user by ID
    }

    /**
     * @Route("/{id}", name="user_update", methods={"PUT"})
     */
    public function update(Request $request, int $id): Response
    {
        // Logic to update an existing user
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        // Logic to delete a user by ID
    }
	
	
	public function someAction(MessageBusInterface $messageBus): Response
    {
        // Dispatch a message
        $message = new SomeMessage('Hello, AMQP!');
        $messageBus->dispatch($message);

        return new JsonResponse(['message' => 'Message dispatched']);
    }
	
	
	
	function trace($var){
	
		$message = '|' .var_export($var, true).'|' . "\n\n";
		file_put_contents("/home/miro/www/nextbasket/src/symfony/demo/src/Controller/logs/trace.log", $message, FILE_APPEND);
	}
}
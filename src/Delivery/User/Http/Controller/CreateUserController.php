<?php

declare(strict_types=1);

namespace App\Delivery\User\Http\Controller;

use App\Application\User\Command\CreateUser\CreateUserCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserController extends AbstractController
{
    #[Route('user/create', name: 'create-user', methods: ['POST'])]
    public function createUser(Request $request, MessageBusInterface $messageBus): Response
    {
        $data = json_decode($request->getContent(), true);
        $messageBus->dispatch(new CreateUserCommand($data['firstName'], $data['lastName'], $data['email']));

        return new Response(null, 200);
    }
}
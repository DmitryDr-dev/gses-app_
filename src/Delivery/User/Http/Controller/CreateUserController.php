<?php

declare(strict_types=1);

namespace App\Delivery\User\Http\Controller;

use App\Application\User\Command\CreateUser\CreateUserCommand;
use App\Delivery\User\Http\Controller\Dto\CreateUserRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserController extends AbstractController
{
    public function __construct(private MessageBusInterface $messageBus, private ValidatorInterface $validator)
    {
    }


    #[Route('user', name: 'create-user', methods: ['POST'])]
    public function createUser(Request $request): Response
    {
        $data = $request->toArray();
        $dto = new CreateUserRequestDto($data['firstName'], $data['lastName'], $data['email']);
        $errors = $this->validator->validate($dto);
        if(count($errors) > 0) {
            throw new BadRequestHttpException((string) $errors);
        }
        $this->messageBus->dispatch(new CreateUserCommand($data['firstName'], $data['lastName'], $data['email']));

        return new Response(null, 200);
    }
}
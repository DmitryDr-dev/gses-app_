<?php

declare(strict_types=1);

namespace App\Application\User\Command\CreateUser;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\User;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateUserHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $newUser = User::create($command->getFirstName(), $command->getLastName(), $command->getEmail());
        $this->repository->save($newUser, true);
    }
}
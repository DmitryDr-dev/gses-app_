<?php

namespace App\Delivery\User\Http\Controller\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $firstName;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $lastName;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Email]
    private $email;

    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}
<?php

declare(strict_types=1);

namespace App\Delivery\ExchangeRate\Http\Controller;

use App\Application\ExchangeRate\Query\GetExchangeRate\GetExchangeRateQuery;
use App\Delivery\ExchangeRate\Http\Controller\Dto\GetExchangeRateRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetExchangeRateController extends AbstractController
{
    use HandleTrait;

    public function __construct(private MessageBusInterface $messageBus, private SerializerInterface $serializer, private ValidatorInterface $validator)
    {
    }

    #[Route('/rate', name: 'get-rate', methods: ['POST'])]
    public function getExchangeRate(Request $request): Response
    {
        $data = $request->toArray();
        $dto = new GetExchangeRateRequestDto(sourceCurrency: $data['sourceCurrency'], targetCurrency: $data['targetCurrency'], sourceAmount: $data['sourceAmount']);
        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            throw new BadRequestHttpException((string)$errors);
        }
        $rate = $this->handle(new GetExchangeRateQuery($data['sourceCurrency'], $data['targetCurrency'], floatval($data['sourceAmount'])));

        return new Response($this->serializer->serialize($rate, 'json'), Response::HTTP_OK, ['Content-type' => 'application/json']);
    }
}
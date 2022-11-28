<?php

declare(strict_types=1);

namespace App\Delivery\ExchangeRate\Http\Controller;

use App\Application\ExchangeRate\Query\GetExchangeRate\GetExchangeRateQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetExchangeRateController extends AbstractController
{
    use HandleTrait;

    public function __construct(private MessageBusInterface $messageBus, private SerializerInterface $serializer)
    {
    }

    #[Route('/rate', name: 'get-rate', methods: ['POST'])]
    public function getExchangeRate(Request $request): Response
    {
        $request = json_decode($request->getContent(), true);
        $rate = $this->handle(new GetExchangeRateQuery($request['sourceCurrency'], $request['targetCurrency'], $request['sourceAmount']));

        return new Response($this->serializer->serialize($rate, 'json'), Response::HTTP_OK, ['Content-type' => 'application/json']);
    }
}
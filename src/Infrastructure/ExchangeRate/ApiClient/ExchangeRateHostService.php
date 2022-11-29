<?php

declare(strict_types=1);

namespace App\Infrastructure\ExchangeRate\ApiClient;

use App\Application\ExchangeRate\Service\ApiClient\Exception\RequestFailedException;
use App\Application\ExchangeRate\Service\ApiClient\ExchangeRateServiceInterface;
use App\Application\ExchangeRate\Service\ApiClient\Request\ExchangeRateServiceRequest;
use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateServiceResponse;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExchangeRateHostService implements ExchangeRateServiceInterface
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function getExchangeRate(ExchangeRateServiceRequest $request): ExchangeRateServiceResponse
    {
        try {
            $response = $this->client->request('GET', "https://api.exchangerate.host/convert?from={$request->getSourceCurrency()}&to={$request->getTargetCurrency()}&amount={$request->getSourceAmount()}");
            $data = json_decode($response->getContent(), true);

            return ExchangeRateServiceResponse::create($data['query']['from'], $data['query']['to'], $data['query']['amount'], $data['result']);
        } catch (HttpExceptionInterface $exception) {
            throw RequestFailedException::create($exception->getResponse()->getContent(false));
        }
    }
}
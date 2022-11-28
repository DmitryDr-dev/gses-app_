<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Query\GetExchangeRate;

use App\Application\ExchangeRate\Service\ApiClient\ExchangeRateServiceInterface;
use App\Application\ExchangeRate\Service\ApiClient\Request\ExchangeRateServiceRequest;
use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateServiceResponse;
use App\Infrastructure\ExchangeApi\ApiClient\ExchangeRateHostService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetExchangeRateHandler
{
    public function __construct(private ExchangeRateServiceInterface $apiClient)
    {
    }

    public function __invoke(GetExchangeRateQuery $query): ExchangeRateServiceResponse
    {
        return $this->apiClient->getExchangeRate(ExchangeRateServiceRequest::create($query->getSourceCurrency(), $query->getTargetCurrency(), $query->getSourceAmount()));
    }
}
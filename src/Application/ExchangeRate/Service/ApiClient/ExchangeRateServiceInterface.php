<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Service\ApiClient;

use App\Application\ExchangeRate\Service\ApiClient\Request\ExchangeRateServiceRequest;
use App\Application\ExchangeRate\Service\ApiClient\Response\ExchangeRateServiceResponse;

interface ExchangeRateServiceInterface
{
    public function getExchangeRate(ExchangeRateServiceRequest $request): ExchangeRateServiceResponse;
}
<?php

declare(strict_types=1);

namespace App\Application\ExchangeRate\Service\ApiClient\Request;

class ExchangeRateServiceRequest
{
    public static function create(string $sourceCurrency, string $targetCurrency, float $sourceAmount): self
    {
        return new self($sourceCurrency, $targetCurrency, $sourceAmount);
    }

    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    public function getSourceAmount(): float
    {
        return $this->sourceAmount;
    }

    private function __construct(private string $sourceCurrency, private string $targetCurrency, private float $sourceAmount)
    {
    }
}
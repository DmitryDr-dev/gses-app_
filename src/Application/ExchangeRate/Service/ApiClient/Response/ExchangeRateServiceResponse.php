<?php

namespace App\Application\ExchangeRate\Service\ApiClient\Response;

class ExchangeRateServiceResponse
{
    public static function create(string $sourceCurrency, string $targetCurrency, float $sourceAmount, float $targetAmount): self
    {
        return new self($sourceCurrency, $targetCurrency, $sourceAmount, $targetAmount);
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

    public function getTargetAmount(): float
    {
        return $this->targetAmount;
    }

    private function __construct(private string $sourceCurrency, private string $targetCurrency, private float $sourceAmount, private float $targetAmount)
    {
    }
}
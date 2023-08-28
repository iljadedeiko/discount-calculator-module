<?php

declare(strict_types=1);

class ShippingProvider
{
    private string $name;

    private array $packagePrices;

    private float $discount;

    public function __construct(string $name, array $packagePrices, float $discount)
    {
        $this->name = $name;
        $this->packagePrices = $packagePrices;
        $this->discount = $discount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPackagePrices(): array
    {
        return $this->packagePrices;
    }

    public function setPackagePrices(array $packagePrices): self
    {
        $this->packagePrices = $packagePrices;

        return $this;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }
}
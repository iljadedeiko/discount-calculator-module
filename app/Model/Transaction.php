<?php

declare(strict_types=1);

namespace App\Model;

require __DIR__ . '/../../vendor/autoload.php';

class Transaction
{
    private string $date;

    private string $packageSize;

    private string $provider;

    private float $price = 0;

    private float $discount = 0;

    public function __construct(string $date, string $packageSize, string $provider)
    {
        $this->date = $date;
        $this->packageSize = $packageSize;
        $this->provider  = $provider;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getPackageSize(): string
    {
        return $this->packageSize;
    }

    public function setPackageSize(string $packageSize): self
    {
        $this->packageSize = $packageSize;

        return $this;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

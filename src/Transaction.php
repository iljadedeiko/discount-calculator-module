<?php

declare(strict_types=1);

class Transaction
{
    private string $date;

    private string $packageSize;

    private string $carrier;

    public function __construct(string $date, string $packageSize, string $carrier)
    {
        $this->date = $date;
        $this->packageSize = $packageSize;
        $this->carrier  = $carrier;
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

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function setCarrier(string $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }
}
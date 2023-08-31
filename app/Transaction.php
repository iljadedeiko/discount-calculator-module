<?php

declare(strict_types=1);

namespace App;

use DateTime;

require __DIR__ . '/../vendor/autoload.php';

class Transaction
{
    private DateTime $date;

    private string $packageSize;

    private string $provider;

    public function __construct(DateTime $date, string $packageSize, string $provider)
    {
        $this->date = $date;
        $this->packageSize = $packageSize;
        $this->provider  = $provider;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
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
}

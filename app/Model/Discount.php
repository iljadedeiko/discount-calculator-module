<?php

declare(strict_types=1);

namespace App\Model;

require __DIR__ . '/../../vendor/autoload.php';

use App\Constant\Discounts;

class Discount
{
    private float $accumulatedDiscount = 0;

    private array $appliedDiscountCounts;

    private string $currentMonth = '';

    private string $discountAppliedMonth = '';

    private string $discountLimitExceededMonth = '';

    public function __construct()
    {
        $this->appliedDiscountCounts = [
            Discounts::LP_L_DISCOUNT => 1
        ];
    }

    public function getAccumulatedDiscount(): float
    {
        return $this->accumulatedDiscount;
    }

    public function setAccumulatedDiscount(float $accumulatedDiscount): self
    {
        $this->accumulatedDiscount = $accumulatedDiscount;

        return $this;
    }

    public function getAppliedDiscountCount(string $discountKey): int|array
    {
        return $this->appliedDiscountCounts[$discountKey] ?? [];
    }

    public function setAppliedDiscountCount(string $discountKey, int $discountValue): self
    {
        $this->appliedDiscountCounts[$discountKey] = $discountValue;

        return $this;
    }

    public function getCurrentMonth(): string
    {
        return $this->currentMonth;
    }

    public function setCurrentMonth(string $currentMonth): self
    {
        $this->currentMonth = $currentMonth;

        return $this;
    }

    public function getDiscountAppliedMonth(): string
    {
        return $this->discountAppliedMonth;
    }

    public function setDiscountAppliedMonth(string $discountAppliedMonth): self
    {
        $this->discountAppliedMonth = $discountAppliedMonth;

        return $this;
    }

    public function getDiscountLimitExceededMonth(): string
    {
        return $this->discountLimitExceededMonth;
    }

    public function setDiscountLimitExceededMonth(string $discountLimitExceededMonth): self
    {
        $this->discountLimitExceededMonth = $discountLimitExceededMonth;

        return $this;
    }
}
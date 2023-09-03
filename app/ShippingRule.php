<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\Constant\Dates;
use App\Constant\Discounts;
use App\Constant\PackageSizes;
use App\Constant\Providers;

class ShippingRule
{
    private float $accumulatedDiscount = 0;

    private array $discountsApplied = [
        Discounts::LP_L_DISCOUNT => 1
    ];

    private string $currentMonth = '';

    private string $discountAppliedMonth = '';

    private string $discountLimitExceededMonth = '';

    public function applyRules(Transaction $transaction): array
    {
        $packageSize = $transaction->getPackageSize();
        $provider = $transaction->getProvider();
        $date = $transaction->getDate();

        $this->currentMonth = date(Dates::CALENDAR_MONTH_FORMAT, strtotime($date));

        $price = Storage::getShippingPricesByProvider()[$provider][$packageSize];
        $discount = 0;

        if ($packageSize === PackageSizes::S) {
            $initialPrice = $price;
            $price = $this->getLowestPackagePrice(PackageSizes::S);

            $discount = $initialPrice - $price;
        }

        if ($packageSize === PackageSizes::L && $provider === Providers::LP) {
            $freeDeliveryAvailable = $this->checkFreeDeliveryAvailability();

            if ($freeDeliveryAvailable) {
                $discount = $price;
                $price = 0;

                $this->discountsApplied[Discounts::LP_L_DISCOUNT] = 1;
                $this->discountAppliedMonth = $this->currentMonth;
            }
        }

        $recalculatedPriceAndDiscount = $this->recalculatePriceAndDiscountByLimit($price, $discount);
        [$finalPrice, $discount] = $recalculatedPriceAndDiscount;

        $this->accumulatedDiscount += $discount;

        return ['price' => $finalPrice, 'discount' => $discount];
    }

    private function getLowestPackagePrice(string $packageSize): float
    {
        $packageSizePrice = [];
        foreach (Storage::getShippingPricesByProvider() as $price) {
            $packageSizePrice[] = $price[$packageSize];
        }

        return min($packageSizePrice);
    }

    private function checkFreeDeliveryAvailability(): bool
    {
        if (
            $this->discountsApplied[Discounts::LP_L_DISCOUNT] === Discounts::LP_L_SIZE_FREE_DELIVERY_RULE
            && $this->currentMonth
            !== $this->discountAppliedMonth
        ) {
            return true;
        }

        $this->discountsApplied[Discounts::LP_L_DISCOUNT]++;

        if ($this->currentMonth === $this->discountAppliedMonth) {
            $this->discountsApplied[Discounts::LP_L_DISCOUNT] = 1;
        }

        return false;
    }

    private function recalculatePriceAndDiscountByLimit(float $price, float $currentDiscount): array
    {
        if (
            $this->currentMonth !== $this->discountLimitExceededMonth
            && $this->accumulatedDiscount >= Discounts::MONTHLY_DISCOUNT_LIMIT
        ) {
            $this->accumulatedDiscount = 0;
        }

        $discount = $this->accumulatedDiscount + $currentDiscount;

        if ($discount > Discounts::MONTHLY_DISCOUNT_LIMIT) {
            $this->discountLimitExceededMonth = $this->currentMonth;

            $accumulatedDiscountAndLimitDifference = Discounts::MONTHLY_DISCOUNT_LIMIT - $this->accumulatedDiscount;

            if ($accumulatedDiscountAndLimitDifference > $currentDiscount) {
                $currentDiscount = 0;

                return [$price, $currentDiscount];
            }

            $currentDiscount = $accumulatedDiscountAndLimitDifference;
            $updatedDiscountAndLimitDifference = $discount - Discounts::MONTHLY_DISCOUNT_LIMIT;

            $price += $updatedDiscountAndLimitDifference;
        }

        return [$price, $currentDiscount];
    }
}

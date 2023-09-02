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
    private float $discountedPrice = 0;

    private array $discountsApplied = [
        Discounts::LP_L_DISCOUNT => 1
    ];

    private string $currentMonth = '';

    private string $discountAppliedMonth = '';

    public function applyRules(Transaction $transaction): array
    {
        $packageSize = $transaction->getPackageSize();
        $provider = $transaction->getProvider();
        $date = $transaction->getDate();

        $this->currentMonth = date(Dates::CALENDAR_MONTH_FORMAT, strtotime($date));

        $finalPrice = Storage::getShippingPricesByProvider()[$provider][$packageSize];
        $discount = 0;

        if ($packageSize === PackageSizes::S) {
            $initialPrice = $finalPrice;
            $finalPrice = $this->getLowestPackagePrice(PackageSizes::S);

            $discount = $initialPrice - $finalPrice;
        }

        if ($packageSize === PackageSizes::L && $provider === Providers::LP) {
            $freeDeliveryAvailable = $this->checkFreeDeliveryAvailability();

            if ($freeDeliveryAvailable) {
                $discount = $finalPrice;
                $finalPrice = 0;

                $this->discountsApplied[Discounts::LP_L_DISCOUNT] = 1;
                $this->discountAppliedMonth = $this->currentMonth;
            }
        }

        if ($discount === 0) {
            $discount = Discounts::NO_DISCOUNT_SYMBOL;
        }

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
}

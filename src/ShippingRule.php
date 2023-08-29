<?php

declare(strict_types=1);

use Constant\Discounts;
use Constant\PackageSizes;
use Constant\Providers;

class ShippingRule
{
    private float $thirdLDiscountForLp;

    private int $maxDiscountPerMonth = Discounts::MAX_DISCOUNT_PER_MONTH;

    private float $discountAccumulated = 0;

    private float $discountApplied = 0;

    public function applyRules(Transaction $transaction, string $shippingProvider): array
    {
        $packageSize = $transaction->getPackageSize();
        $discount = 0;

        $packagePrices = Providers::getPackagePricesByProviderAndSize();

        $price = match ($shippingProvider) {
            Providers::LP => $packagePrices[Providers::LP][$packageSize],
            Providers::MR => $packagePrices[Providers::MR][$packageSize],
            default => ['price' => 0, 'discount' => 0]
        };

//        if ($packageSize === PackageSizes::L && $shippingProvider === Providers::LP) {
//            $discount = $this->applyThirdDiscount();
//        }

        return [];
    }

//    private function applyThirdDiscount()
//    {
//        if ($this->discountApplied < )
//    }
}
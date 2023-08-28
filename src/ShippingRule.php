<?php

declare(strict_types=1);

use Enum\DiscountsEnum;
use Enum\PackageSizesEnum;
use Enum\ProvidersEnum;

class ShippingRule
{
    private float $thirdLDiscountForLp;

    private int $maxDiscountPerMonth = DiscountsEnum::MAX_DISCOUNT_PER_MONTH->value;

    private float $discountAccumulated = 0;

    private float $discountApplied = 0;

    public function applyRules(Transaction $transaction, string $shippingProvider): array
    {
        $packageSize = $transaction->getPackageSize();
        $discount = 0;

        $packagePrices = ProvidersEnum::getPackagePricesByProviderAndSize();

        $price = match ($shippingProvider) {
            ProvidersEnum::LP->value => $packagePrices[ProvidersEnum::LP->value][$packageSize],
            ProvidersEnum::MR->value => $packagePrices[ProvidersEnum::MR->value][$packageSize],
            default => ['price' => 0, 'discount' => 0]
        };

        if ($packageSize === PackageSizesEnum::L->value && $shippingProvider === ProvidersEnum::LP->value) {
            $discount = $this->applyThirdDiscount();
        }

        return [];
    }

    private function applyThirdDiscount()
    {

    }
}
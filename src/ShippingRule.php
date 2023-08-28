<?php

declare(strict_types=1);

use Enum\DiscountsEnum;

class ShippingRule
{
    private float $thirdLDiscountForLp;

    private int $maxDiscountPerMonth = DiscountsEnum::MAX_DISCOUNT_PER_MONTH->value;

    private float $discountAccumulated = 0;

    private float $discountApplied = 0;

    public function applyRules(Transaction $transaction, ShippingProvider $shippingProvider): array
    {
        $packageSize = $transaction->getPackageSize();
        $
    }
}
<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\Constant\Discounts;
use App\Constant\Providers;

class ShippingRule
{
    private float $thirdLDiscountForLp;

    private int $maxDiscountPerMonth = Discounts::MAX_DISCOUNT_PER_MONTH;

    private float $discountAccumulator = 0;

    private float $appliedDiscounts = 0;

    public function applyRules(Transaction $transaction): array
    {
        $reducedPrice = $this->getReducedPrice($transaction);
        $discount = $this->calculateDiscount($transaction->getProvider(), $transaction->getPackageSize(), $reducedPrice);

        $this->updateDiscountAccumulator($discount);

        $packageSize = $transaction->getPackageSize();
        $discount = 0;

        return ['price' => $lowestPrice, ]
    }
}
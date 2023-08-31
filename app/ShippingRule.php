<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\Constant\Discounts;
use App\Constant\Providers;
use DateTime;

class ShippingRule
{
    private float $discountedPrice = 0;

    private float $discountsApplied = 0;

    private DateTime $currentMonth;

    private DateTime $discountAppliedMonth;

    public function applyRules(Transaction $transaction): array
    {
        $packageSize = $transaction->getPackageSize();
        $provider = $transaction->getProvider();

        $shippingPrices = Storage::getShippingPrices();
        $price = $shippingPrices[$provider][$packageSize];
        $discount = 0;

//        $this->updateDiscountAccumulator($discount);

        return ['price' => $price, 'discount' => $discount];
    }
}
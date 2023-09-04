<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\Constant\Dates;
use App\DiscountRule\LowestSPriceRule;
use App\DiscountRule\MonthlyLimitRule;
use App\DiscountRule\ThirdShipmentFreeRule;
use App\Model\Discount;
use App\Model\Transaction;

class ShippingRule
{
    public function applyRules(Transaction $transaction, Discount $discount): array
    {
        // manager collects all the rules applied to the transaction and applies them
        $manager = new DiscountManager();

        $packageSize = $transaction->getPackageSize();
        $provider = $transaction->getProvider();
        $date = $transaction->getDate();

        $discount->setCurrentMonth(date(Dates::CALENDAR_MONTH_FORMAT, strtotime($date)));

        $price = Storage::getShippingPricesByProvider()[$provider][$packageSize];
        $transaction->setPrice($price);

        // add all discount rules to the manager
        $manager->addRule(new LowestSPriceRule());
        $manager->addRule(new ThirdShipmentFreeRule());
        $manager->addRule(new MonthlyLimitRule());

        $manager->applyRules($transaction, $discount);

        $discount->setAccumulatedDiscount(
            $discount->getAccumulatedDiscount() + $transaction->getDiscount()
        );

        return ['price' => $transaction->getPrice(), 'discount' => $transaction->getDiscount()];
    }
}

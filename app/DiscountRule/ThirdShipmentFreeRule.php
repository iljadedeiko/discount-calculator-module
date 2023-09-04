<?php

declare(strict_types=1);

namespace App\DiscountRule;

require __DIR__ . '/../../vendor/autoload.php';

use App\Constant\Discounts;
use App\Constant\PackageSizes;
use App\Constant\Providers;
use App\Model\Discount;
use App\Model\Transaction;

class ThirdShipmentFreeRule implements DiscountRuleInterface
{
    public function applyRule(Transaction $transaction, Discount $discount): void
    {
        if (
            $transaction->getPackageSize() === PackageSizes::L
            && $transaction->getProvider() === Providers::LP
        ) {
            $freeDeliveryAvailable = $this->checkFreeDeliveryAvailability($discount);

            if ($freeDeliveryAvailable) {
                $transaction->setDiscount($transaction->getPrice());
                $transaction->setPrice(0);

                $discount->setAppliedDiscountCount(Discounts::LP_L_DISCOUNT, 1);
                $discount->setDiscountAppliedMonth($discount->getCurrentMonth());
            }
        }
    }

    private function checkFreeDeliveryAvailability(Discount $discount): bool
    {
        $LPLDiscountCount = $discount->getAppliedDiscountCount(Discounts::LP_L_DISCOUNT);

        // check if this L_LP shipment is the 3-rd among transactions and the first time in a particular month
        if (
            $LPLDiscountCount === Discounts::LP_L_SIZE_FREE_DELIVERY_RULE
            && $discount->getCurrentMonth() !== $discount->getDiscountAppliedMonth()
        ) {
            return true;
        }

        $discount->setAppliedDiscountCount(Discounts::LP_L_DISCOUNT, $LPLDiscountCount + 1);

        // check if it is necessary to reset applied discount count for LP_L discount
        if ($discount->getCurrentMonth() === $discount->getDiscountAppliedMonth()) {
            $discount->setAppliedDiscountCount(Discounts::LP_L_DISCOUNT, 1);
        }

        return false;
    }
}
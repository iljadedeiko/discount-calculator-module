<?php

declare(strict_types=1);

namespace App\DiscountRule;

require __DIR__ . '/../../vendor/autoload.php';

use App\Constant\Discounts;
use App\Discount;
use App\Transaction;

class MonthlyLimitRule implements DiscountRuleInterface
{
    public function applyRule(Transaction $transaction, Discount $discount): void
    {
        // check whether the accumulated discount should be reset
        if (
            $discount->getCurrentMonth() !== $discount->getDiscountLimitExceededMonth()
            && $discount->getAccumulatedDiscount() >= Discounts::MONTHLY_DISCOUNT_LIMIT
        ) {
            $discount->setAccumulatedDiscount(0);
        }

        $updatedAccumulatedDiscount = $discount->getAccumulatedDiscount() + $transaction->getDiscount();

        // if the limit is not exceeded, early return from method
        if ($updatedAccumulatedDiscount < Discounts::MONTHLY_DISCOUNT_LIMIT) {
            return;
        }

        $discount->setDiscountLimitExceededMonth($discount->getCurrentMonth());

        $accumulatedDiscountAndLimitDifference = Discounts::MONTHLY_DISCOUNT_LIMIT - $discount->getAccumulatedDiscount();

        if ($accumulatedDiscountAndLimitDifference > $transaction->getDiscount()) {
            $transaction->setDiscount(0);

            return;
        }

        $transaction->setDiscount($accumulatedDiscountAndLimitDifference);
        $updatedDiscountAndLimitDifference = $updatedAccumulatedDiscount - Discounts::MONTHLY_DISCOUNT_LIMIT;

        $transaction->setPrice($transaction->getPrice() + $updatedDiscountAndLimitDifference);
    }
}
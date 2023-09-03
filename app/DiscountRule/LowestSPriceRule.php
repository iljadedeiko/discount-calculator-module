<?php

declare(strict_types=1);

namespace App\DiscountRule;

require __DIR__ . '/../../vendor/autoload.php';

use App\Constant\PackageSizes;
use App\Discount;
use App\Storage;
use App\Transaction;

class LowestSPriceRule implements DiscountRuleInterface
{
    public function applyRule(Transaction $transaction, Discount $discount): void {
        if ($transaction->getPackageSize() !== PackageSizes::S) {
            return;
        }

        $initialPrice = $transaction->getPrice();
        $transaction->setPrice($this->getLowestPackagePrice(PackageSizes::S));

        $discount = $initialPrice - $transaction->getPrice();
        $transaction->setDiscount($discount);
    }

    private function getLowestPackagePrice(string $packageSize): float
    {
        $packageSizePrice = [];
        foreach (Storage::getShippingPricesByProvider() as $price) {
            $packageSizePrice[] = $price[$packageSize];
        }

        return min($packageSizePrice);
    }
}

<?php

declare(strict_types=1);

namespace App\DiscountRule;

require __DIR__ . '/../../vendor/autoload.php';

use App\Discount;
use App\Transaction;

interface DiscountRuleInterface
{
    // common interface for all rules
    public function applyRule(Transaction $transaction, Discount $discount): void;
}

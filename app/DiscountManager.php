<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\DiscountRule\DiscountRuleInterface;
use App\Model\Discount;
use App\Model\Transaction;

class DiscountManager
{
    private array $rules = [];

    public function getRules(): array
    {
        return $this->rules;
    }

    public function addRule(DiscountRuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }

    public function applyRules(Transaction $transaction, Discount $discount): void
    {
        /** @var DiscountRuleInterface $rule */
        foreach ($this->rules as $rule) {
            $rule->applyRule($transaction, $discount);
        }
    }
}

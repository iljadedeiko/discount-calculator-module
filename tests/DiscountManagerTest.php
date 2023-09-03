<?php

declare(strict_types=1);

namespace Tests;

use App\Discount;
use App\DiscountManager;
use App\DiscountRule\DiscountRuleInterface;
use App\Transaction;
use PHPUnit\Framework\TestCase;

class DiscountManagerTest extends TestCase
{
    public function testAddRule()
    {
        $manager = new DiscountManager();

        $rule = $this->createMock(DiscountRuleInterface::class);

        $manager->addRule($rule);

        $this->assertCount(1, $manager->getRules());
    }

    public function testApplyRules()
    {
        $manager = new DiscountManager();

        $rule = $this->createMock(DiscountRuleInterface::class);

        $transaction = $this->createMock(Transaction::class);
        $discount = $this->createMock(Discount::class);

        $rule->expects($this->once())
            ->method('applyRule')
            ->with($transaction, $discount);

        $manager->addRule($rule);
        $manager->applyRules($transaction, $discount);
    }
}
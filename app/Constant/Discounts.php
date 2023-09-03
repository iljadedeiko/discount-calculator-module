<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class Discounts
{
    public const MONTHLY_DISCOUNT_LIMIT = 10;

    public const LP_L_DISCOUNT = 'LP_L';

    public const LP_L_SIZE_FREE_DELIVERY_RULE = 3;

    public const NO_DISCOUNT_SYMBOL = '-';

    private function __construct()
    {
    }
}

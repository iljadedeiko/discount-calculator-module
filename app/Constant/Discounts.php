<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class Discounts
{
    public const MAX_DISCOUNT_PER_MONTH = 10;

    public const LP_L_DISCOUNT = 'LP_L';

    public const LP_L_SIZE_FREE_DELIVERY_RULE = 3;

    public const LP_L_SIZE_FREE_DELIVERY_COUNT_PER_MONTH = 1;

    public const NO_DISCOUNT_SYMBOL = '-';

    private function __construct()
    {
    }
}

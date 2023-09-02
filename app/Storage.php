<?php

declare(strict_types=1);

namespace App;

use App\Constant\PackageSizes;
use App\Constant\Providers;

class Storage
{
    public static function getShippingPricesByProvider(): array
    {
        return [
            Providers::LP => [
                PackageSizes::S => 1.5,
                PackageSizes::M => 4.9,
                PackageSizes::L => 6.9,
            ],
            Providers::MR => [
                PackageSizes::S => 2.00,
                PackageSizes::M => 3.00,
                PackageSizes::L => 4.00,
            ],
        ];
    }
}
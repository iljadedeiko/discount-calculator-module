<?php

declare(strict_types=1);

namespace App;

use App\Constant\PackageSizes;
use App\Constant\Providers;

class Storage
{
    public static function getShippingPrices(): array
    {
        return [
            Providers::LP => [
                PackageSizes::S => 1.5,
                PackageSizes::M => 4.9,
                PackageSizes::L => 6.9,
            ],
            Providers::MR => [
                PackageSizes::S => 2,
                PackageSizes::M => 3,
                PackageSizes::L => 4,
            ],
        ];
    }
}
<?php

declare(strict_types=1);

namespace Constant;

class Providers
{
    public const MR = 'MR';

    public const LP = 'LP';

    private function __construct()
    {
    }

    public static function getPackagePricesByProviderAndSize(): array
    {
        return [
            self::LP => [
                PackageSizes::S => 1.5,
                PackageSizes::M => 4.9,
                PackageSizes::L => 6.9
            ],
            self::MR => [
                PackageSizes::S => 2,
                PackageSizes::M => 3,
                PackageSizes::L => 4
            ]
        ];
    }
}

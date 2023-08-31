<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class Providers
{
    public const MR = 'MR';

    public const LP = 'LP';

    private function __construct()
    {
    }

    public static function getProviders(): array
    {
        return [self::MR, self::LP];
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

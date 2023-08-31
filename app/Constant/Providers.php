<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class Providers
{
    public const LP = 'LP';

    public const MR = 'MR';

    private function __construct()
    {
    }

    public static function getProviders(): array
    {
        return [self::MR, self::LP];
    }
}

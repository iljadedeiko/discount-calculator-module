<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class Providers
{
    private function __construct()
    {
        // disable initialization
    }

    public const LP = 'LP';

    public const MR = 'MR';

    public static function getProviders(): array
    {
        return [self::MR, self::LP];
    }
}

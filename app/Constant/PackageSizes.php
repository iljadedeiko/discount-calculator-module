<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class PackageSizes
{
    private function __construct()
    {
        // disable initialization
    }

    public const S = 'S';

    public const M = 'M';

    public const L = 'L';

    public static function getPackageSizes(): array
    {
        return [self::S, self::M, self::L];
    }
}

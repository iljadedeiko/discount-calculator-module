<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class PackageSizes
{
    public const S = 'S';

    public const M = 'M';

    public const L = 'L';

    private function __construct()
    {
    }

    public static function getPackageSizes(): array
    {
        return [self::S, self::M, self::L];
    }
}

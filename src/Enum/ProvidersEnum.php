<?php

declare(strict_types=1);

namespace Enum;

enum ProvidersEnum: string
{
    case MR = 'MR';
    case LP = 'LP';

    public static function getPackagePricesByProviderAndSize(): array
    {
        return [
            self::LP->value => [
                'S' => 1.5,
                'M' => 4.9,
                'L' => 6.9
            ],
            self::MR->value => [
                'S' => 2,
                'M' => 3,
                'L' => 4
            ]
        ];
    }
}

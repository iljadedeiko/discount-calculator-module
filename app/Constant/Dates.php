<?php

declare(strict_types=1);

namespace App\Constant;

require __DIR__ . '/../../vendor/autoload.php';

class Dates
{
    private function __construct()
    {
        // disable initialization
    }

    public const INPUT_DATE_FORMAT = 'Y-m-d';

    public const CALENDAR_MONTH_FORMAT = 'Y-m';
}

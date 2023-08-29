<?php

declare(strict_types=1);

use function file;
use function explode;

class InputParser
{
    private const LINE_PART_LIMIT = 3;

    public function parseInputFile($fileName): ?array
    {
        $transactions = [];

        $lines = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            [$date, $packageSize, $carrier] = explode(' ', $line, self::LINE_PART_LIMIT);

            if ($date === null || $packageSize === null || $carrier === null) {
                return null;
            }

            $transactions[] = new Transaction($date, $packageSize, $carrier);
        }

        return $transactions;
    }
}
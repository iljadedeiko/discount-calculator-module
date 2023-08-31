<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

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
            [$date, $packageSize, $provider] = explode(' ', $line, self::LINE_PART_LIMIT);

            $validator = new InputValidator();
            $validatedLine = $validator->validate($date, $packageSize, $provider);

            if ($validatedLine === null) {
                $transactions[] = $line;

                continue;
            }

            $transactions[] = $validatedLine;
        }

        return $transactions;
    }
}

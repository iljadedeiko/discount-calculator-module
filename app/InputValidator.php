<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\Constant\Dates;
use App\Constant\PackageSizes;
use App\Constant\Providers;
use DateTime;

class InputValidator
{
    public function validate(?string $date, ?string $packageSize, ?string $provider): ?Transaction
    {
        if ($date === null || $packageSize === null || $provider === null) {
            return null;
        }

        $validDate = $this->dateIsValid($date);
        if ($validDate === false) {
            return null;
        }

        if (!in_array($packageSize, PackageSizes::getPackageSizes())) {
            return null;
        }

        if (!in_array($provider, Providers::getProviders())) {
            return null;
        }

        return new Transaction($date, $packageSize, $provider);
    }

    private function dateIsValid(string $date): bool
    {
        $dateFromString = DateTime::createFromFormat(Dates::INPUT_DATE_FORMAT, $date);

        if ($dateFromString->format(Dates::INPUT_DATE_FORMAT) !== $date) {
            return false;
        }

        return true;
    }
}

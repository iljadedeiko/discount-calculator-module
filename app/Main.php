<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use function sprintf;
use function number_format;

class Main
{
    private const IGNORED_LINE_INFO = 'Ignored';

    public function run($inputFileName): void
    {
        $inputParser = new InputParser();
        $shippingRule = new ShippingRule();

        $transactions = $inputParser->parseInputFile($inputFileName);

        foreach ($transactions as $transaction) {
            if ($transaction instanceof Transaction === false) {
                echo sprintf("%s %s" . PHP_EOL, $transaction, self::IGNORED_LINE_INFO);

                continue;
            }

            $calculatedPriceAndDiscount = $shippingRule->applyRules($transaction);

            $this->output($transaction, $calculatedPriceAndDiscount);
        }
    }

    private function output(Transaction $transaction, array $calculatedPriceAndDiscount): void
    {
        $price = number_format($calculatedPriceAndDiscount['price'], 2,  '.', '');
        $discount = $calculatedPriceAndDiscount['discount'];

        echo sprintf(
            "%s %s %s %s %s" . PHP_EOL,
            $transaction->getDate(),
            $transaction->getPackageSize(),
            $transaction->getProvider(),
            $price,
            $discount
        );
    }
}

$main = new Main();
$main->run('./../input.txt');
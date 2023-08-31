<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use function sprintf;

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
        echo sprintf(
            "%s %s %s %s %s" . PHP_EOL,
            $transaction->getDate()->format('Y-m-d'),
            $transaction->getPackageSize(),
            $transaction->getProvider(),
            $calculatedPriceAndDiscount['price'],
            $calculatedPriceAndDiscount['discount']
        );
    }
}

$main = new Main();
$main->run('./../input.txt');
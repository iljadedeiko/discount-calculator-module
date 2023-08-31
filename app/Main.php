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
        $shipmentCalculator = new ShipmentCalculator();
        $shippingRule = new ShippingRule();

        $transactions = $inputParser->parseInputFile($inputFileName);

        foreach ($transactions as $transaction) {
            $output = '';

            if ($transaction instanceof Transaction === false) {
                $output = sprintf('%s %s', $transaction, self::IGNORED_LINE_INFO);
            }

            $calculatedPriceAndDiscount = $shippingRule->applyRules($transaction);
        }

//        foreach($transactions as $transaction) {
//            var_dump($transaction);
//        }
    }
}

$main = new Main();
$main->run('./../input.txt');
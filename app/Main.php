<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

class Main
{
    public function run($inputFileName): void
    {
        $inputParser = new InputParser();
        $shipmentCalculator = new ShipmentCalculator();
        $shippingRule = new ShippingRule();

        $transactions = $inputParser->parseInputFile($inputFileName);

//        foreach ($transactions as $transaction) {
//            $calculatedPriceAndDiscount = $shipmentCalculator->

//            echo '';
//        }

        foreach($transactions as $transaction) {
            echo $transaction;
        }
    }
}

$main = new Main();
$main->run('./../input.txt');
<?php

declare(strict_types=1);



class Main
{
    public function run($inputFileName)
    {
        $inputParser = new InputParser();
        $shipmentCalculator = new ShipmentCalculator();
        $shippingRule = new ShippingRule();

        $transactions = $inputParser->parseInputFile($inputFileName);

        foreach ($transactions as $transaction) {
//            $calculatedPriceAndDiscount = $shipmentCalculator->

//            echo '';
        }

        for ($i = 0; $i < 10;  $i++) {
            echo "this is a test line \n";
        }
    }
}

$main = new Main();
$main->run('input.txt');
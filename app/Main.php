<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\Constant\Discounts;

use function number_format;
use function sprintf;

class Main
{
    private const IGNORED_LINE_INFO = 'Ignored';

    public function run($inputFileName): void
    {
        // discount object stores properties that should retain their state throughout all transactions
        $discount = new Discount();
        $shippingRule = new ShippingRule();
        $inputParser = new InputParser();
        // converting file lines into objects, if they are in the correct format, otherwise leave string
        $transactions = $inputParser->parseInputFile($inputFileName);

        foreach ($transactions as $transaction) {
            if ($transaction instanceof Transaction === false) {
                echo sprintf("%s %s" . PHP_EOL, $transaction, self::IGNORED_LINE_INFO);

                continue;
            }

            // apply shipping rules to every transaction
            $calculatedPriceAndDiscount = $shippingRule->applyRules($transaction, $discount);

            $this->output($transaction, $calculatedPriceAndDiscount);
        }
    }

    private function output(Transaction $transaction, array $calculatedPriceAndDiscount): void
    {
        $price = number_format($calculatedPriceAndDiscount['price'], 2,  '.', '');
        $discount = number_format($calculatedPriceAndDiscount['discount'], 2,  '.', '');

        if ($discount == 0) {
            $discount = Discounts::NO_DISCOUNT_SYMBOL;
        }

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

<?php

declare(strict_types=1);

namespace Tests;

use App\Main;
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../vendor/autoload.php';

class MainTest extends TestCase
{
    // test the output for a valid transaction
    public function testValidTransaction()
    {
        $main = new Main();

        // create a temporary file with a valid transaction
        $inputFileName = tempnam(sys_get_temp_dir(), 'test');
        $validTransaction = "2023-08-28 S LP 1.50 0.50\n";
        file_put_contents($inputFileName, $validTransaction);

        // capture the output
        ob_start();
        $main->run($inputFileName);
        $output = ob_get_clean();

        $this->assertStringContainsString("2023-08-28 S LP 1.50 0.50", $output);
    }

    public function testIgnoredLine()
    {
        $main = new Main();

        // create a temporary file with an ignored line
        $inputFileName = tempnam(sys_get_temp_dir(), 'test');
        $ignoredLine = "Invalid\n";
        file_put_contents($inputFileName, $ignoredLine);

        // capture the output
        ob_start();
        $main->run($inputFileName);
        $output = ob_get_clean();

        $this->assertStringContainsString("Invalid", $output);
    }
}
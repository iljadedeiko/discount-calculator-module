<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Main;

$main = new Main();
$main->run('./../input.txt');

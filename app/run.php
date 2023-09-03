<?php

declare(strict_types=1);

// autoload is used to automatically load classes and then use them in any application namespace
require __DIR__ . '/../vendor/autoload.php';

use App\Main;

$main = new Main();
$main->run('./../input.txt');

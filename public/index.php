<?php

spl_autoload_register(function ($class): void {
    $path = __DIR__ . lcfirst(str_replace('\\', '/', $class)) . 'php';

    if (file_exists($path)) {
        require $path;
    }
});

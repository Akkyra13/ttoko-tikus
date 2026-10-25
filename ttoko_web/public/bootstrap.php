<?php

spl_autoload_register(function (string $class) {
    $classPath = str_replace('\\', '/', $class);
    $file = __DIR__ . "/app/Models/" . strtolower($classPath) . ".php";
    if (file_exists($file)) {
        include_once($file);
    }
});

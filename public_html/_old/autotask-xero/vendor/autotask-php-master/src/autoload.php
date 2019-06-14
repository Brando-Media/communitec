<?php

function atws_autoload($class) {
    $namespaceParts = explode('\\', $class);
    $className = array_pop($namespaceParts);

    array_shift($namespaceParts);
    $file_name  = __DIR__ . '/' . implode('/', $namespaceParts) . "/{$className}.php";
    if (file_exists($file_name)) {
      require_once $file_name;
    }
}

spl_autoload_register('atws_autoload');

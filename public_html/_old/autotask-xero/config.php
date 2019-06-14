<?php

define('ROOT_DIR', __DIR__);

require_once ROOT_DIR.'/vendor/SplClassLoader.php';
$SplClassLoader = new SplClassLoader();
$SplClassLoader->setIncludePath(ROOT_DIR);
$SplClassLoader->register();

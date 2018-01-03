<?php

include_once __DIR__.'/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("Macavv\\Routes\\", __DIR__, true);
$classLoader->register();
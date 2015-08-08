<?php

require(__DIR__ . '/../vendor/autoload.php');

hikari\core\Bootstrap::run([
    'path' => __DIR__ . '/../app',
    'publicPath' => __DIR__,
]);

<?php

require(__DIR__ . '/../lib/hikari/autoload.php');

\hikari\bootstrap\Bootstrap::run([
	'path' => __DIR__ . '/../app',
	'publicPath' => __DIR__,
]);

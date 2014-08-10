<?php

require(__DIR__ . '/../lib/hikari/autoload.php');

\hikari\bootstrap\Bootstrap::app([
	'path' => __DIR__ . '/../app',
	'publicPath' => __DIR__,
]);

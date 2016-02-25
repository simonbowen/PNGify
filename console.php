<?php

require "./vendor/autoload.php";

use PNGify\Console\Convert;

$app = new \Symfony\Component\Console\Application();
$app->add(new Convert());
$app->run();
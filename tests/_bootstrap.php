<?php
// This is global bootstrap for autoloading

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/start.php';

$app->boot();

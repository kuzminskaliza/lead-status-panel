<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\controller\AddLeadController;

$config = require __DIR__ . '/src/config/main.php';

$controller = new AddLeadController($config);

$controller->run();

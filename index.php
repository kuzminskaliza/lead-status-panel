<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\controller\AddLeadController;

$controller = new AddLeadController();
$controller->run();

<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use app\database\Database;
use app\request\Scenario;

Database::connect();
(new Scenario())->execute();

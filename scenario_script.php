<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\database\Database;
use app\requests\Scenario;

Database::connect();
(new Scenario())->execute();

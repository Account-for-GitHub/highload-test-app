<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Filesystem\Filesystem;
use app\database\Database;

Database::connect();
$capsule = Database::getCapsule();
    
$repository = new DatabaseMigrationRepository($capsule->getDatabaseManager(), 'migrations');
if (!$repository->repositoryExists()) {
    $repository->createRepository();
}

$migrator = new Migrator($repository, $capsule->getDatabaseManager(), new Filesystem());
$migrator->run(__DIR__ . '/../migrations');

// $migrator->rollback(__DIR__ . '/../migrations');

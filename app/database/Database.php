<?php

namespace app\database;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    protected static ?Capsule $capsuleManager = null;

    protected const CONNECTION_CONFIG = [
        'driver' => 'mysql',
        'host' => 'localhost:3306',
        'database' => 'mysql_database',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ];

    private function __construct()
    {
    }

    public static function connect(): void
    {
        if (is_null(self::$capsuleManager)) {
            $capsule = new Capsule;
            $capsule->addConnection(self::CONNECTION_CONFIG);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            self::$capsuleManager = $capsule;
        }
    }

    /**
     * @throws Exception
     */
    public static function getCapsule(): Capsule
    {
        return self::$capsuleManager
            ?? throw new Exception('Database is not connected. Use Database::connect() method');
    }
}

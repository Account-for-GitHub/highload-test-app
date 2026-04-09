<?php

namespace database;

use app\database\Database;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseTest extends TestCase
{

    public function testGetCapsule()
    {
        Database::connect();
        $capsule = Database::getCapsule();
        $this->assertInstanceOf(Capsule::class, $capsule);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetCapsuleNotConnected()
    {
        $this->expectExceptionMessage('Database is not connected. Use Database::connect() method');
        Database::getCapsule();
    }
}

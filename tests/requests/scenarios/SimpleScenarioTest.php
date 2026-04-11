<?php

namespace requests\scenarios;

use app\config\Config;
use app\dto\ResponseDTO;
use app\request\scenarios\SimpleScenario;
use PHPUnit\Framework\TestCase;

class SimpleScenarioTest extends TestCase
{
    private const TEST_CONFIG_3 = __DIR__ . "/../../assets/templates/test-config-3.json";

    public function testExecute()
    {
        Config::setTestConfig(self::TEST_CONFIG_3);
        $scenario = new SimpleScenario();
        $responseDTO = $scenario->execute();

        $this->assertInstanceOf(ResponseDTO::class, $responseDTO);
        $this->assertEquals(200, $responseDTO->status, 'Local web-server is probably not working!');
        $this->assertIsString($responseDTO->response);
    }
}

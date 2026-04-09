<?php

namespace requests\senders;

use app\config\Config;
use app\dto\ResponseDTO;
use app\requests\senders\HttpSender;
use PHPUnit\Framework\TestCase;

class HttpSenderTest extends TestCase
{
    private const TEST_CONFIG_3 = __DIR__ . "/../../assets/templates/test-config-3.json";
    private const TEST_CONFIG_4 = __DIR__ . "/../../assets/templates/test-config-4.json";

    public function testSend()
    {
        Config::setTestConfig(self::TEST_CONFIG_3);
        $config = Config::getConfig();
        $responseDTO = HttpSender::send($config, "{}");
        $this->assertInstanceOf(ResponseDTO::class, $responseDTO);
        $this->assertEquals(200, $responseDTO->status, 'Local web-server is probably not working!');
        $this->assertIsString($responseDTO->response);

        Config::setTestConfig(self::TEST_CONFIG_4);
        $config = Config::getConfig();
        $result = HttpSender::send($config, "{}");
        $this->assertFalse($result);
    }
}

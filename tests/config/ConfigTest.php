<?php

namespace config;

use app\config\Config;
use app\dto\ConfigDTO;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    private const TEST_CONFIG_1 = __DIR__ . "/../assets/templates/test-config-1.json";
    private const TEST_CONFIG_2 = __DIR__ . "/../assets/templates/test-config-2.json";
    private const TEST_CONFIG_3 = __DIR__ . "/../no-config-file.json";

    public function testGetConfig()
    {
        Config::setTestConfig(self::TEST_CONFIG_1);
        $config = Config::getConfig();
        $this->assertInstanceOf(ConfigDTO::class, $config);
        $this->assertEquals('http://localhost:80', $config->url);
        $this->assertEquals(3, $config->quantity);
        $this->assertJsonStringEqualsJsonString(
            '{"key_1": "value 1", "key_2": "value 2"}',
            $config->request
        );

        Config::setTestConfig(self::TEST_CONFIG_2);
        $config = Config::getConfig();
        $this->assertInstanceOf(ConfigDTO::class, $config);
        $this->assertEquals(Config::DEFAULT_URL, $config->url);
        $this->assertEquals(Config::DEFAULT_QUANTITY_OF_REQUESTS, $config->quantity);
        $this->assertJsonStringEqualsJsonString(Config::DEFAULT_REQUEST, $config->request);

        Config::setTestConfig(self::TEST_CONFIG_3);
        $this->expectExceptionMessage('Config file not found!');
        Config::getConfig();
    }
}

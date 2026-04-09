<?php

namespace app\config;

use app\dto\ConfigDTO;
use Exception;

class Config
{
    public const DEFAULT_URL = 'http://localhost';
    public const DEFAULT_QUANTITY_OF_REQUESTS = 10;
    public const DEFAULT_REQUEST = "{}";

    protected const CONFIG_FILE_PATH = __DIR__ . "/highload-test-config.json";
    protected static string $configFilePath = self::CONFIG_FILE_PATH;

    protected const URL_KEY = "url";
    protected const QUANTITY_KEY = "quantity";
    protected const REQUEST_KEY = "request";

    protected static ?ConfigDTO $config = null;

    protected function __construct()
    {
    }

    public static function setTestConfig(string $testConfigFilePath): void {
        self::$configFilePath = $testConfigFilePath;
        self::$config = null;
    }

    /**
     * @return array<string, string|int|null>
     * @throws Exception
     */
    protected static function getFileConfig(): array
    {
        if (! is_file(self::$configFilePath)) {
            throw new Exception('Config file not found!');
        }

        $json = file_get_contents(self::$configFilePath);

        if ($json === false) {
            return [];
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, string>
     */
    protected static function getOptionsConfig(): array
    {
        return getopt('', ['url::', 'quantity::']);
    }

    public static function getConfig(): ConfigDTO
    {
        if (is_null(self::$config)) {
            $fileConfig = self::getFileConfig();
            $optionsConfig = self::getOptionsConfig();

            $config = array_merge($fileConfig, $optionsConfig);

            $requestJson = isset($config[self::REQUEST_KEY])
                ? json_encode($config[self::REQUEST_KEY], JSON_UNESCAPED_UNICODE)
                : self::DEFAULT_REQUEST;

            self::$config = new ConfigDTO(
                url: $config[self::URL_KEY] ?? self::DEFAULT_URL,
                quantity: $config[self::QUANTITY_KEY] ?? self::DEFAULT_QUANTITY_OF_REQUESTS,
                request: $requestJson,
            );
        }

        return self::$config;
    }
}

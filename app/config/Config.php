<?php

namespace app\config;

use app\dto\ConfigDTO;

class Config
{
    private const DEFAULT_URL = 'http://localhost';
    private const DEFAULT_QUANTITY_OF_REQUESTS = 10;
    private const DEFAULT_REQUEST = "{}";

    private const CONFIG_FILE_PATH = "app/config/highload-test-config.json";

    private const URL_KEY = "url";
    private const QUANTITY_KEY = "quantity";
    private const REQUEST_KEY = "request";

    public static ?ConfigDTO $config = null;

    private function __construct()
    {
    }

    /**
     * @return array<string, string|int|null>
     */
    private static function getFileConfig(): array
    {
        $json = file_get_contents(self::CONFIG_FILE_PATH);

        if ($json === false) {
            return [];
        }

        return json_decode($json, true);
    }

    public static function getConfig(): ConfigDTO
    {
        if (is_null(self::$config)) {
            $config = self::getFileConfig();

            self::$config = new ConfigDTO(
                url: $config[self::URL_KEY] ?? self::DEFAULT_URL,
                quantity: $config[self::QUANTITY_KEY] ?? self::DEFAULT_QUANTITY_OF_REQUESTS,
                request: $config[self::REQUEST_KEY] ?? self::DEFAULT_REQUEST,
            );
        }

        return self::$config;
    }
}

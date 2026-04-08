<?php

namespace app\requests;

use app\dto\ConfigDTO;
use app\helpers\Logger;

class Generator
{
    public static function run(ConfigDTO $config, int $requestId): void
    {
        $count = 0;
        while ($count < $config->quantity) {
            $status = exec("php scenario_script.php --request_id=$requestId > /dev/null 2>&1 &");
            if ($status === false) {
                Logger::log('app.log', 'Some error with shell command execution.');
            }
            ++$count;
        }
    }
}

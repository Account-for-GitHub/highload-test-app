<?php

namespace app\request\scenarios;

use app\config\Config;
use app\dto\ResponseDTO;
use app\request\senders\HttpSender;

class SimpleScenario implements IScenarioStrategy
{
    function execute(): ResponseDTO|false
    {
        $config = Config::getConfig();

        return HttpSender::send($config);
    }
}

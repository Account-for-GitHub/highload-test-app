<?php

namespace app\requests\scenarios;

use app\config\Config;
use app\dto\ResponseDTO;
use app\requests\senders\HttpSender;

class SimpleScenario implements IScenarioStrategy
{
    function execute(): ResponseDTO|false
    {
        $config = Config::getConfig();
        $json_data = json_encode($config->request);
        
        return HttpSender::send($config, $json_data);
    }
}

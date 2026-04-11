<?php

namespace app\request\scenarios;

use app\dto\ResponseDTO;

interface IScenarioStrategy
{
    function execute(): ResponseDTO|false;
}

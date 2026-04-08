<?php

namespace app\requests\scenarios;

use app\dto\ResponseDTO;

interface IScenarioStrategy
{
    function execute(): ResponseDTO|false;
}

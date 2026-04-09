<?php

namespace app\requests;

use app\models\Response;
use app\requests\scenarios\IScenarioStrategy;
use app\requests\scenarios\SimpleScenario;

class Scenario
{
    function __construct(protected IScenarioStrategy $scenario = new SimpleScenario())
    {
    }

    protected function getRequestId(): int
    {
        $options = getopt('', ['request_id:']);
        return $options['request_id'];
    }

    public function execute(): void
    {
        $response = $this->scenario->execute();

        Response::create([
            'request_id' => $this->getRequestId(),
            'status' => $response->status,
            'response' => $response->response,
        ]);
    }
}

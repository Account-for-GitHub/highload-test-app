<?php

namespace app\request;

use app\models\Response;
use app\request\scenarios\IScenarioStrategy;
use app\request\scenarios\SimpleScenario;
use Exception;

class Scenario
{
    function __construct(protected IScenarioStrategy $scenario = new SimpleScenario())
    {
    }

    /**
     * @throws Exception
     */
    protected function getRequestId(): int
    {
        $options = getopt('', ['request_id:']);
        return $options['request_id'] ?? throw new Exception('--request_id option is required');
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

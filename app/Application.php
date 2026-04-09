<?php

namespace app;

use app\config\Config;
use app\models\Request;
use app\output\format\AggregateFormat;
use app\output\Output;
use app\requests\Generator;

class Application
{
    public function run(): void
    {
        $config = Config::getConfig();

        $requestId = Request::create([
            'url' => $config->url,
            'quantity' => $config->quantity,
            'request_json' => $config->request,
        ])->id;

        Generator::run($config, $requestId);

        (new Output(new AggregateFormat()))->output();
    }
}

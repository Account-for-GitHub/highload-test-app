<?php

namespace app;

use app\config\Config;
use app\models\Request;
use app\output\formats\AggregateFormat;
use app\output\Output;
use app\request\Generator;

class Application
{
    public static function run(): void
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

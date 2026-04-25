<?php

namespace app\output\formats;

use app\helpers\Helpers;
use app\models\Request;
use app\models\Response;

class SimpleFormat extends IFormatStrategy
{
    function getOutput(): string
    {
        /** @var Request $request */
        $request = Request::with('responses')
            ->latest()
            ->first();

        $this->addString("\nRequest URL: $request->url; Quantity: $request->quantity; "
            . "Request JSON: $request->request_json;\n");

        $responses = $request
            ->responses()
            ->get();

        foreach ($responses as $index => $response) {
            /** @var Response $response */
            $this->addString("Response Index: $index; HTTP-Status: $response->status; Output: "
                . Helpers::getFirst($response->response, 100) . ";\n");
        }

        return $this->getString();
    }
}

<?php

namespace app\output\format;

use app\models\Request;
use app\models\Response;

class AggregateFormat extends IFormatStrategy
{
    function output(): void
    {
        /** @var Request $request */
        $request = Request::with('responses')
            ->latest()
            ->first();

        echo "\nRequest URL: " . $request->url . "; Quantity: " . $request->quantity
            . "; Request JSON: " . $request->request_json . ";\n";

        $allResponsesCount = $request
            ->responses()
            ->count();

        $responses = $request
            ->responses()
            ->selectRaw('status, count(*) as responses_count')
            ->groupBy('status')
            ->get();

        echo "\nTotal number of responses: $allResponsesCount;\n\n";

        foreach ($responses as $r) {
            /** @var Response $r */
            echo "HTTP-Status: $r->status;\n";
            echo "Number of responses: " . $r->responses_count . ";\n\n";
        }
    }
}

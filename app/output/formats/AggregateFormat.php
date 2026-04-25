<?php

namespace app\output\formats;

use app\models\Request;
use app\models\Response;

class AggregateFormat extends IFormatStrategy
{
    function getOutput(): string
    {
        /** @var Request $request */
        $request = Request::with('responses')
            ->latest()
            ->first();

        $this->addString("\nRequest URL: " . $request->url . "; Quantity: " . $request->quantity
            . "; Request JSON: " . $request->request_json . ";\n");

        $allResponsesCount = $request
            ->responses()
            ->count();

        $responses = $request
            ->responses()
            ->selectRaw('status, count(*) as responses_count')
            ->groupBy('status')
            ->get();

        $this->addString("\nTotal number of responses: $allResponsesCount;\n\n");

        foreach ($responses as $r) {
            /** @var Response $r */
            $this->addString("Group of responses with HTTP-Status: $r->status;\n"
            . "Number of responses in group: " . $r->responses_count . ";\n\n");
        }

        return $this->getString();
    }
}

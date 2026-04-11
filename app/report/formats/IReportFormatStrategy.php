<?php

namespace app\report\formats;

use app\models\Request;

abstract class IReportFormatStrategy
{
    public const CSV = 1;
    public const CSV_NAME = 'csv';
    public const HTML = 2;
    public const HTML_NAME = 'html';

    abstract public static function formatName(): string;

    abstract public function format(): int;

    abstract protected function makeReport(Request $request): void;

    public function generate(): void
    {
        $unprocessedRequests = Request::whereDoesntHave('reports', function ($query) {
            $query->where('format', $this->format());
        })->get();

        if($unprocessedRequests->isEmpty()) {
            echo "All reports generated\n";
        }

        foreach ($unprocessedRequests as $request) {
            $this->makeReport($request);
        }
    }
}

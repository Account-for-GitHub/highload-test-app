<?php

namespace app\report\formats;

use app\helpers\Helpers;
use app\models\Request;

abstract class IReportFormatStrategy
{
    public const CSV = 1;
    public const CSV_NAME = 'csv';
    public const HTML = 2;
    public const HTML_NAME = 'html';

    abstract public function formatName(): string;

    abstract public function format(): int;

    abstract protected function makeReport(Request $request): void;

    public function generate(): void
    {
        $unprocessedRequests = Request::whereDoesntHave('reports', function ($query) {
            $query->where('format', $this->format());
        });

        if($unprocessedRequests->count() === 0) {
            Helpers::output("All {$this->formatName()} reports are already generated!");
        }

        foreach ($unprocessedRequests->get() as $request) {
            $this->makeReport($request);
        }
    }
}

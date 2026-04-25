<?php

namespace app\report\formats;

use app\helpers\Helpers;
use app\models\Report;
use app\models\Request;
use app\models\Response;

class CSVReport extends IReportFormatStrategy
{

    const CSV_REPORTS_DIR = __DIR__ . '/../../../reports/csv/';

    public function formatName(): string
    {
        return IReportFormatStrategy::CSV_NAME;
    }

    public function format(): int
    {
        return IReportFormatStrategy::CSV;
    }

    protected function makeReport(Request $request): void
    {
        $header = $this->makeHeader($request);

        $report = $header;

        $responses = $request
            ->responses()
            ->get();

        foreach ($responses as $index => $response) {
            /** @var Response $response */
            $responseCsvLine = "$index;$response->status;"
                . urlencode(Helpers::getFirst($response->response, 50)) . "\n";

            $report .= $responseCsvLine;
        }

        $this->saveToDatabase($request->id, $report);
        $this->createReportFile($request->id, $report);
    }

    protected function makeHeader(Request $request): string
    {
        return "$request->url;$request->quantity;$request->request_json\n";
    }

    protected function saveToDatabase(int $requestId, string $report): void
    {
        Report::create([
            'request_id' => $requestId,
            'format' => $this->format(),
            'report' => $report,
        ]);
    }

    protected function createReportFile(int $requestId, string $report)
    {
        $filename = date('Y-m-d-H-i-s') . "-request-$requestId-report.csv";

        Helpers::output($filename);

        file_put_contents(
            self::CSV_REPORTS_DIR . $filename,
            $report,
        );
    }
}

<?php

namespace app\report\formats;

use app\helpers\Helpers;
use app\models\Report;
use app\models\Request;
use app\models\Response;

class HTMLReport extends IReportFormatStrategy
{

    const HTML_REPORTS_DIR = __DIR__ . '/../../../reports/html/';

    public function formatName(): string
    {
        return IReportFormatStrategy::HTML_NAME;
    }

    public function format(): int
    {
        return IReportFormatStrategy::HTML;
    }

    protected function makeReport(Request $request): void
    {
        $description = $this->makeDescription($request);

        $header = $this->makeHeader($description);

        $content = $header;

        $responses = $request
            ->responses()
            ->get();

        $responsesHtmlContent = [];
        foreach ($responses as $index => $response) {
            /** @var Response $response */
            $responseHtmlLine = "<h2>Response number: $index; HTTP-Status: $response->status; Response: "
                . htmlspecialchars(Helpers::getFirst($response->response, 50)) . "</h2>";

            $responsesHtmlContent[] = $responseHtmlLine;
        }
        $content .= implode("\n", $responsesHtmlContent);

        $requestId = $request->id;
        $report = $this->generateHtmlReport($requestId, $content);
        $this->saveToDatabase($requestId, $report);
        $this->createReportFile($requestId, $report);
    }

    protected function makeDescription(Request $request): string
    {
        return "URL for requests: $request->url; "
            . "Quantity of requests: $request->quantity; "
            . "Request JSON: $request->request_json";
    }

    public function makeHeader(string $header): string
    {
        return "<h1>$header</h1>\n<br>\n<br>\n";
    }

    public function generateHtmlReport(int $requestId, string $content): string {
        return <<<HEREDOC
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>Report for request $requestId</title>
                </head>
            <body>
            $content
            </body>
            </html>
            HEREDOC;
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
        $filename = date('Y-m-d-H-i-s') . "-request-$requestId-report.html";

        Helpers::output($filename);

        file_put_contents(
            self::HTML_REPORTS_DIR . $filename,
            $report,
        );
    }
}

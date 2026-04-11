<?php

namespace report\formats;

use app\report\formats\HTMLReport;
use app\report\formats\IReportFormatStrategy;
use PHPUnit\Framework\TestCase;

class HTMLReportTest extends TestCase
{

    public function testFormat()
    {
        $reportObject = new HTMLReport();

        $this->assertEquals(IReportFormatStrategy::HTML, $reportObject->format());
    }

    public function testFormatName()
    {
        $this->assertEquals(IReportFormatStrategy::HTML_NAME, HTMLReport::formatName());
    }

    public function testMakeHeader()
    {
        $header = (new HTMLReport())->makeHeader("Some header");

        $this->assertEquals("<h1>Some header</h1>\n<br>\n<br>\n", $header);
    }

    public function testGenerateHtmlReport()
    {
        $requestId = 123;
        $content = "<h1>Some HTML content</h1>";
        $template = <<<HEREDOC
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

        $html = (new HTMLReport())->generateHtmlReport($requestId, $content);

        $this->assertEquals($template, $html);
    }
}

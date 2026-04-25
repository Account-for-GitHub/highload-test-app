<?php

namespace report\formats;

use app\report\formats\CSVReport;
use app\report\formats\IReportFormatStrategy;
use PHPUnit\Framework\TestCase;

class CSVReportTest extends TestCase
{

    public function testFormat()
    {
        $reportObject = new CSVReport();

        $this->assertEquals(IReportFormatStrategy::CSV, $reportObject->format());
    }

    public function testFormatName()
    {
        $reportObject = new CSVReport();

        $this->assertEquals(IReportFormatStrategy::CSV_NAME, $reportObject->formatName());
    }
}

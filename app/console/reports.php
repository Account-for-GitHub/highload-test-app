<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use app\database\Database;
use app\report\formats\CSVReport;
use app\report\formats\HTMLReport;
use app\report\formats\IReportFormatStrategy;
use app\report\Reports;

Database::connect();

$formatOption = getopt('', ['format:']);

$reportsFormatName = $formatOption['format'] ?? IReportFormatStrategy::CSV_NAME;

$formatObject = match ($reportsFormatName) {
    IReportFormatStrategy::HTML_NAME => new HTMLReport(),
    default => new CSVReport(),
};

Reports::generate($formatObject);

<?php

namespace app\report;

use app\report\formats\IReportFormatStrategy;

class Reports
{
    public static function generate(IReportFormatStrategy $format): void
    {
        $format->generate();
    }
}

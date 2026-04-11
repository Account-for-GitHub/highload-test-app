<?php

namespace app\output;

use app\output\formats\IFormatStrategy;
use app\output\formats\SimpleFormat;

class Output
{
    function __construct(protected IFormatStrategy $outputStrategy = new SimpleFormat())
    {
    }

    public function output(): void
    {
        $this->outputStrategy->output();
    }
}

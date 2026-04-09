<?php

namespace app\output;

use app\output\format\IFormatStrategy;
use app\output\format\SimpleFormat;

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

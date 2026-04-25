<?php

namespace app\output;

use app\output\formats\IFormatStrategy;
use app\output\formats\SimpleFormat;

class OutputProvider
{
    function __construct(protected IFormatStrategy $outputStrategy = new SimpleFormat())
    {
    }

    public function getOutput(): string
    {
        return $this->outputStrategy->getOutput();
    }
}

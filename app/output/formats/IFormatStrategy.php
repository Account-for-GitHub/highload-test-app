<?php

namespace app\output\formats;

use app\helpers\Helpers;

abstract class IFormatStrategy
{
    protected string $output = '';

    public function __construct()
    {
        Helpers::waitUntilRequestsPerformed();
    }

    protected function addString(string $string): void
    {
        $this->output .= $string;
    }

    protected function getString(): string
    {
        return $this->output;
    }

    abstract function getOutput(): string;
}

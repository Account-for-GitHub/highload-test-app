<?php

namespace app\output\format;

use app\helpers\Helpers;

abstract class IFormatStrategy
{
    public function __construct()
    {
        Helpers::waitUntilRequestsPerformed();
    }

    abstract function output(): void;
}

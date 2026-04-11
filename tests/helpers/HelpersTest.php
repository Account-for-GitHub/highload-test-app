<?php

namespace helpers;

use app\helpers\Helpers;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{

    public function testGetFirst()
    {
        $string = Helpers::getFirst("Some text string", 9);
        $this->assertEquals('Some text...', $string);
    }
}

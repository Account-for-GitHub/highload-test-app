<?php

namespace helpers;

use app\helpers\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    const TMP_FILENAME = __DIR__ . '/../assets/tmp/test.log';

    protected function tearDown(): void
    {
        parent::tearDown();

        if (file_exists(self::TMP_FILENAME)) {
            unlink(self::TMP_FILENAME);
        }
    }

    public function testLog()
    {
        Logger::log('/tests/assets/tmp/test.log', 'Some message');

        $contents = file_get_contents(self::TMP_FILENAME);

        $this->assertFileExists(self::TMP_FILENAME);
        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} : .*/', $contents);
    }
}

<?php

namespace app\helpers;

class Logger
{
    public static function log(string $filename, string $message): void
    {
        file_put_contents(
            __DIR__ . '/../../' . $filename,
            date('Y-m-d H:i:s') . ' : ' . $message . "\n",
            FILE_APPEND
        );
    }
}

<?php

namespace Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation;

use Helldar\LaravelLoggerChannels\Loggers\Common\LogFormatter;

class DifferentLogsChannel
{
    public static function get(string $path, int $max_files = 30): array
    {
        return [
            'driver'    => 'custom',
            'via'       => Logger::class,
            'tap'       => [LogFormatter::class],
            'path'      => $path,
            'max_files' => $max_files,
        ];
    }
}

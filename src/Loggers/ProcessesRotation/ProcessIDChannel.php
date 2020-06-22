<?php

namespace Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation;

class ProcessIDChannel
{
    public static function get(string $path, int $days = 14): array
    {
        return [
            'driver' => 'custom',
            'via'    => Logger::class,
            'path'   => $path,
            'days'   => $days,
        ];
    }
}
